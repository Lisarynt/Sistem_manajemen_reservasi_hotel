<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Guest extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name', 'email', 'phone', 'id_number', 'address'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'phone', 'id_number'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Tamu {$eventName}")
            ->useLogName('guest');
    }
}