<?php

namespace App\Models;

use App\Data\Enums\CacheKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','slug','price','stock'];

    protected static function booted(): void
    {
        static::created(function () {
            Cache::tags(CacheKey::PRODUCT_LIST_TAG->value)->flush();
        });

        static::updated(function () {
            Cache::tags(CacheKey::PRODUCT_LIST_TAG->value)->flush();
        });
    }
}
