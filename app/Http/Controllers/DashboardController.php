<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\Schedule;

class DashboardController extends Controller
{
    public function index()
    {
        $busesCount = Bus::count();
        $employeesCount = Employee::count();
        $routesCount = Route::count();
        $bookingsCount = Booking::count();
        $recentBookings = Booking::with('schedule.route')->latest()->take(5)->get();
        $frequentRoutes = Route::withCount('schedules')->orderBy('schedules_count', 'desc')->take(5)->get();
        $schedules = Schedule::all();  // Add this line to fetch schedules

        return view('frontend.pages.dashboard', compact('busesCount', 'employeesCount', 'routesCount', 'bookingsCount', 'recentBookings', 'frequentRoutes', 'schedules'));  // Pass schedules data to the view
    }


}
