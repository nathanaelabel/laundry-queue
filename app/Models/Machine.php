<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'machines';

    // Define primary key
    protected $primaryKey = 'machine_id';

    // Define the fillable fields
    protected $fillable = [
        'name',
        'status',
    ];

    // Represent a one-to-one relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'machine_id', 'machine_id');
    }
}
