<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItemAttribute extends Model
{
    use HasFactory;

    protected $fillable = ['store_item_id', 'attribute_id', 'value'];

    public function storeItem()
    {
        return $this->belongsTo(StoreItem::class);
    }

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }
}
