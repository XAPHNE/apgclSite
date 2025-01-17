<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roster extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description','downloadLink', 'visibility', 'news_n_events', 'new_badge', 'is_header', 'created_by', 'updated_by', 'deleted_by'];
}
