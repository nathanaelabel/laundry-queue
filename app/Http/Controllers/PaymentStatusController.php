<?php

namespace App\Http\Controllers;

use App\Models\PaymentStatus;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all payment statuses
        $paymentStatuses = PaymentStatus::all();
        return view('payment_statuses.index', compact('paymentStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Display the form for creating a new payment status
        return view('payment_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'payment_status' => 'required',
        ]);

        // Create a new payment status in the database
        PaymentStatus::create($request->all());
        return redirect()->route('payment_statuses.index')->with('success', 'Payment status created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentStatus $paymentStatus)
    {
        // Display the details of a payment status
        return view('payment_statuses.show', compact('paymentStatus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentStatus $paymentStatus)
    {
        // Display the form for editing a payment status
        return view('payment_statuses.edit', compact('paymentStatus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentStatus $paymentStatus)
    {
        // Validate the form data
        $request->validate([
            'payment_status' => 'required',
        ]);

        // Update the payment status in the database
        $paymentStatus->update($request->all());
        return redirect()->route('payment_statuses.index')->with('success', 'Payment status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentStatus $paymentStatus)
    {
        //
    }
}
