<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class RoomType extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name', 'description', 'price_per_night'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'price_per_night'])
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "Tipe Kamar {$eventName}")
            ->useLogName('room_type');
    }
}