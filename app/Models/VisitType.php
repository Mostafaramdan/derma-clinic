<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitType extends Model
{
  protected $table = 'visit_types';
  protected $fillable = [
    'name',
    'is_active',
  ];
  protected $casts = [
    'name' => 'array',
    'is_active' => 'boolean',
  ];
  public $timestamps = true;

  /**
   * Get the localized name for the visit type.
   */
  public function getNameLocalized($locale = null)
  {
    $data = $this->name ?? [];
    $loc = $locale ?? app()->getLocale();
    return $data[$loc] ?? $data['en'] ?? $data['ar'] ?? '';
  }
}

