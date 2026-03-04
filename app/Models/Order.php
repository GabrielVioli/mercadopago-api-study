<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_price',
        'preference_id',
        'status',
    ];

    /**
     * Order belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Order refers to a product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
