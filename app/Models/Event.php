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

        if (isset($inputs['user_id'])) {
            $this->user_id = $inputs['user_id'];
        }

        $this->save();
    }

    public function getIsEventRegisteredAttribute()
    {
        $dateNow = date('Y-m-d');
        $dateEvent = date('Y-m-d', strtotime($this->start_date));

        return $dateNow == $dateEvent;
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
}
