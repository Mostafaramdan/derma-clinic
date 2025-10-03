<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function medications()
    {
        return $this->belongsToMany(Medication::class, 'prescription_medication');
    }

    public function advices()
    {
        return $this->belongsToMany(Advice::class, 'prescription_advice');
    }
}
