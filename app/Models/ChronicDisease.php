<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChronicDisease extends Model
{
    protected $table = 'chronic_diseases';
    protected $fillable = [
        'name',
        'is_active',
    ];
    protected $casts = [
        'name' => 'array',
        'is_active' => 'boolean',
    ];
    public $timestamps = true;
}
