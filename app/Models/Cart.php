<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id'];

    /**
     * Get all of the cart_items for the Cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cart_items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}