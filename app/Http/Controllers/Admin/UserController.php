<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        // Paginate the users, 10 per page (you can adjust this number)
        $users = User::whereNotIn('role', [2])->paginate(10);

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'roles' => User::ROLES
        ]);
    }


    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'mobile' => 'required|unique:users,mobile|max:15', // Validate unique mobile/user ID
        'password' => 'required|string|min:6|confirmed', // Ensure password and confirmation match
        'role' => 'required|integer|in:1,2', // Ensure valid role
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->mobile = $request->mobile;
    $user->password = Hash::make($request->password);
    $user->role = $request->role;

    // Handle profile image upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('profile_images', 'public');
        $user->image = $imagePath;
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}




    public function edit($id)
    {
        $user = User::findOrFail($id); // Find the user or throw a 404 error
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => User::ROLES, // Pass roles for dropdown
        ]);
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Find the user

        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|unique:users,mobile,' . $user->id . '|max:15', // Ignore current user's mobile
            'password' => 'nullable|string|min:8|confirmed', // Optional password update
            'role' => 'required|integer|in:1,2', // Ensure role is valid
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle profile image upload
        if ($request->hasFile('image')) {
            if ($user->image) {
                Storage::disk('public')->delete($user->image); // Delete old image
            }
            $user->image = $request->file('image')->store('profile_images', 'public');
        }

        // Update user details
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        if ($request->password) {
            $user->password = Hash::make($request->password); // Hash and update password
        }
        $user->role = $request->role;
        $user->save();

        // Redirect back with success message
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id); // Find the user

        // Delete profile image if exists
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        // Delete the user
        $user->delete();

        // Redirect back with success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}