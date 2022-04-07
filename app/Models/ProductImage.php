<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $fillable = ['product_id','image_name','image_title','status'];

    function  product(){
        return $this->belongsTo(Product::class);
    }
}
