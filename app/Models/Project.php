<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function errorTrackings()
    {
        return $this->hasMany(ErrorTracking::class);
    }
}