<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitAdvice extends Model
{
    protected $table = 'visit_advices';
    protected $fillable = [
        'visit_id',
        'advice_text',
        'sort_order',
    ];
    public $timestamps = true;
}
