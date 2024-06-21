<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'menu_id',
        'description',
        'content',
        'thumb',
        'active',
        'price',
        'price_sale',
        'price_s',
        'price_l'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}
