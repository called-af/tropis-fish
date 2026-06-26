<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image_path',
        'detail_title',
        'detail_description',
        'detail_image_path',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get the stock lists associated with this category.
     */
    public function stockLists(): HasMany
    {
        return $this->hasMany(StockList::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saved(function (): void {
            Cache::forget('navbar_categories');
        });

        static::deleted(function (): void {
            Cache::forget('navbar_categories');
        });
    }
}
