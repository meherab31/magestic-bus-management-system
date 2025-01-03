<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index()
    {
        $routes = Route::all();
        return view('frontend.pages.routes', compact('routes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'starting_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'distance' => 'required|integer|min:1',
        ]);

        Route::create($request->all());

        return redirect()->route('routes.index')->with('success', 'Route added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'starting_point' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'distance' => 'required|integer|min:1',
        ]);

        $route = Route::findOrFail($id);
        $route->update($request->all());

        return redirect()->route('routes.index')->with('success', 'Route updated successfully.');
    }

    public function destroy($id)
    {
        $route = Route::findOrFail($id);
        $route->delete();

        return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
    }
}
