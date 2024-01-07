<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    //show all listings
    public function index(Request $request)
    {
        $search = $request->input('search');
        $leaves = Leave::when($search, function ($query) use ($search) {
            $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone_number', 'like', '%' . $search . '%');
            });
        })->paginate(10);

        return view('admin.leaves.index', compact('leaves', 'search'));
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
        toastr()->addSuccess('Leave created successfully!');
        return redirect()->route('admin.leaves.index');
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

        toastr()->addSuccess('Leave updated successfully!');
        return redirect('/admin/leaves');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string',
        ]);

        $leave = Leave::findOrFail($id);
        $leave->status = 'rejected';
        $leave->rejection_reason = $request->input('rejection_reason');
        $leave->save();

        // Return a JSON response indicating success
        toastr()->addSuccess('Leave request rejected successfully');
        return response()->json(['success' => true, 'message' => 'Leave request rejected successfully']);
    }

    public function destroy(Leave $leave)
    {
        $leave->delete();
        toastr()->addSuccess('Request deleted successfully');
        return redirect('/admin/leaves');
    }

    public function show(Leave $leave)
    {
        return view('staff.leaves.show', [
            'leave' => $leave,
        ]);
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
            // Set an error toast, with a title
            toastr()->addError('You already have a pending request.');
            return redirect()->route('staff.leaves.index');
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
        toastr()->addSuccess('Leave request submitted successfully!');
        return redirect()->route('staff.dashboard');
    }

    //show all listings
    public function empIndex()
    {
        $leaves = Leave::where('user_id', auth()->user()->id)->paginate(10); // Use the paginate method to get 10 leaves per page
        return view('staff.leaves.index', ['leaves' => $leaves]);
    }
}
