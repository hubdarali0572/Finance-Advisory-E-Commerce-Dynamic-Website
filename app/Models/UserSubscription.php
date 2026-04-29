<?php

namespace App\Models;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'status',
        'start_date',
        'end_date',
        'price',
        'payment_id',
        'auto_renew',
        'notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }
}
