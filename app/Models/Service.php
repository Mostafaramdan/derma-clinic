<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';
    protected $fillable = [
        'name',
        'default_price',
        'is_active',
    ];
    protected $casts = [
        'name' => 'array',
        'is_active' => 'boolean',
    ];
    public $timestamps = true;
}
