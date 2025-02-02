<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'first_name', 'last_name', 'dob', 'doj', 'dor', 'email_official', 'email_personal', 'phone', 'created_by', 'updated_by', 'deleted_by'];

    protected $casts = [
        'dob' => 'date',
        'doj' => 'date',
        'dor' => 'date',
        'phonr' => 'string'
    ];

    public static $title = [
        'Mr.',
        'Ms.',
        'Mrs.',
        'Sir',
        'Madam',
        'Dr.',
        'Md.',
        'Shri.',
        'Smt.'
    ];
}
