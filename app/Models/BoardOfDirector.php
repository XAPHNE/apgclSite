<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BoardOfDirector extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'designation', 'organisation', 'downloadLink', 'is_chairman', 'is_md', 'is_gov_rep', 'is_indi_ditr', 'created_by', 'updated_by', 'deleted_by'];
}
