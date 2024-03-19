<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'customers';

    // Define primary key
    protected $primaryKey = 'customer_id';

    // Define the fillable fields
    protected $fillable = [
        'name',
        'phone_number',
        'address',
    ];

    // Represent a one-to-many relationship with the Order model.
    // public function order()
    // {
    //     return $this->hasMany(Order::class);
    // }
}
