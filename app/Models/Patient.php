<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'ref_code','name','age_years','age_months','gender','marital_status',
        'occupation','address','phone','notes'
    ];

    public function visits(){ return $this->hasMany(Visit::class); }

    public function chronicDiseases()
    {
        return $this->belongsToMany(ChronicDisease::class, 'patient_chronic_disease')
                    ->withPivot(['since','notes'])
                    ->withTimestamps();
    }
}
