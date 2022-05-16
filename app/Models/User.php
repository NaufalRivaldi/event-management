<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const USER_ADMIN = 1;
    const USER_ANGGOTA = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function saveFromInputs(array $inputs): void
    {
        $this->name = $inputs['name'];
        $this->email = $inputs['email'];

        if (isset($inputs['role_id'])) {
            $this->role_id = $inputs['role_id'];
        }

        $this->save();
    }

    public function savePassword(array $inputs): void
    {
        $this->password = Hash::make($inputs['password']);
        $this->save();
    }

    public function getLevelAttribute()
    {
        if ($this->role_id == self::USER_ADMIN) {
            return 'Admin';
        }

        return 'Anggota';
    }

    public function getIsAnggotaAttribute()
    {
        return $this->role_id == self::USER_ANGGOTA;
    }

    public function getIsAdminAttribute()
    {
        return $this->role_id == self::USER_ADMIN;
    }

    public function hasAbsen($eventId)
    {
        $event = $this->eventRegisters()
            ->where('event_id', $eventId)
            ->first();

        return $event ? true : false;
    }

    // Scope
    public function scopeAdmin($query)
    {
        $query->where('role_id', self::USER_ADMIN);
    }

    public function scopeAnggota($query)
    {
        $query->where('role_id', self::USER_ANGGOTA);
    }

    public function scopeActive($query)
    {
        $query->where('status', true);
    }
    // Relation
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }

    public function eventRegisters()
    {
        return $this->hasMany(EventRegister::class, 'user_id');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
