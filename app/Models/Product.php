<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'size',
        'gender',
        'type',
        'pictureId',
        'price',
        'isAvailable',
    ];

    /**
     * Get the carts associated with the user.
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class);
    }
}
