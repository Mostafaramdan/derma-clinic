<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitService extends Model
{
    protected $fillable = [
        'visit_id',
        'service_id',
        'service_name',
        'price',
        'qty',
        'line_total',
    ];
}
