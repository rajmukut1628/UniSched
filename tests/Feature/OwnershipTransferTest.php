<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OwnershipTransferTest extends TestCase
{
    use RefreshDatabase;

    private User $owner;
    private User $admin;

    public function createApplication(): Application
    {
        $app = parent::createApplication();
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite.database', ':memory:');

        return $app;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        config(['app.owner_admin_email' => 'owner@example.test']);
        $this->owner = User::factory()->create(['email' => 'owner@example.test']);
        $this->admin = User::factory()->create(['email' => 'admin@example.test']);
    }

    private function transferData(array $overrides = []): array
    {
        return array_merge([
            'new_owner_id' => $this->admin->id,
            'ownership_password' => 'password',
            'confirm_ownership' => '1',
        ], $overrides);
    }

    public function test_owner_can_transfer_and_the_new_owner_keeps_access_after_configuration_changes(): void
    {
        $this->actingAs($this->owner)->post(route('admin.admins.ownership.transfer'), $this->transferData())
            ->assertRedirect(route('admin.admins.index'))->assertSessionHas('success');
        $this->assertDatabaseHas('admin_ownership', ['id' => 1, 'owner_id' => $this->admin->id]);

        config(['app.owner_admin_email' => 'different@example.test']);
        $this->actingAs($this->admin)->get(route('admin.admins.index'))
            ->assertOk()->assertSee('Transfer Ownership');
        $this->post(route('admin.admins.ownership.transfer'), $this->transferData(['new_owner_id' => $this->owner->id]))
            ->assertRedirect(route('admin.admins.index'));
        $this->assertDatabaseHas('admin_ownership', ['id' => 1, 'owner_id' => $this->owner->id]);
    }

    public function test_regular_admin_cannot_transfer_or_see_the_transfer_form(): void
    {
        $this->actingAs($this->admin)->get(route('admin.admins.index'))
            ->assertOk()->assertSee('Only the current Main Administrator can transfer ownership.')
            ->assertDontSee('name="ownership_password"', false)
            ->assertDontSee('<<<<<<<', false);
        $this->post(route('admin.admins.ownership.transfer'), $this->transferData(['new_owner_id' => $this->owner->id]))
            ->assertForbidden();
        $this->assertDatabaseHas('admin_ownership', ['id' => 1, 'owner_id' => null]);
    }

    public function test_password_is_required_and_is_never_flashed_to_the_session(): void
    {
        $this->actingAs($this->owner)->from(route('admin.admins.index'))
            ->post(route('admin.admins.ownership.transfer'), $this->transferData(['ownership_password' => 'incorrect-password']))
            ->assertSessionHasErrorsIn('ownership', ['ownership_password']);
        $this->assertNull(session()->getOldInput('ownership_password'));
        $this->assertDatabaseHas('admin_ownership', ['id' => 1, 'owner_id' => null]);
    }

    public function test_transfer_requires_explicit_confirmation(): void
    {
        $this->actingAs($this->owner)->post(route('admin.admins.ownership.transfer'), $this->transferData(['confirm_ownership' => '0']))
            ->assertSessionHasErrorsIn('ownership', ['confirm_ownership']);
        $this->assertDatabaseHas('admin_ownership', ['id' => 1, 'owner_id' => null]);
    }

    public function test_owner_cannot_transfer_to_themselves_or_a_missing_account(): void
    {
        $this->actingAs($this->owner);
        foreach ([$this->owner->id, 999999] as $id) {
            $this->post(route('admin.admins.ownership.transfer'), $this->transferData(['new_owner_id' => $id]))
                ->assertSessionHasErrorsIn('ownership', ['new_owner_id']);
        }
        $this->assertDatabaseHas('admin_ownership', ['id' => 1, 'owner_id' => null]);
    }

    public function test_previous_owner_loses_owner_permissions_and_new_owner_is_protected(): void
    {
        $this->actingAs($this->owner)->post(route('admin.admins.ownership.transfer'), $this->transferData());
        $thirdAdmin = User::factory()->create();

        $this->post(route('admin.admins.ownership.transfer'), $this->transferData(['new_owner_id' => $thirdAdmin->id]))
            ->assertForbidden();
        $this->put(route('admin.admins.update', $this->admin), ['name' => 'Changed', 'email' => 'changed@example.test'])
            ->assertSessionHas('error', 'The Main Administrator account is protected.');
        $this->delete(route('admin.admins.destroy', $this->admin))->assertSessionHas('error');
        $this->delete(route('admin.admins.destroy', $thirdAdmin))->assertSessionHas('error');
        $this->assertDatabaseHas('users', ['id' => $this->admin->id, 'email' => 'admin@example.test']);
        $this->assertDatabaseHas('users', ['id' => $thirdAdmin->id]);

        $this->actingAs($this->admin)->delete(route('admin.admins.destroy', $thirdAdmin))->assertSessionHas('success');
        $this->assertDatabaseMissing('users', ['id' => $thirdAdmin->id]);
    }

    public function test_page_explains_when_there_is_no_other_administrator(): void
    {
        $this->admin->delete();
        $this->actingAs($this->owner)->get(route('admin.admins.index'))->assertOk()
            ->assertSee('Create another administrator first to transfer ownership.')
            ->assertDontSee('name="new_owner_id"', false);
    }

    public function test_guests_cannot_transfer_ownership(): void
    {
        $this->post(route('admin.admins.ownership.transfer'), $this->transferData())
            ->assertRedirect(route('login'));
    }
}
