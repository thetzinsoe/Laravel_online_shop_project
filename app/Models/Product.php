<?php

namespace App\Models;

use BaconQrCode\Renderer\RendererStyle\Fill;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'price',
        'waiting_time',
        'view_count',
    ];
}
