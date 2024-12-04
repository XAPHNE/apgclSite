<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['gallery_category', 'event_name', 'event_description', 'thumbnail', 'is_visible', 'created_by', 'updated_by', 'deleted_by'];

    public static $galleryCategory = [
        'Home Page Slider',
        'Power Stations',
        "Minister's Visit",
        'Social Responsibility & Allied Activities',
        'Industrial Meets, Seminars & Workshops',
        'Other Events',
    ];

    public function galleryFiles()
    {
        return $this->hasMany(GalleryFile::class)->orderBy('created_at', 'desc');;
    }
}
