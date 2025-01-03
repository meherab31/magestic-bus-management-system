<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = ['name','bus_number', 'type', 'capacity'];

    // A bus can have many schedules
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // A bus can have multiple employees (drivers/helpers)
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}
