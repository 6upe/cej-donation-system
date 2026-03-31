<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'transaction_token',
        'transaction_ref',
        'amount',
        'currency',
        'payment_method',
        'mno',
        'mno_country',
        'status',
        'response_message',
        'raw_response',
        'paid_at',
    ];

    protected $casts = [
        'raw_response' => 'array',
        'paid_at' => 'datetime',
    ];

    // Relationship
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
