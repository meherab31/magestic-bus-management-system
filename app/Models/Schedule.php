<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id', 'route_id', 'departure_time', 'arrival_time', 'status'];

    // A schedule belongs to a bus
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    // A schedule belongs to a route
    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    // A schedule can have many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
