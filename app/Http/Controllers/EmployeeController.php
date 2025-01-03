<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Bus;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // Fetch employees and buses (for bus dropdown)
        $employees = Employee::with('bus')->get();
        $buses = Bus::all();

        return view('frontend.pages.employee', compact('employees', 'buses'));
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string',
            'role' => 'required|string|in:driver,helper', // Only 'driver' or 'helper' roles
            'bus_id' => 'nullable|exists:buses,id',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string',
        ]);

        // Manually store the employee data
        $employee = new Employee();
        $employee->name = $validated['name'];
        $employee->role = $validated['role'];
        $employee->bus_id = $validated['bus_id'];
        $employee->email = $validated['email'];
        $employee->phone = $validated['phone'] ?? null;
        $employee->save(); // Save the employee record

        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string',
            'role' => 'required|string|in:driver,helper',
            'bus_id' => 'nullable|exists:buses,id',
            'email' => 'required|email|unique:employees,email,' . $id,
            'phone' => 'nullable|string',
        ]);

        // Find the employee and update data
        $employee = Employee::findOrFail($id);
        $employee->name = $validated['name'];
        $employee->role = $validated['role'];
        $employee->bus_id = $validated['bus_id'];
        $employee->email = $validated['email'];
        $employee->phone = $validated['phone'] ?? null;
        $employee->save(); // Save the updated record

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy($id)
    {
        // Delete the employee
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
}
