<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = User::orderBy('name')
            ->orderBy('email')
            ->get();

        return view('admin.admins.index', compact('admins'));
    }

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

        User::create([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with(
            'success',
            'New administrator created successfully.'
        );
    }

    public function update(Request $request, User $admin)
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
                Rule::unique('users', 'email')->ignore($admin->id),
            ],
        ]);

        $admin->update([
            'name' => trim($validated['name']),
            'email' => strtolower(trim($validated['email'])),
        ]);

        return back()->with(
            'success',
            'Administrator information updated successfully.'
        );
    }

    public function updatePassword(Request $request, User $admin)
    {
        $validated = $request->validate([
            'password' => [
                'required',
                'confirmed',
                Password::min(8)
                    ->letters()
                    ->numbers(),
            ],
        ]);

        $admin->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with(
            'success',
            'Administrator password changed successfully.'
        );
    }

    public function destroy(User $admin)
    {
        if (auth()->id() === $admin->id) {
            return back()->with(
                'error',
                'You cannot delete your own administrator account.'
            );
        }

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
}