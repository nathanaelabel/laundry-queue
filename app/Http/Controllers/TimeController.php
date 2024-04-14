<?php

namespace App\Http\Controllers;

use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all times
        $times = Time::all();
        return view('times.index', compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new time
        return view('times.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'type' => 'required',
            'duration' => 'required',
        ]);

        // Create a new time
        Time::create($request->all());
        return redirect()->route('times.index')->with('success', 'Time created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Time $time)
    {
        // Return the view for showing a time
        return view('times.show', compact('time'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Time $time)
    {
        // Return the view for editing a time
        return view('times.edit', compact('time'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Time $time)
    {
        // Validate the request
        $request->validate([
            'type' => 'required',
            'duration' => 'required',
        ]);

        // Update the time
        $time->update($request->all());
        return redirect()->route('times.index')->with('success', 'Time updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Time $time)
    {
        //
    }
}
