<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'title',
        'content',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public static function getActive()
    {
        return self::where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}
