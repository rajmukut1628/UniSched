<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminManagementController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | OWNER / MAIN ADMIN
    |--------------------------------------------------------------------------
    */

    private function ownerEmail(): string
    {
        $ownerId = DB::table('admin_ownership')->where('id', 1)->value('owner_id');

        if ($ownerId !== null) {
            return strtolower(trim((string) User::whereKey($ownerId)->value('email')));
        }

        return strtolower(
            trim((string) config('app.owner_admin_email'))
        );
    }

    private function isOwnerAdmin(User $admin): bool
    {
        $ownerEmail = $this->ownerEmail();

        if ($ownerEmail === '') {
            return false;
        }

        return strtolower(trim($admin->email)) === $ownerEmail;
    }

    private function currentUserIsOwner(): bool
    {
        $user = auth()->user();

        if (!$user instanceof User) {
            return false;
        }

        return $this->isOwnerAdmin($user);
    }

    private function lockOwnership(): void
    {
        $ownership = DB::table('admin_ownership')->where('id', 1)->lockForUpdate()->first();
        abort_unless($ownership, 503, 'Ownership settings are unavailable.');
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN MANAGEMENT PAGE
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $ownerAdminEmail = $this->ownerEmail();
        $currentUserIsOwner = $this->currentUserIsOwner();

        $admins = User::query()
            ->orderByRaw(
                'LOWER(email) = ? DESC',
                [$ownerAdminEmail]
            )
            ->orderBy('name')
            ->orderBy('email')
            ->get();

        return view(
            'admin.admins.index',
            compact(
                'admins',
                'ownerAdminEmail',
                'currentUserIsOwner'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE ADMIN
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers(),
            ],
        ]);

        $email = strtolower(
            trim($validated['email'])
        );

        /*
        |--------------------------------------------------------------------------
        | OWNER EMAIL CANNOT BE USED FOR ANOTHER ACCOUNT
        |--------------------------------------------------------------------------
        */

        if (
            $this->ownerEmail() !== '' &&
            $email === $this->ownerEmail()
        ) {
            return back()
                ->withInput(
                    $request->except([
                        'password',
                        'password_confirmation',
                    ])
                )
                ->with(
                    'error',
                    'This email address is reserved for the Main Administrator.'
                );
        }

        User::create([
            'name' => trim($validated['name']),
            'email' => $email,

            /*
            |--------------------------------------------------------------------------
            | PASSWORD IS HASHED
            |--------------------------------------------------------------------------
            |
            | The original password is never stored.
            | Therefore it cannot be viewed later.
            |
            */

            'password' => Hash::make(
                $validated['password']
            ),
        ]);

        return back()->with(
            'success',
            'New administrator created successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE ADMIN INFORMATION
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        User $admin
    ) {
        return DB::transaction(function () use ($request, $admin) {
            $this->lockOwnership();

            return $this->updateAdmin($request, $admin->refresh());
        });
    }

    private function updateAdmin(Request $request, User $admin)
    {
        $isOwner = $this->isOwnerAdmin($admin);
        $currentUserIsOwner = $this->currentUserIsOwner();
        $isCurrentUser = auth()->id() === $admin->id;

        /*
        |--------------------------------------------------------------------------
        | MAIN ADMIN PROTECTION
        |--------------------------------------------------------------------------
        |
        | General admins cannot modify the Main Admin.
        |
        */

        if (
            $isOwner &&
            !$currentUserIsOwner
        ) {
            return back()->with(
                'error',
                'The Main Administrator account is protected.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | GENERAL ADMIN EDIT PERMISSION
        |--------------------------------------------------------------------------
        |
        | A general admin may edit only their own profile.
        | Main Admin may edit general admin profiles.
        |
        */

        if (
            !$currentUserIsOwner &&
            !$isCurrentUser
        ) {
            return back()->with(
                'error',
                'You are not authorized to edit another administrator.'
            );
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',

                Rule::unique(
                    'users',
                    'email'
                )->ignore($admin->id),
            ],
        ]);

        $newEmail = strtolower(
            trim($validated['email'])
        );

        /*
        |--------------------------------------------------------------------------
        | MAIN ADMIN EMAIL IS PERMANENT
        |--------------------------------------------------------------------------
        */

        if ($isOwner) {
            if (
                $newEmail !==
                $this->ownerEmail()
            ) {
                return back()->with(
                    'error',
                    'The Main Administrator email address is protected and cannot be changed.'
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | OWNER EMAIL CANNOT BE ASSIGNED TO GENERAL ADMIN
        |--------------------------------------------------------------------------
        */

        if (
            !$isOwner &&
            $this->ownerEmail() !== '' &&
            $newEmail === $this->ownerEmail()
        ) {
            return back()->with(
                'error',
                'This email address is reserved for the Main Administrator.'
            );
        }

        $admin->update([
            'name' => trim(
                $validated['name']
            ),

            'email' => $newEmail,
        ]);

        return back()->with(
            'success',
            'Administrator information updated successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PASSWORD MANAGEMENT
    |--------------------------------------------------------------------------
    |
    | Password viewing/changing from Admin Management is intentionally disabled.
    |
    | Passwords are stored using one-way hashing.
    | The original password must never be displayed.
    |
    | Administrators should use the Forgot Password / Reset Password
    | system when they need to change their password.
    |
    */

    public function updatePassword(
        Request $request,
        User $admin
    ) {
        abort(
            403,
            'Password management is disabled from the Admin Management panel.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DELETE ADMIN
    |--------------------------------------------------------------------------
    */

    public function destroy(User $admin)
    {
        return DB::transaction(function () use ($admin) {
            $this->lockOwnership();

            return $this->destroyAdmin($admin->refresh());
        });
    }

    private function destroyAdmin(User $admin)
    {
        /*
        |--------------------------------------------------------------------------
        | MAIN ADMIN CAN NEVER BE DELETED
        |--------------------------------------------------------------------------
        */

        if ($this->isOwnerAdmin($admin)) {
            return back()->with(
                'error',
                'The Main Administrator account is permanently protected and cannot be deleted.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | GENERAL ADMIN CANNOT DELETE THEIR OWN ACCOUNT
        |--------------------------------------------------------------------------
        */

        if (auth()->id() === $admin->id) {
            return back()->with(
                'error',
                'You cannot delete your own administrator account.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | ONLY MAIN ADMIN CAN DELETE ANOTHER ADMIN
        |--------------------------------------------------------------------------
        */

        if (!$this->currentUserIsOwner()) {
            return back()->with(
                'error',
                'Only the Main Administrator can delete another administrator.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SAFETY CHECK
        |--------------------------------------------------------------------------
        */

        if (User::count() <= 1) {
            return back()->with(
                'error',
                'The last administrator account cannot be deleted.'
            );
        }

        $admin->delete();

        return back()->with(
            'success',
            'Administrator deleted successfully.'
        );
    }

    public function transferOwnership(Request $request)
    {
        abort_unless($this->currentUserIsOwner(), 403, 'Only the Main Administrator can transfer ownership.');

        $validated = $request->validateWithBag('ownership', [
            'new_owner_id' => ['required', 'integer', Rule::exists('users', 'id'), Rule::notIn([$request->user()->id])],
            'ownership_password' => ['required', 'string', 'current_password'],
            'confirm_ownership' => ['accepted'],
        ]);

        return DB::transaction(function () use ($request, $validated) {
            $this->lockOwnership();
            $currentOwner = User::whereKey($request->user()->id)->lockForUpdate()->firstOrFail();

            // Recheck after taking the lock: another request may have transferred ownership.
            abort_unless($this->isOwnerAdmin($currentOwner), 403, 'Only the Main Administrator can transfer ownership.');
            abort_unless(Hash::check($validated['ownership_password'], $currentOwner->password), 403, 'Your password has changed. Please try again.');

            $newOwner = User::whereKey($validated['new_owner_id'])->lockForUpdate()->firstOrFail();

            DB::table('admin_ownership')->where('id', 1)->update([
                'owner_id' => $newOwner->id,
                'updated_at' => now(),
            ]);

            return redirect()->route('admin.admins.index')->with(
                'success',
                'Ownership transferred to '.$newOwner->name.'. Your account is now a regular administrator.'
            );
        });
    }
}
