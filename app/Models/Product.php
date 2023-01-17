<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'thumbnail',
    ];

    protected static function booted()
    {
        static::created(function ($product) {
            \App\Events\ProductCreated::dispatch($product);
        });
        static::updated(function ($product) {
            \App\Events\ProductUpdated::dispatch($product);
        });
    }
}
