<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    // Display all buses
    public function index()
    {
        $buses = Bus::all();
        return view('frontend.pages.buses', compact('buses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:buses,name',
            'type' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        $serial = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $busNumber = strtoupper($request->name . '-' . $request->type . '-' . $serial);

        Bus::create([
            'name' => $request->name,
            'type' => $request->type,
            'capacity' => $request->capacity,
            'bus_number' => $busNumber,
        ]);

        return redirect()->route('buses.index')->with('success', 'Bus added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:buses,name,' . $id,
            'type' => 'required',
            'capacity' => 'required|integer|min:1',
        ]);

        $bus = Bus::findOrFail($id);

        // Generate a new bus number if name or type changes
        if ($bus->name !== $request->name || $bus->type !== $request->type) {
            $serial = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $bus->bus_number = strtoupper($request->name . '-' . $request->type . '-' . $serial);
        }

        $bus->update([
            'name' => $request->name,
            'type' => $request->type,
            'capacity' => $request->capacity,
        ]);

        return redirect()->route('buses.index')->with('success', 'Bus updated successfully.');
    }


    // Delete a bus
    public function destroy($id)
    {
        Bus::findOrFail($id)->delete();
        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }
}
