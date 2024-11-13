<?php

namespace App\Repositories;

use App\Models\UsersModel;
use App\Models\Address;
use Hash;
use Illuminate\Support\Facades\DB;
use App\Traits\GetGuardUser;
use Illuminate\Support\Facades\Auth;
use Session;
class UserRepository
{
    use GetGuardUser;
    public function createOrUpdateUser(array $data): UsersModel
    {
        return UsersModel::updateOrCreate(['id' => $data['userId']], $data['userData']);
    }

    public function delete(int $id): bool
    {
        $user = UsersModel::find($id);
        return $user ? $user->delete() : false;
    }
    public function LogoutUserRepo()
    {
        $user = $this->GetUser();

        if ($user['guard'] == 'sanctum') {
            if ($user['user']->currentAccessToken()) {
                $user['user']->currentAccessToken()->delete();
                return true;
            }
            return false;
        } else {
            Auth::guard('user')->logout();
            Session::flush();
            return true;
        }
    }

    public function allUser()
    {
        return UsersModel::all();
    }

    public function createOrUpdateAddress(array $data): Address
    {
        return Address::updateOrCreate(['id' => $data['userId']], $data['userData']);
    }

    public function deleteAddress(int $id): bool
    {
        $address = Address::find($id);
        return $address ? $address->delete() : false;
    }

    public function fetchAllAddressesRepo($id)
    {
        return Address::where('user_id', $id)->get();
    }

    public function LoginUserRepo($credentials)
    {
        $user = UsersModel::where('email', $credentials['email'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
    public function emailVerifyStoreRepo($data)
    {
        $emailVerify = DB::table('verifyotp')->updateOrInsert(
            ['email' => $data['email']],
            [
                'verify' => $data['verify'],
                'sendtime' => $data['time'],
                'otp' => $data['otp']
            ]
        );
        if ($emailVerify) {
            return true;
        } else {
            return false;
        }
    }
    public function verifyOtpRepo($email)
    {
        $getData = DB::table('verifyotp')->where('email', $email)->first();
        if ($getData) {
            return $getData;
        } else {
            return false;
        }
    }
    public function passwordEmailVerifySendOtpRepo($identifier)
    {
        $userVerify = UsersModel::where('email', $identifier)
            ->orWhere('apple_id', $identifier) 
            ->first();

        if ($userVerify) {
            return $userVerify; 
        } else {
            return false; 
        }
    }
    public function passwordUpdateRepo($data)
    {
        if ($this->GetUser()['user'] == null) {

            $updatePassword = UsersModel::where('email', $data['email'])->update(['password' => Hash::make($data['password'])]);
        } else {

            $updatePassword = $this->GetUser()['user']->update(['password' => Hash::make($data['password'])]);
        }
        if ($updatePassword) {
            return true;
        } else {
            return false;
        }
    }
    public function viewUserProfileRepo()
    {
        return $this->GetUser()['user'];
    }
}
