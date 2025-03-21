<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['subject', 'email_body', 'signature', 'attachment', 'is_birthday', 'is_joining_aniversery', 'is_retirement', 'is_holiday', 'event_id', 'created_by', 'updated_by', 'deleted_by'];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
