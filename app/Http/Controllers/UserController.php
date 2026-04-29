<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    //   Display a listing of the Users.

    public function index()
    {
        $authUser = Auth::user();

        if ($authUser->user_type === 'superAdmin') {
            // Super admin sees all users
            $users = User::where('id', '!=', $authUser->id)->get();
        } else {
            // Regular users see only their own profile with subscription
            $users = User::where('id', $authUser->id)
                ->with('activeSubscription.subscription')
                ->get();
        }
        return view('pages.users.index', compact('users'));
    }


    // Show the form for creating a new User.

    public function create()
    {
        return view('pages.users.add');
    }

    // Store a newly created User in storage.

    public function store(Request $request)
    {

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:6',
            'phone'         => 'required|string|max:20',
            'status'        => 'required|in:active,inactive,pending',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20480', // max 20MB
        ]);

        // Create new user
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Hash password
        $user->phone = $request->phone;
        $user->status = $request->status;

        // Handle image upload if exists
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');

            // Create a unique file name
            $filename = time() . '_' . $file->getClientOriginalName();

            // Move file to public/userImages folder
            $file->move(public_path('userImages'), $filename);

            // Save the filename in database
            $user->profile_photo = $filename;
        }

        // Ensure 'User' role exists
        $role = Role::firstOrCreate(['name' => 'User']);

        // Assign the role using Spatie
        $user->assignRole($role->name);

        // Also save the role_id in the users table
        $user->role_id = $role->id;

        $user->save();


        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }


    // Display the specified resource.

    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.view', compact('user'));
    }


    // Show the form for editing the specified User.

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.edit', compact('user'));
    }

    // Update the specified User in storage.

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'password'      => 'nullable|string|min:6',
            'phone'         => 'required|string|max:20',
            'status'        => 'required|in:active,inactive,pending',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20480',
        ]);

        // Update fields
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;

        // Update password only if provided
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Handle image upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Delete old image if exists
            if ($user->profile_photo && file_exists(public_path('userImages/' . $user->profile_photo))) {
                unlink(public_path('userImages/' . $user->profile_photo));
            }

            // Move new image
            $file->move(public_path('userImages'), $filename);
            $user->profile_photo = $filename;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    //  Remove the specified User from storage.

    public function destroy(string $id)
    {
        // Find the user
        $user = User::findOrFail($id);

        if ($user) {
            // Delete profile image if exists
            if ($user->profile_photo && file_exists(public_path('userimages/' . $user->profile_photo))) {
                unlink(public_path('userimages/' . $user->profile_photo));
            }

            // Delete the user from database
            $user->delete();
        }

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
