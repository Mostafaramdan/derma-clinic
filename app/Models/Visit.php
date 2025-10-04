<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visit extends Model
{
    use HasFactory, SoftDeletes;

    // Accessor: unified exam data for the form
    public function getExamAttribute()
    {
        // اجمع كل الحقول من الأعمدة + exam_data (لو موجود)
        $exam = [
            'skin_type'        => $this->skin_type,
            'chief_complaint'  => $this->chief_complaint,
            'severity'         => $this->severity,
            'duration'         => $this->duration_bucket,
            'clinical_picture' => null,
            'locations'        => $this->body_spots,
            'dx'               => null,
            'follow_up_at'     => $this->follow_up_on ? ($this->follow_up_on instanceof \Carbon\Carbon ? $this->follow_up_on->format('Y-m-d') : $this->follow_up_on) : null,
        ];
        // لو عندك عمود exam_data (json)
        if (isset($this->exam_data) && is_array($this->exam_data)) {
            $exam = array_merge($exam, $this->exam_data);
        } elseif (isset($this->exam_data) && is_string($this->exam_data)) {
            $decoded = json_decode($this->exam_data, true);
            if (is_array($decoded)) {
                $exam = array_merge($exam, $decoded);
            }
        }
        return $exam;
    }
    use HasFactory, SoftDeletes;

    protected $casts = [
        'body_spots' => 'array',
        'follow_up_on' => 'date',
        'diagnosis' => 'array',
    ];

    protected $fillable = [
        'patient_id','visit_type_id','visit_code','created_by','status',
        'skin_type','chief_complaint','severity','duration_bucket','onset',
        'course','diagnosis','follow_up_on','body_spots',
        'clinical_picture'
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

    public function patientChronicDiseases()
    {
        return $this->hasMany(PatientChronicDisease::class, 'visit_id');
    }
}

