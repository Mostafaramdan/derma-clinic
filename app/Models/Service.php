<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public function label()
    {
        $locale = app()->getLocale();
        if (is_array($this->name)) {
            return $this->name[$locale] ?? $this->name['ar'] ?? reset($this->name) ?? '';
        }
        return $this->name;
    }
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
