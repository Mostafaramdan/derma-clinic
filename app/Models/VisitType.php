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
    if ($locale) {
      $loc = $locale;
    } elseif (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->locale) {
      $loc = \Illuminate\Support\Facades\Auth::user()->locale;
    } else {
      $loc = app()->getLocale();
    }
    return $data[$loc] ?? $data['en'] ?? $data['ar'] ?? '';
  }
}

