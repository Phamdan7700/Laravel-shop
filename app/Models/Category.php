<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'status', 'position'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
