<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'payment_statuses';

    // Define the primary key
    protected $primaryKey = 'payment_status_id';

    // Define the fillable columns
    protected $fillable = [
        'payment_status'
    ];

    public function order() {
        return $this->hasMany(Order::class);
    }
}
