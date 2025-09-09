<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitLab extends Model
{
    protected $table = 'visit_labs';
    protected $fillable = [
        'visit_id',
        'test_name',
        'notes',
        'lab_info',
        'result_file_id',
    ];
    public $timestamps = true;
}
