<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manufacturer',
        'price',
        'price_sale',
        'status',
        'content',
        'detail',
        'thumbnail',
        'img_list',
        'view',
        'count_in_sock',
        'rate',
        'count',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

    public function scopeActive($query)
    {
        $query->where('status', 1);
    }
}
