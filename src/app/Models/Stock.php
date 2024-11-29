<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['symbol', 'data'];

    // JSONデータを配列として取得
    protected $casts = [
        'data' => 'array',
    ];
}
