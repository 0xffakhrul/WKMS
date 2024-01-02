<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    //show all listings
    public function index()
    {
        $leaves = Leave::paginate(10); // Use the paginate method to get 10 leaves per page

        return view('admin.leaves.index', ['leaves' => $leaves]);
    }

    //create form
    public function create()
    {
        $users = User::all();
        return view('admin.leaves.create', ['users' => $users]);
    }

    // Show the form for editing the specified leave.
    public function edit(Leave $leave)
    {
        return view('admin.leaves.edit', ['leave' => $leave]);
    }

    // Store the specified leave in storage.
    public function store(Request $request)
    {
        // Validate the form data
        $formFields = $request->validate([
            'user_id' => 'required|exists:users,id', // Ensure the selected user exists
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'leave_type' => 'required|in:annual,sick', // Add your leave types
            'description' => 'required|string',
            // Add other fields as needed
        ]);

        // Create a new Leave instance and store it in the database
        Leave::create($formFields);

        // Redirect to the leaves index page or show page
        return redirect()->route('admin.leaves.index')->with('message', 'Leave created successfully!');
    }


    // Update the specified leave in storage.
    public function update(Request $request, Leave $leave)
    {
        $formFields = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'leave_type' => 'required|in:annual,sick', // Add your leave types
            'description' => 'required|string',
            'status' => 'required|in:pending,approved,rejected',
            // Add other fields as needed
        ]);

        $leave->update($formFields);

        return redirect('/admin/leaves')->with('message', 'Leave updated successfully!');
    }

    //delete employee
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return redirect('/admin/leaves')->with('message', 'Employee deleted successfully');
    }

    //create form
    public function empCreate()
    {
        $leaves = Leave::all();
        return view('staff.leaves.create', [
            'leaves' => $leaves,
        ]);
    }

    // Store leave request for employees
    public function empStore(Request $request)
    {
        // Check if the user has a pending leave request
        $pendingLeave = Leave::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->first();

        // If a pending leave request is found, redirect back with an error message
        if ($pendingLeave) {
            return redirect()->route('staff.dashboard')->with('error', 'You already have a pending leave request.');
        }

        // Validate the form data
        $formFields = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'leave_type' => 'required|in:sick,annual,other',
            'description' => 'required|string',
        ]);

        // Create a new LeaveRequest instance and store it in the database
        $formFields['user_id'] = auth()->id(); // Associate with the logged-in user
        Leave::create($formFields);

        // Redirect to the staff dashboard or show page
        return redirect()->route('staff.dashboard')->with('success', 'Leave request submitted successfully!');
    }

    //show all listings
    public function empIndex()
    {
        $leaves = Leave::where('user_id', auth()->user()->id)->paginate(10); // Use the paginate method to get 10 leaves per page
        return view('staff.leaves.index', ['leaves' => $leaves]);
    }
}
