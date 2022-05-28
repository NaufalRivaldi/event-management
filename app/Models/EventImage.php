<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    use HasFactory;

    public function saveFromInputs(array $inputs): void
    {
        $this->image = $inputs['image'];
        $this->event_id = $inputs['event_id'];

        $this->save();
    }
}
