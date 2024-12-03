<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tender extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['department', 'tender_no', 'description', 'is_archived', 'directory_name', 'financial_year_id', 'created_by', 'updated_by', 'deleted_by'];

    public function financialYear()
    {
        return $this->belongsTo(FinancialYear::class);
    }

    public function tenderFiles()
    {
        return $this->hasMany(TenderFile::class)->orderBy('created_at', 'desc');;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
