<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitMedication extends Model
{
    protected $table = 'visit_medications';
    protected $fillable = [
        'visit_id',
        'drug_name',
        'strength',
        'times_per_day',
        'every_hours',
        'duration_days',
        'instructions',
        'sort_order',
    ];
    public $timestamps = true;
}
