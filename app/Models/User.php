<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'serial',
        'name',
        'status',
        'mobile',
        'password',
        'payment',
        'due',
        'bp_num',
        'work_place_id',
        'section_id',
        'office_joining_date',
        'mess_joining_date',
        'rank',
        'image',
        'brush_number',
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
        'password' => 'hashed',
    ];

    // public function payments()
    // {
    //     return $this->hasMany(Payment::class);
    // }


    const ROLES = [
        2 => 'Admin',
        1 => 'Developer',
    ];


    function getRoleName()
    {
        return static::ROLES[$this->role ?? 1];
    }


    public function errorTrackings()
    {
        return $this->hasMany(ErrorTracking::class);
    }
}