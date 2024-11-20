<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'total_quantity',
        'sold_quantity',
        'available_quantity',
        'created_by',
    ];


    /**
     * Set Unique Slug
    */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            // Generate and set a unique slug
            $product->attributes['slug'] = $product->generateUniqueSlug();
        });
    }

    // Generate a 60-character unique token
    private function generateUniqueSlug()
    {
        do {
            $slug = bin2hex(random_bytes(30));
        } while (Product::where('slug', $slug)->exists());

        return $slug;
    }
}
