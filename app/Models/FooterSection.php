<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterSection extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'links',
        'copyright_text',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'links' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public static function getByType(string $type): ?self
    {
        return static::where('type', $type)
            ->where('is_active', true)
            ->first();
    }

    public static function getAllActive(): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('is_active', true)
            ->orderBy('order')
            ->get();
    }
}
