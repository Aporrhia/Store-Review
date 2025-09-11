<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LikedItem extends Model
{
    use HasFactory, SoftDeletes;

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
