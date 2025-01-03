<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role', 'bus_id', 'email', 'phone'];

    // An employee belongs to a bus
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
}
