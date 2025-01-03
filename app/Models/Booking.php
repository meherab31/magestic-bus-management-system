<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'customer_name',
        'customer_phone',
        'seat_number',
        'status',
    ];

    // A booking belongs to a schedule
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
