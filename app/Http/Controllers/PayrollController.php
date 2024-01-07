<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $payrolls = Payroll::when($search, function ($query) use ($search) {
            $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('phone_number', 'like', '%' . $search . '%');
            });
        })->paginate(10);

        return view('admin.payrolls.index', compact('payrolls', 'search'));
    }

    public function show(Payroll $payroll)
    {
        $workingHours = $this->calculateWorkingHours($payroll->user);
        return view('admin.payrolls.show', [
            'payroll' => $payroll,
            'workingHours' => $workingHours,
            'userType' => $payroll->user->type,
        ]);
    }

    public function create()
    {
        // Get the current month and year
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        // Get all users
        $users = User::all();

        // Assuming full-time salary is RM1600 and hourly rate for part-timers is RM10
        $fullTimeSalary = 1600;
        $hourlyRate = 10;

        // Calculate and save salaries for each user, only if a payroll entry for the current month doesn't exist
        foreach ($users as $user) {
            // Check if a payroll entry for the current month already exists for this user
            $existingPayroll = Payroll::where('user_id', $user->id)
                ->whereMonth('pay_date', $currentMonth)
                ->whereYear('pay_date', $currentYear)
                ->exists();

            if (!$existingPayroll) {
                $workingHours = $this->calculateWorkingHours($user);

                $salary = $user->type === 'full_time' ? $fullTimeSalary : $workingHours * $hourlyRate;

                // dd($workingHours, $salary);

                // You may want to customize this based on your actual database schema
                Payroll::create([
                    'user_id' => $user->id,
                    'salary' => $salary,
                    'pay_date' => Carbon::now(),
                    'status' => 'released',
                    // Add any other relevant fields
                ]);
            }
        }

        // Add any additional logic or redirection as needed

        return redirect()->route('admin.payrolls.index')
            ->with('success', 'Payroll successfully created!');
    }


    private function calculateWorkingHours(User $user)
    {
        // Assuming you have a relationship between User and Attendance models
        $attendances = $user->attendances;

        // dd($attendances);

        // Check if $attendances is not null before iterating
        if ($attendances) {
            // Get the current month and year
            $currentMonthYear = Carbon::now()->format('Y-m');

            // Calculate total working hours based on check-in and check-out times for part-time users within the current month
            $workingHours = 0;

            foreach ($attendances as $attendance) {
                // dd('CheckIn:', $attendance->check_in_time, 'CheckOut:', $attendance->check_out_time);
                // Check if the user is part-time and the attendance is within the current month and year
                if ($user->type === 'part_time' && Carbon::parse($attendance->check_in_time)->format('Y-m') == $currentMonthYear) {
                    $checkIn = Carbon::parse($attendance->check_in_time);
                    $checkOut = Carbon::parse($attendance->check_out_time);

                    // Calculate the working hours for each attendance
                    $workingHours += $checkOut->diffInHours($checkIn);
                }
            }

            return $workingHours;
        }

        return 0; // Return 0 if there are no attendances
    }

    public function empIndex()
    {
        $payrolls = Payroll::where('user_id', auth()->user()->id)->paginate(10); // Use the paginate method to get 10 leaves per page
        return view('staff.payrolls.index', ['payrolls' => $payrolls]);
    }

    public function empShow(Payroll $payroll)
    {
        $workingHours = $this->calculateWorkingHours($payroll->user);
        return view('staff.payrolls.show', [
            'payroll' => $payroll,
            'workingHours' => $workingHours,
            'userType' => $payroll->user->type,
        ]);
    }
}
