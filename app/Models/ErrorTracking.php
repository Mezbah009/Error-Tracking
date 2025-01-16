<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErrorTracking extends Model
{
    use HasFactory;

    protected $table = 'error_trackings'; // Ensure this is the correct table name

    protected $fillable = [
        'developer_id',
        'project_id',
        'date',
        'error_type',
        'solution_description',
        'solution_provided_by',
        'status',
        'comments'
    ];

    // Define the relationship with the Developer model
    public function developer()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the Project model
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}