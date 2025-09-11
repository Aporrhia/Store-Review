<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_item_id',
        'user_id',
        'price',
        'condition',
        'comment',
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
