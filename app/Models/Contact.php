<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = ['name', 'designation', 'priority', 'phone', 'email', 'is_office_bearer', 'office_name', 'office_address'];
}
