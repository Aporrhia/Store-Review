<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_number',
        'expiry_date',
        'cardholder_name',
        'security_code'
    ];

    protected $dates = [
        'expiry_date',
    ];

    protected static function booted()
    {
        static::saving(function ($paymentCard) {
            if (strpos($paymentCard->expiry_date, '/') !== false) {
                $expiryParts = explode('/', $paymentCard->expiry_date);
                $paymentCard->expiry_date = sprintf('20%s-%s-01', $expiryParts[1], $expiryParts[0]);
            }
        });

        static::retrieved(function ($paymentCard) {
            $date = date_create($paymentCard->expiry_date);
            $paymentCard->expiry_date = $date ? $date->format('m/y') : $paymentCard->expiry_date;
        });
    }
}