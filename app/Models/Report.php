<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = ['name', 'description','downloadLink', 'visibility', 'news_n_events', 'new_badge', 'created_by', 'updated_by', 'deleted_by'];
}
