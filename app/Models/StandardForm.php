<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StandardForm extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['description','downloadLink', 'visibility', 'news_n_events', 'new_badge'];
}
