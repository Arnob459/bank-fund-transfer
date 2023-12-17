<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'detail' => 'object',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function receiver()
    {
        return $this->belongsTo(User::class,'receiver_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }


    public function scopePending()
    {
        return $this->where('status', 2);
    }

    public function scopeApproved()
    {
        return $this->where('status', 1);
    }

    public function scopeRejected()
    {
        return $this->where('status', 3);
    }
}
