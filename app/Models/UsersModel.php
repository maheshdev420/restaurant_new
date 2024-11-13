<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
class UsersModel extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;
    protected $table = 'users_models';
    protected $hidden = [
        'password','deleted_at'
    ];

    protected $fillable = ['last_name', 'first_name', 'email', 'password', 'pro_img', 'country', 'phone', 'status','apple_id','google_id','facebook_id'];

    public function getFirstNameAttribute()
    {
        return ucfirst($this->attributes['first_name']);
    }
    public function getProImgAttribute()
    {
        if (!empty($this->attributes['pro_img']) || $this->attributes['pro_img'] != null) {
            $image = asset($this->attributes['pro_img']);
        } else {
            $image = asset('front/user-images/user_dummy_img.webp');
        }
        return $image;
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['created_at'])->format('d-m-Y');
    }
    public function getUpdatedAtAttribute(){
        return Carbon::parse($this->attributes['updated_at'])->format('d-m-Y');
    }
}
