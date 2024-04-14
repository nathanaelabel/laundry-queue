<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    // Define the table
    protected $table = 'times';

    // Define the primary key
    protected $primaryKey = 'time_id';

    // Define the fillable columns
    protected $fillable = [
        'type',
        'duration',
    ];

    // Represent a one-to-many relationship with the Order model
    public function order() {
        return $this->hasMany(Order::class);
    }
}
