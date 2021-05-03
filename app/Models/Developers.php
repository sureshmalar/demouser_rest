<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Developers extends Model
{
    use HasFactory;
    protected $table = 'developers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'address',
        'profile_pic',
    ];

    protected $hidden = ['password'];

    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = Hash::make($pass);
    }
   /* public function setProfilePicAttribute($value)
        {
            $this->attributes['profile_pic'] = $value;
        }*/
}
