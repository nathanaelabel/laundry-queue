<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all order statuses
        $orderStatuses = OrderStatus::all();
        return view('order_statuses.index', compact('orderStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Display the form for creating a new order status
        return view('order_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'order_status' => 'required',
        ]);

        // Create a new order status in the database
        OrderStatus::create($request->all());
        return redirect()->route('order_statuses.index')->with('success', 'Order status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderStatus $orderStatus)
    {
        // Display the details of an order status
        return view('order_statuses.show', compact('orderStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderStatus $orderStatus)
    {
        // Display the form for editing an order status
        return view('order_statuses.edit', compact('orderStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderStatus $orderStatus)
    {
        // Validate the form data
        $request->validate([
            'order_status' => 'required',
        ]);

        // Update the order status in the database
        $orderStatus->update($request->all());
        return redirect()->route('order_statuses.index')->with('success', 'Order status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderStatus $orderStatus)
    {
        //
    }
}
