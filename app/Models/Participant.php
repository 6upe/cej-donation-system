<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'product',
        'amount',
        'currency',
        'ticket_package',
        'delegate_category',
        'province',
        'district',
        'organisation',
        'job_title',
        'referral',
        'transaction_token',
        'payment_status',
        'product_status',
        'ticket_code'
    ];
}
