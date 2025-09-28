<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'body_spots' => 'array',
        'follow_up_on' => 'date'
    ];

    protected $fillable = [
        'patient_id','visit_type_id','visit_code','created_by','status',
        'skin_type','chief_complaint','severity','duration_bucket','onset',
        'course','diagnosis','diagnosis_notes','follow_up_on','body_spots'
    ];

    public function patient(){ return $this->belongsTo(Patient::class); }
    public function visitType(){ return $this->belongsTo(VisitType::class); }
    public function doctor(){ return $this->belongsTo(User::class,'created_by'); }

    public function medications(){ return $this->hasMany(VisitMedication::class); }
    public function advices(){ return $this->hasMany(VisitAdvice::class); }
    public function labs(){ return $this->hasMany(VisitLab::class); }
    public function files(){ return $this->hasMany(VisitFile::class); }
    public function services(){ return $this->hasMany(VisitService::class); }
    public function invoice(){ return $this->hasOne(Invoice::class); }

    public function photos(){ return $this->hasMany(VisitPhoto::class); }
}

