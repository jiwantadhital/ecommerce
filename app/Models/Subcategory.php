<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Product;

class Subcategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'subcategories';
    protected $fillable = ['category_id','name','slug','rank','short_description','description','image','meta_title','meta_keyword','meta_description','status','created_by','updated_by'];

    function  category(){
        return $this->belongsTo(Category::class);
    }

    function createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    function updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }

    function products(){
        return $this->hasMany(Product::class);
    }

}
