<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

trait GetGuardUser
{
    public function GetUser()
    {
        $guards = ['web', 'sanctum','user'];
        foreach ($guards as $key => $guard) {
            if (Auth::guard($guard)->check()) {
                return ['id'=>Auth::guard($guard)->user()->id,'user'=>Auth::guard($guard)->user(),'guard'=>$guard];
            }
        }
        return ['id'=>0,'user'=>null,'guard'=>null];
    }


}
