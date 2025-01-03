<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Bus;
use App\Models\Route;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::with('bus', 'route')->get();
        $buses = Bus::all();
        $routes = Route::all();

        return view('frontend.pages.schedules', compact('schedules', 'buses', 'routes'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i|after:departure_time',
        ]);

        // Manually create the schedule record
        $schedule = new Schedule();
        $schedule->bus_id = $validated['bus_id'];
        $schedule->route_id = $validated['route_id'];
        $schedule->departure_time = $validated['departure_time'];
        $schedule->arrival_time = $validated['arrival_time'];
        $schedule->status = $validated['status'] ?? 'active'; // Default to active if not provided
        $schedule->save(); // Save the record to the database

        return redirect()->route('schedules.index')->with('success', 'Schedule added successfully.');
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'route_id' => 'required|exists:routes,id',
            'departure_time' => 'required|date_format:H:i',
            'arrival_time' => 'required|date_format:H:i|after:departure_time',
        ]);

        // Find the schedule by ID
        $schedule = Schedule::findOrFail($id);

        // Manually update the schedule attributes
        $schedule->bus_id = $validated['bus_id'];
        $schedule->route_id = $validated['route_id'];
        $schedule->departure_time = $validated['departure_time'];
        $schedule->arrival_time = $validated['arrival_time'];
        $schedule->status = $validated['status'] ?? $schedule->status; // Keep previous status if not updated
        $schedule->save(); // Save the updated record to the database

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }


    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
