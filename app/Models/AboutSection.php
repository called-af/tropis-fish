<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    /** @use HasFactory<\Database\Factories\AboutSectionFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected $fillable = [
        'title',
        'description_1',
        'description_2',
        'image_path',
        'feature_1_title',
        'feature_1_description',
        'feature_1_icon',
        'feature_2_title',
        'feature_2_description',
        'feature_2_icon',
        'feature_3_title',
        'feature_3_description',
        'feature_3_icon',
        'feature_4_title',
        'feature_4_description',
        'feature_4_icon',
        'is_active',
        'order',
    ];
}
