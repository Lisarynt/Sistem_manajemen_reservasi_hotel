<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Booking extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'guest_id', 'room_id', 'booking_code',
        'checkin_date', 'checkout_date',
        'actual_checkin_at', 'actual_checkout_at', 'status'
    ];

    protected $casts = [
        'checkin_date' => 'date',
        'checkout_date' => 'date',
        'actual_checkin_at' => 'datetime',
        'actual_checkout_at' => 'datetime',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'booking_facility')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['guest_id', 'room_id', 'checkin_date', 'checkout_date', 'status'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Booking {$eventName}")
            ->useLogName('booking');
    }
}