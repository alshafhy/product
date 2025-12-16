<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'size_id', 'color_id'];

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public static $rules = [
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'size_id' => 'required|exists:sizes,id',
        'color_id' => 'required|exists:colors,id'
    ];
}
