<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = ['starting_point', 'destination', 'distance'];

    // A route can have many schedules
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
