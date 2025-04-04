<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OngoingProjects extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'location', 'capacity', 'link', 'created_by', 'updated_by', 'deleted_by'];
}
