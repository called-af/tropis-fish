<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockList extends Model
{
    protected $fillable = [
        'category_id',
        'common_name',
        'scientific_name',
        'length',
        'image_path',
    ];

    /**
     * Get the category that this stock list belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
