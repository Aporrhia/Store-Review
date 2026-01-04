<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikedItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'user_id',
    ];

    public function storeItem()
    {
        return $this->belongsTo(StoreItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
