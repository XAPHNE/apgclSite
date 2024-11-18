<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TenderFile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['tender_id', 'name', 'downloadLink'];

    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }
}
