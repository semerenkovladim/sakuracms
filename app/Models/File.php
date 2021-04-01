<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class, 'image_product', 'product_id', 'image_id');
    }
}
