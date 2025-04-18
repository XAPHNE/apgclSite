<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LKHEPPolicy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'downloadLink', 'created_by', 'updated_by', 'deleted_by'];
}
