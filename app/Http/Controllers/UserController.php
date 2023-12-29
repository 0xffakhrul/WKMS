<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //show all listings with pagination
    public function index(Request $request)
    {
        $search = $request->input('search');
        $users = User::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%')
                ->orWhere('phone_number', 'like', '%' . $search . '%');
        })->paginate(10);

        return view('admin.users.index', compact('users', 'search'));
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

    //delete employee
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/admin/users')->with('message', 'Employee deleted successfully');
    }
}
