<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitFile extends Model
{
    protected $table = 'visit_files';
    protected $fillable = [
        'visit_id',
        'type',
        'path',
        'mime',
        'size',
    ];
    public $timestamps = true;
}
