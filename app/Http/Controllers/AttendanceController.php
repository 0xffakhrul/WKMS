<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve today's attendance records
        $todayAttendances = Attendance::whereDate('date', Carbon::today())->get();

        // Check if a date filter is provided
        if ($request->has('filter_date')) {
            $filteredDate = $request->input('filter_date');
            $todayAttendances = Attendance::whereDate('created_at', $filteredDate)->get();
        }

        return view('admin.attendances.index', ['todayAttendances' => $todayAttendances]);
    }


    // create form
    public function empCreate()
    {
        $user_id = auth()->id();

        // Check if there is an existing attendance record for today
        $userHasRegisteredAttendance = Attendance::where('user_id', $user_id)
            ->whereDate('date', Carbon::today())
            ->whereNotNull('check_in_time')
            ->whereNotNull('check_out_time')
            ->exists();

        return view('staff.attendances.create', [
            'userHasRegisteredAttendance' => $userHasRegisteredAttendance,
        ]);
    }

    public function empStore(Request $request)
    {
        $user_id = auth()->id();
        $action = $request->input('action');

        // Define working hours
        $workingStart = now()->setTime(9, 0, 0); // 9 am

        // Check if there is an existing attendance record for today
        $existingAttendance = Attendance::where('user_id', $user_id)
            ->whereDate('date', Carbon::today())
            ->first();

        if ($existingAttendance && $action === 'clock_in' && $existingAttendance->check_in_time) {
            // If there's an existing record, the action is 'clock_in', and check_in_time is already set,
            // it means the user has already checked in, so prevent them from checking in again.
            $message = 'You have already checked in for the day.';
        } elseif ($existingAttendance && $action === 'clock_out') {
            // If there's an existing record and the action is 'clock_out', update the 'check_out_time'
            $existingAttendance->update(['check_out_time' => now()]);
            $message = 'Clock Out successful!';
        } elseif (!$existingAttendance && $action === 'clock_in') {
            // If no existing record and the action is 'clock_in', create a new attendance record with 'check_in_time'
            $checkInTime = now();

            // Check if the check-in time is before working hours (9 am)
            $status = $checkInTime < $workingStart ? 'present' : 'late';

            Attendance::create([
                'user_id' => $user_id,
                'check_in_time' => $checkInTime,
                'date' => Carbon::today(),
                'status' => $status,
            ]);

            $message = 'Clock In successful!';
        } else {
            // Handle other cases or show an error message
            $message = 'Invalid action or duplicate entry.';
        }

        return redirect()->route('staff.dashboard')->with('success', $message);
    }
}
