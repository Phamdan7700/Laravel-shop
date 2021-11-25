<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'amount',
        'order_id',
        'total_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
