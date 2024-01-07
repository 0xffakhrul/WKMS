<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Leave;
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

        // Today's attendances
        $todayAttendances = Attendance::where('user_id', $user_id)
            ->whereDate('date', Carbon::today())
            ->paginate(10);

        $todayAttendances->getCollection()->transform(function ($attendance) {
            $attendance->check_in_time = Carbon::parse($attendance->check_in_time)->format('H:i');

            if ($attendance->check_out_time !== null) {
                $attendance->check_out_time = Carbon::parse($attendance->check_out_time)->format('H:i');
            }

            return $attendance;
        });

        $leaves = Leave::where('user_id', auth()->user()->id)->paginate(10);
        $attendances = Attendance::where('user_id', auth()->user()->id)->paginate(10);

        // Calculate working hours
        $workingHours = $this->calculateWorkingHours($attendances);

        return view('staff.dashboard', [
            'userHasRegisteredAttendance' => $userHasRegisteredAttendance,
            'todayAttendances' => $todayAttendances,
            'leaves' => $leaves,
            'attendances' => $attendances,
            'workingHours' => $workingHours,
        ]);
    }

    private function calculateWorkingHours($attendances)
    {
        // Filter attendances for today
        $todayAttendances = $attendances->where('date', Carbon::today()->toDateString());

        // Check if there are any attendance records for today
        if ($todayAttendances->isEmpty()) {
            return 0; // No working hours if no attendance records for today
        }

        $workingHours = 0;

        foreach ($todayAttendances as $attendance) {
            if ($attendance->check_out_time !== null) {
                // If check-out time is available, calculate working hours for each attendance
                $checkIn = Carbon::parse($attendance->check_in_time);
                $checkOut = Carbon::parse($attendance->check_out_time);

                // Assuming a simple calculation for working hours (you might need a more complex logic)
                $workingHours += $checkOut->diffInHours($checkIn);
            }
        }

        return $workingHours;
    }
}
