<?php

namespace App\Services;

use App\Repositories\UserRepository;
// use Illuminate\Support\Carbon;
use Google\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use App\Traits\GetGuardUser;
use Session;
use Laravel\Socialite\Facades\Socialite;

use Carbon\Carbon;
class UserService
{
    use GetGuardUser;
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function createOrUpdateUser(array $data)
    {
        try {
            $password = array_key_exists('password', $data) ? Hash::make($data['password']) : null;
            $userData = [
                'userId' => $data['hidden_user_id'] ?? $this->GetUser()['id'],
                'userData' => [
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'] ?? null,
                    'email' => $data['email'] ?? null,
                    'google_id' => $data['google_id'] ?? null,
                    'apple_id' => $data['apple_id'] ?? null,
                    'facebook_id' => $data['facebook_id'] ?? null,
                    'password' => $password,
                    'phone' => $data['phone'] ?? null,
                    'status' => $data['user_status'] ?? 'active',
                ]
            ];
            $userData['userData'] = Collect($userData['userData'])->filter()->toArray();
            $user = $this->userRepository->createOrUpdateUser($userData);
            return $user;
        } catch (QueryException $e) {
            return $e->getMessage();

        }
    }
    public function LoginUserService($credentials)
    {
        $user = $this->userRepository->LoginUserRepo($credentials);
        return $user;
    }
    public function viewUserProfileService()
    {
        $userProfile = $this->userRepository->viewUserProfileRepo();
        return $userProfile;
    }
    public function socialiteCallbackService($provider)
    {
        try {
            if (is_array($provider)) {

                $password = \Str::before($provider['email'], '@') . rand(1111, 9999);
                $userData = [
                    'first_name' => $provider['first_name'],
                    'email' => $provider['email'],
                    'password' => $password,
                    $provider['provider'] . '_id' => $provider['provider_id']
                ];
                $identifier = $provider['provider'] === 'apple' ? $provider['provider_id'] : $provider['email'];
                $userExist = $this->userRepository->passwordEmailVerifySendOtpRepo($identifier);
            } else {

                $user = Socialite::driver($provider)->user();
                $password = \Str::before($user->email, '@') . rand(1111, 9999);
                $userData = [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'password' => $password,
                    $provider . '_id' => $user->getId()
                ];
                $identifier = $provider === 'apple' ? $user->getId() : $user->getEmail();
                $userExist = $this->userRepository->passwordEmailVerifySendOtpRepo($identifier);
            }

            if ($userExist) {
                return $userExist;
            } else {
                return $this->createOrUpdateUser($userData);

            }
        } catch (\Exception $e) {
            return false;
        }
    }
    public function removeUser()
    {
        return $this->userRepository->delete($this->GetUser()['id']) ? true : false;
    }
    public function LogoutUserService()
    {
        return $this->userRepository->LogoutUserRepo() ? true : false;
    }
    public function passwordUpdateService($data)
    {
        return $this->userRepository->passwordUpdateRepo($data);
    }

    public function fetchAllUsers()
    {
        return $this->userRepository->allUser();
    }
    public function passwordEmailVerifySendOtpService($email)
    {
        $sendOtp = $this->userRepository->passwordEmailVerifySendOtpRepo($email);
        if ($sendOtp) {
            $this->emailVerifyStoreService($email);
        }
        return $sendOtp;
    }
    public function emailVerifyStoreService($email)
    {
        $data = [
            'email' => $email,
            'otp' => rand(1111, 9999),
            'verify' => 'false',
            'time' => Carbon::now()
        ];

        return $this->userRepository->emailVerifyStoreRepo($data);

    }
    public function VerifyOtpService($data)
    {
        $verifyOtp = $this->userRepository->verifyOtpRepo($data['email']);
        if ($verifyOtp) {
            if ($verifyOtp->otp == $data['otp']) {
                if (Carbon::parse($verifyOtp->sendtime)->diffInMinutes(Carbon::now()) < 2) {
                    return ['status' => true, 'message' => 'otp successfully match'];
                } else {
                    return ['status' => false, 'message' => 'otp expire'];
                }
            } else {
                return ['status' => false, 'message' => 'otp not match'];
            }
        } else {
            return ['status' => false, 'message' => 'Some thing want wrong ,Please resend otp'];
        }

    }

    public function createOrUpdateAddress(array $data): bool|string
    {
        try {
            $addressData = [
                'userId' => $data['hidden_user_id'],
                'userData' => [
                    // Assuming similar fields for address creation
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'postcode' => $data['postcode'],
                    'address' => $data['address'],
                    'street_name' => $data['street_name'],
                    'address_second' => $data['address_second'],
                    'city' => $data['city']
                ]
            ];
            $this->userRepository->createOrUpdateAddress($addressData);
            return true;
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }

    public function removeUserAddress(int $id)
    {
        return $this->userRepository->deleteAddress($id) ? true : false;
    }

    public function fetchAllAddressesService()
    {
        return $this->userRepository->fetchAllAddressesRepo($this->GetUser()['id']);
    }

}
