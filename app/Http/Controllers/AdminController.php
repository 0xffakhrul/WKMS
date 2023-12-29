<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        // Retrieve all users
        $users = User::all();

        // Retrieve today's attendance records for all users
        $todayAttendances = Attendance::whereDate('date', Carbon::today())->get();

        return view('admin.dashboard', compact('users', 'todayAttendances'));
    }
}
