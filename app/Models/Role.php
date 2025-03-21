<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'roles';

    // Define primary key
    protected $primaryKey = 'role_id';

    // Define the fillable fields
    protected $fillable = [
        'role',
    ];

    // Represent a one-to-many relationship with the User model
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
