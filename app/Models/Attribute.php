<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'input_type'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_attribute')->withPivot('required');
    }

    public function storeItemAttributes()
    {
        return $this->hasMany(StoreItemAttribute::class);
    }
}
