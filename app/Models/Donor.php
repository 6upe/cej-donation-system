<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'address',
        'phone_number',
        'organization_name',
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}

