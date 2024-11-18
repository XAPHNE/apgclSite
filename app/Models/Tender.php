<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['tender_no', 'description', 'is_archived', 'financial_year_id'];

    public function financialYear()
    {
        return $this->belongsTo(FinancialYear::class);
    }

    public function tenderFiles()
    {
        return $this->hasMany(TenderFile::class);
    }
}
