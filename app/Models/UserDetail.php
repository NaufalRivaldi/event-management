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
        $this->father_name = $inputs['father_name'] ?? null;
        $this->mother_name = $inputs['mother_name'] ?? null;
        $this->address = $inputs['address'] ?? null;
        $this->phone = $inputs['phone'] ?? null;
        $this->age = $inputs['age'] ?? null;
        $this->hobby = $inputs['hobby'] ?? null;
        $this->kesinoman = $inputs['kesinoman'] ?? null;
        $this->user_id = $inputs['user_id'];
        $this->save();
    }

    public function savePhotoUrl($url): void
    {
        $this->photo_url = $url;
        $this->save();
    }
}
