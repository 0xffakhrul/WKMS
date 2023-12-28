<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //show all listings
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::all()
        ]);
    }

    //create form
    public function create()
    {
        return view('admin.users.create');
    }

    //store employee
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'email' => 'required|email|max:255',
            'hire_date' => 'required',
            'type' => 'required',
            'role' => 'required'
        ]);

        $formFields['password'] = bcrypt('password');
        User::create($formFields);

        return redirect('/admin/users')->with('message', 'Employee created successfully!');
    }

    // Show the form for editing the specified user.
    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    // Update the specified user in storage.
    public function update(Request $request, User $user)
    {
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits:10',
            'email' => 'required|email|max:255',
            'hire_date' => 'required',
            'type' => 'required',
            'role' => 'required|in:1,2',
        ]);

        $user->update($formFields);

        return redirect('/admin/users')->with('message', 'User updated successfully!');
    }
}
