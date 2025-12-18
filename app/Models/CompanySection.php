<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySection extends Model
{
    protected $fillable = [
        'type',
        'title',
        'subtitle',
        'main_description_1',
        'main_description_2',
        'main_title_1',
        'main_title_2',
        'images',
        'image_layout',
        'content_blocks',
        'process_steps',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'images' => 'array',
            'content_blocks' => 'array',
            'process_steps' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public static function getByType(string $type): ?self
    {
        return static::where('type', $type)->where('is_active', true)->first();
    }
}
