<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Room extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['room_type_id', 'room_number', 'status', 'image'];

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function images()
    {   
    return $this->hasMany(RoomImage::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['room_number', 'status', 'room_type_id'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Kamar {$eventName}")
            ->useLogName('room');
    }
}