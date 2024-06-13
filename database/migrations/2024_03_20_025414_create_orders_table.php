<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->date('receipt_date');
            $table->time('receipt_time');
            $table->date('finish_date');
            $table->time('finish_time');
            $table->double('weight');
            $table->integer('quantity');
            $table->double('price');
            $table->foreignId('customer_id')->constrained('customers', 'customer_id');
            $table->foreignId('order_status_id')->constrained('order_statuses', 'order_status_id')->onDelete('restrict');
            $table->foreignId('payment_status_id')->constrained('payment_statuses', 'payment_status_id');
            $table->foreignId('machine_id')->constrained('machines', 'machine_id');
            $table->foreignId('time_id')->constrained('times', 'time_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
