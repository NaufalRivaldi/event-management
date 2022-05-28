<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'is_register',
        'start_time',
        'end_time',
        'start_date',
        'end_date',
        'user_id',
    ];

    public function saveFromInputs(array $inputs): void
    {
        $this->title = $inputs['title'];
        $this->description = $inputs['description'];
        $this->location = $inputs['location'];
        $this->start_date = $inputs['start_date'];
        $this->end_date = $inputs['end_date'];

        if (isset($inputs['is_register'])) {
            $this->is_register = $inputs['is_register'];
            $this->start_time = $inputs['start_time'];
            $this->end_time = $inputs['end_time'];
        } else {
            $this->is_register = false;
            $this->start_time = null;
            $this->end_time = null;
        }

        if (isset($inputs['user_id'])) {
            $this->user_id = $inputs['user_id'];
        }

        $this->save();
    }

    public function getIsEventRegisteredAttribute()
    {
        $dateNow = date('Y-m-d');
        $dateEvent = date('Y-m-d', strtotime($this->start_date));

        $timeNow = date('H:i:s');

        return ($dateNow == $dateEvent)
            && $this->is_register
            && ($timeNow >= $this->start_time && $timeNow <= $this->end_time);
    }

    public function scopeActive($query)
    {
        $query->where('status', true);
    }

    // Relation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function eventRegisters()
    {
        return $this->hasMany(EventRegister::class, 'event_id');
    }

    public function eventImages()
    {
        return $this->hasMany(EventImage::class, 'event_id');
    }
}
