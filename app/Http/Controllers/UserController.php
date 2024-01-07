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
            'phone_number' => 'required|regex:/^01[0-9]\d{7,8}$/',
            'email' => 'required|email|max:255|unique:users',
            'hire_date' => 'required',
            'type' => 'required',
            'role' => 'required'
        ]);

        $formFields['password'] = bcrypt('password');
        User::create($formFields);
        toastr()->addSuccess('Employee created successfully!');
        return redirect('/admin/users');
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
            'phone_number' => 'required|regex:/^01[0-9]\d{7,8}$/',
            'email' => 'required|email|max:255',
            'hire_date' => 'required',
            'type' => 'required',
            'role' => 'required',
        ]);

        $user->update($formFields);
        toastr()->addSuccess('Employee updated successfully!');
        return redirect('/admin/users');
    }

    //delete employee
    public function destroy(User $user)
    {
        $user->delete();
        toastr()->addSuccess('Employee deleted successfully');
        return redirect('/admin/users');
    }
}
