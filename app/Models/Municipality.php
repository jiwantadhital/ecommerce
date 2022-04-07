<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipality extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'municipalities';
    protected $fillable = ['province_id','district_id','name','status','created_by','updated_by'];

    function  province(){
        return $this->belongsTo(Province::class);
    }

    function  createdBy(){
        return $this->belongsTo(User::class,'created_by');
    }

    function  updatedBy(){
        return $this->belongsTo(User::class,'updated_by');
    }
}
