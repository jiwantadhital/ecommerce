<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'order_attributes';
    protected $fillable = ['order_detail_id','product_id','attribute_id','value'];




}
