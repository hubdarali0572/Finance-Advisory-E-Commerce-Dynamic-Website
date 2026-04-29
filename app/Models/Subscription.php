<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
  use HasFactory;

  protected $fillable = [
    'title',
    'description',
    'price',
    'duration',
      'start_date',
        'end_date',
    'is_active',
    'created_by',
    'user_id',
    'post_number'
  ];

  protected $casts = [
    'start_date' => 'date', // or 'datetime' if it has time
    'end_date'   => 'date',
  ];
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function userSubscriptions()
  {
    return $this->hasMany(UserSubscription::class);
  }
}
