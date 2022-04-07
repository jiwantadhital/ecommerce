<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    use SoftDeletes;
    protected $table = 'customers';
    protected $fillable = ['name','email','password','photo','dob','perm_address','temp_address','mobile','phone','gender_id','email_verification_code','updated_by'];
    protected $hidden = [
        'password', 'remember_token',
    ];
}
