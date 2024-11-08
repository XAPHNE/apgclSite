<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = ['name', 'designation', 'priority', 'phone', 'email', 'is_office_bearer', 'office_category', 'office_name', 'office_address'];

    public static function officeCategories()
    {
        return [
            'chairman_and_md' => 'Chairman & MD',
            'other_offices_in_hq' => 'Other Offices in HQ',
            'project_offices' => 'Project Offices',
            'other_offices' => 'Other Offices',
        ];
    }
}
