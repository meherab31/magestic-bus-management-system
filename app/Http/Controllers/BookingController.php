<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Bus;
use App\Models\Schedule;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Fetch bus data and schedules
        $schedules = Schedule::all();

        foreach ($schedules as $schedule) {
            $bus = $schedule->bus;
            $capacity = $bus->capacity;

            // Calculate the number of rows (based on bus capacity, divided by 4 seats per row)
            $rows = ceil($capacity / 4);
            $schedule->rows = $rows;
        }

        return view('frontend.pages.bookings', compact('schedules'));
    }

    public function show(Schedule $schedule)
    {
        $bus = $schedule->bus;
        $capacity = $bus->capacity;

        // Calculate the number of rows (4 seats per row)
        $rows = ceil($capacity / 4);
        $seats = [];

        // Generate seat layout dynamically
        for ($i = 1; $i <= $rows; $i++) {
            $seats[] = [
                'row' => $i,
                'seats' => range(($i - 1) * 4 + 1, min($i * 4, $capacity)),
            ];
        }

        // Fetch already booked seats
        $bookedSeats = $schedule->bookings()->pluck('seat_number')->toArray();

        // Pass necessary data to the view
        return view('bookings.show', compact('schedule', 'bus', 'seats', 'bookedSeats', 'rows'));
    }

    public function store(Request $request, Schedule $schedule)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:15',
            'row' => 'required|integer|min:1',
            'column' => 'required|string|in:A,B,C,D',
            'status' => 'required|in:paid,unpaid', // Validation for payment status
        ]);

        // Map column to seat number (A -> 1, B -> 2, C -> 3, D -> 4)
        $column_map = ['A' => 1, 'B' => 2, 'C' => 3, 'D' => 4];

        $row = $request->input('row');
        $column = $request->input('column');
        $column_number = $column_map[$column];
        $seat_number = ($row * 10) + $column_number;

        // Check if the seat is already booked
        $seatAlreadyBooked = $schedule->bookings()->where('seat_number', $seat_number)->exists();

        if ($seatAlreadyBooked) {
            return redirect()->back()->withErrors(['seat_number' => 'This seat is already booked.']);
        }

        // Store the booking with the payment status
        $booking = Booking::create([
            'schedule_id' => $schedule->id,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'seat_number' => $seat_number,
            'status' => $request->status, // Save the payment status
        ]);

        // Redirect to a success page
        return redirect()->back()->with('success', 'Booking successful!');
    }


}
