<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'photo_url',
        'father_name',
        'mother_name',
        'address',
        'phone',
        'age',
        'hobby',
        'user_id',
    ];

    public function saveFromInputs(array $inputs): void
    {
        $this->father_name = $inputs['father_name'];
        $this->mother_name = $inputs['mother_name'];
        $this->address = $inputs['address'];
        $this->phone = $inputs['phone'];
        $this->age = $inputs['age'];
        $this->hobby = $inputs['hobby'];
        $this->user_id = $inputs['user_id'];
        $this->save();
    }

    public function savePhotoUrl($url): void
    {
        $this->photo_url = $url;
        $this->save();
    }
}
