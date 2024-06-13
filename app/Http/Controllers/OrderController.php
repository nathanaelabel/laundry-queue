<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Machine;
use App\Models\Customer;
use App\Models\OrderStatus;
use App\Models\PaymentStatus;
use App\Models\Time;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load related models
        $orders = Order::with(['customer', 'orderStatus', 'paymentStatus', 'machine', 'time'])->paginate(10);

        // Debugging
        foreach ($orders as $order) {
            if (!$order->orderStatus) {
                \Log::info('Order missing status', ['order_id' => $order->order_id]);
            }
        }

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

        // Fetch only available machines
        $machines = \App\Models\Machine::where('status', 'Available')->get();

        // Fetch all payment statuses
        $payment_statuses = \App\Models\PaymentStatus::all();

        // Fetch all time entries
        $times = \App\Models\Time::all();

        // Pass customers and order statuses to the view
        return view('orders.create', compact('customers', 'order_statuses', 'machines', 'payment_statuses', 'times'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'receipt_date' => 'required|date_format:Y-m-d',
            'receipt_time' => 'required|date_format:H:i',
            'customer_id' => 'required|exists:customers,customer_id',
            'order_status_id' => 'required|exists:order_statuses,order_status_id',
            'payment_status_id' => 'required|exists:payment_statuses,payment_status_id',
            'machine_id' => 'required|exists:machines,machine_id',
            'time_type' => 'required|exists:times,time_id'
        ]);

        // Parse receipt date and time
        $receiptDateTime = Carbon::createFromFormat('Y-m-d H:i', $validated['receipt_date'] . ' ' . $validated['receipt_time'], 'Asia/Jakarta')
            ->setTimezone('UTC');

        // Fetch the time duration
        $time = \App\Models\Time::where('time_id', $validated['time_type'])->first();

        // Default to 6 hours if not found
        $duration = $time ? Carbon::parse($time->duration)->format('H') : 6;

        // Start the transaction
        DB::transaction(function () use ($validated, $receiptDateTime, $duration, $time) {
            // Check available machines
            $availableMachine = Machine::where('status', 'Available')->first();
            $inUseMachine = Machine::where('status', 'In Use')->orderBy('updated_at', 'asc')->first();

            if ($availableMachine) {
                // If there is an available machine
                $finishDateTime = $receiptDateTime->copy()->addHours($duration);
            } else if ($inUseMachine) {
                // Calculate additional time based on the nearest completion
                $additionalTime = Carbon::parse($inUseMachine->updated_at)->diffInHours($receiptDateTime) % 2;
                $finishDateTime = $receiptDateTime->copy()->addHours($duration + $additionalTime);
            } else {
                // If no machines are available or all are in use, throw an exception
                throw new \Exception('No machines are available. Please try again later.');
            }

            // Create the order
            $order = new Order([
                'receipt_date' => $receiptDateTime->toDateString(),
                'receipt_time' => $receiptDateTime->toTimeString(),
                'finish_date' => $finishDateTime->toDateString(),
                'finish_time' => $finishDateTime->toTimeString(),
                'weight' => $validated['weight'],
                'quantity' => $validated['quantity'],
                'price' => $validated['price'],
                'customer_id' => $validated['customer_id'],
                'order_status_id' => $validated['order_status_id'],
                'payment_status_id' => $validated['payment_status_id'],
                'machine_id' => $validated['machine_id'],
                'time_id' => $time->time_id,
            ]);
            $order->save();

            // Update machine status if needed
            if ($availableMachine) {
                $availableMachine->status = 'In Use';
                $availableMachine->save();
            }
        });

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
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $customers = Customer::all();
        $machines = Machine::all();
        $order_statuses = OrderStatus::all();
        $payment_statuses = PaymentStatus::all();
        $times = Time::all();

        return view('orders.edit', compact('order', 'customers', 'machines', 'order_statuses', 'payment_statuses', 'times'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'receipt_date' => 'required|date',
            'receipt_time' => 'required',
            'finish_date' => 'nullable|date',
            'finish_time' => 'nullable',
            'weight' => 'required|numeric',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'customer_id' => 'required|exists:customers,customer_id',
            'machine_id' => 'required|exists:machines,machine_id',
            'order_status_id' => 'required|exists:order_statuses,order_status_id',
            'payment_status_id' => 'required|exists:payment_statuses,payment_status_id',
            'time_type' => 'required|exists:times,time_id',
        ]);

        // Find the order
        $order = Order::findOrFail($id);

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
