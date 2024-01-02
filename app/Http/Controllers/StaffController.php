<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function StaffDashboard()
    {
        $user_id = auth()->id();
        $userHasRegisteredAttendance = Attendance::where('user_id', $user_id)
            ->whereDate('date', Carbon::today())
            ->whereNotNull('check_in_time')
            ->whereNotNull('check_out_time')
            ->exists();

        return view('staff.dashboard', [
            'userHasRegisteredAttendance' => $userHasRegisteredAttendance,
        ]);
    }
}
