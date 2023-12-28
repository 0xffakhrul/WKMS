<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    //show all listings
    public function index()
    {
        return view('admin.leaves.index', [
            'leaves' => Leave::all()
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
}
