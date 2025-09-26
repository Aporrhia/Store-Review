<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'seller_id',
        'store_item_id',
        'order_code',
        'price',
        'quantity',
    ];
    public function seller()
    {
        return $this->belongsTo(\App\Models\User::class, 'seller_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            if (empty($order->order_code)) {
                // Generate a short unique code (base62, 10 chars)
                $order->order_code = self::generateShortCode();
            }
        });
    }

    public static function generateShortCode($length = 10)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $pool[random_int(0, strlen($pool) - 1)];
        }
        return $code;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function storeItem(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(StoreItem::class, 'store_item_id');
    }
}
