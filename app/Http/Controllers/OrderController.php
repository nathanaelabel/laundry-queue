<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all orders
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Display the form for creating a new order
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'receipt_date' => 'required',
            'receipt_time' => 'required',
            'finish_date' => 'required',
            'finish_time' => 'required',
            'weight' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Display the details of an order
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        // Display the form for editing an order
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Validate the form data
        $request->validate([
            'receipt_date' => 'required',
            'receipt_time' => 'required',
            'finish_date' => 'required',
            'finish_time' => 'required',
            'weight' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        // Update the order in the database
        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
