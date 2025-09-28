<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VisitPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'file_path',
        'type',
        'description',
    ];

    public function visit()
    {
        return $this->belongsTo(Visit::class);
    }
}
