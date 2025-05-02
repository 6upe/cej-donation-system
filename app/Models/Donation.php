<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'donor_id',
        'donation_type',
        'donation_amount',
        'donation_currency',
        'transaction_token',
        'transaction_id',
        'company_ref',
        'status',
        'ccd_approval',
        'pnr_id',
    ];

    public function donor()
    {
        return $this->belongsTo(Donor::class);
    }
}

