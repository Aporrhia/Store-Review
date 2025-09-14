<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attribute;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'category_attribute')->withPivot('required');
    }

    public function storeItems()
    {
        return $this->hasMany(StoreItem::class);
    }
}
