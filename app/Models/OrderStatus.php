<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'order_statuses';

    // Define primary key
    protected $primaryKey = 'order_status_id';

    // Define the fillable fields
    protected $fillable = [
        'order_status',
    ];

    public function order() {
        return $this->hasMany(Order::class);
    }
}
