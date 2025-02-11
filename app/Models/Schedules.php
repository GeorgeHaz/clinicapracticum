<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Carbon\CarbonInterval;

class Schedules extends Model
{
    use HasFactory;

    protected $table = 'schedules';

    protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'interval',
        'active',
    ];

    // Relación con Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'doctor_id');
    }

    public function getTimeSlots()
    {
        $start = Carbon::parse($this->start_time);
        $end = Carbon::parse($this->end_time);
        $interval = $this->interval;

        $slots = [];
        $current = $start->copy();

        while ($current < $end) {
            $slots[] = $current->format('H:i');
            $current->addMinutes($interval);
        }

        return $slots;
    }
}
