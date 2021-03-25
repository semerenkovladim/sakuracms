<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    public function product_translations() {
        return $this->hasMany(ProductTranslation::class);
    }

    public function category_translations() {
        return $this->hasMany(CategoryTranslation::class);
    }
}
