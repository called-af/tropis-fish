<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockList extends Model
{
    protected $fillable = [
        'code',
        'common_name',
        'scientific_name',
        'size',
        'length',
        'image_path',
    ];
}
