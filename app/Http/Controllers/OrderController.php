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
        $orders = Order::paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch customers from the database
        $customers = \App\Models\Customer::all();

        // Fetch order statuses from the database
        $order_statuses = \App\Models\OrderStatus::all();

        // Pass customers and order statuses to the view
        return view('orders.create', compact('customers', 'order_statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'weight' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'customer_id' => 'required',
            'order_status_id' => 'required',
            'payment_status_id' => 'required',
        ]);

        // Check available machines
        $availableMachine = Machine::where('status', 'Available')->first();
        $inUseMachine = Machine::where('status', 'In Use')->orderBy('updated_at', 'asc')->first();

        $receiptDateTime = Carbon::now();

        // Get the type from the request or default to 'Tipe A'
        $timeType = $request->input('time_type', 'Tipe A');

        // Find the time duration based on the type
        $time = \App\Models\Time::where('type', $timeType)->first();
        $duration = $time ? Carbon::parse($time->duration)->format('H') : 6; // default to 6 hours if not found

        if ($availableMachine) {
            // If there is an available machine
            $finishDateTime = $receiptDateTime->copy()->addHours($duration);
        } else if ($inUseMachine) {
            // Calculate additional time based on the nearest completion
            $additionalTime = Carbon::parse($inUseMachine->updated_at)->diffInHours($receiptDateTime) % 2;
            $finishDateTime = $receiptDateTime->copy()->addHours($duration + $additionalTime);
        } else {
            // If no machines are available or all are in use, handle accordingly
            return redirect()->back()->with('error', 'No machines are available. Please try again later.');
        }

        // Create the order
        $order = new Order;
        $order->receipt_date = $receiptDateTime->toDateString();
        $order->receipt_time = $receiptDateTime->toTimeString();
        $order->finish_date = $finishDateTime->toDateString();
        $order->finish_time = $finishDateTime->toTimeString();
        $order->weight = $request->weight;
        $order->quantity = $request->quantity;
        $order->price = $request->price;
        $order->customer_id = $request->customer_id;
        $order->order_status_id = $request->order_status_id;
        $order->payment_status_id = $request->payment_status_id;
        $order->machine_id = $availableMachine->machine_id;  // Assuming a machine is selected
        $order->time_id = $time->id;  // Set the time record
        $order->save();

        // Update machine status if needed
        if ($availableMachine) {
            $availableMachine->status = 'In Use';
            $availableMachine->save();
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
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
