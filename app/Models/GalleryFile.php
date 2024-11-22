<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'downloadLink', 'is_visible'];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}
