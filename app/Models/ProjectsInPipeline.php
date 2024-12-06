<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectsInPipeline extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'capacity', 'created_by', 'updated_by', 'deleted_by'];
}
