<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Define the table
    protected $table = 'orders';

    // Define the primary key
    protected $primaryKey = 'order_id';

    // Define the fillable columns
    protected $fillable = [
        'receipt_date',
        'receipt_time',
        'finish_date',
        'finish_time',
        'weight',
        'quantity',
        'price',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id', 'customer_id');
    }

    public function orderStatus() {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'order_status_id');
    }

    public function paymentStatus() {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id', 'payment_status_id');
    }

    public function machine() {
        return $this->belongsTo(Machine::class, 'machine_id', 'machine_id');
    }

    public function time() {
        return $this->belongsTo(Time::class, 'time_id', 'time_id');
    }
}
