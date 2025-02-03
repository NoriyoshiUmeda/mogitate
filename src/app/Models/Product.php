<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price',  'description', 'image'];

    
    public function seasons() //多対多
    {
        return $this->belongsToMany(Season::class, 'product_season', 'product_id', 'season_id');
    }

    public function products()
{
    return $this->belongsToMany(Product::class, 'product_season', 'season_id', 'product_id');
}

}

