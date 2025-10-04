<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientChronicDisease extends Model
{
    protected $table = 'patient_chronic_disease';
    protected $fillable = [
        'patient_id', 'chronic_disease_id', 'since', 'notes','visit_id', 'note_type'
    ];

    public $timestamps = true;
}
