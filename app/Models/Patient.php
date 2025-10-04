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
        'job','address','phone','notes'
    ];

    public function visits(){ return $this->hasMany(Visit::class); }

    public function chronicDiseases()
    {
        return $this->belongsToMany(ChronicDisease::class, 'patient_chronic_disease')
                    ->withPivot(['since','notes'])
                    ->withTimestamps();
    }

    public function updateChronicDiseases(array $data)
    {
        $syncData = [];
        foreach ($data as $field => $value) {
            if (str_starts_with($field, 'chronic_') && is_numeric($value)) {
                $syncData[] = [
                    'chronic_disease_id' => (int) str_replace('chronic_', '', $field),
                    'patient_id' => $this->id,
                    'since' => $value ? now()->toDateString() : null
                ];
            }else{
                $syncData[] = [
                    'notes' => $data['other_diseases'] ?? null,
                    'patient_id' => $this->id,
                    'since' => null
                ];
            }
        }
        ChronicDisease::insert($syncData);
    }
}
