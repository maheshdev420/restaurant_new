<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AddressRequest;
use App\Traits\GetGuardUser;
class userApiController extends Controller
{
    use GetGuardUser;
    protected $userService;

    /**
     * Inject the UserService dependency.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Return Response Function
     */
    public function responseFunction($status, $message, $data = [], $statusCode = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    function socialiteLogin(Request $request){
        $user = $this->userService->socialiteCallbackService($request->all());
        if ($user) {
            $token = $user->createToken($user->email)->plainTextToken;
            $tokenId = explode('|', $token);
            DB::table('device_token')->insert([
                'device_token' => $request->device_token,
                'access_token_id' => $tokenId[0],
            ]);
            return $this->responseFunction(true, 'User login successfully ', ['token' => $token]);
        } else {
            return $this->responseFunction(false, 'User credentials not match.', [], 401);
        }
    }

    /**
     *Login User 
     */
    public function userLogin(UserRequest $request)
    {
        $user = $this->userService->LoginUserService($request->all());
        if ($user) {
            $token = $user->createToken($user->email)->plainTextToken;
            $tokenId = explode('|', $token);
            DB::table('device_token')->insert([
                'device_token' => $request->device_token,
                'access_token_id' => $tokenId[0],
            ]);
            return $this->responseFunction(true, 'User login successfully ', ['token' => $token]);
        } else {
            return $this->responseFunction(false, 'User credentials not match.', [], 401);
        }

    }
    /**
     *Stor  User Data 
     */
    public function storeFrontUser(UserRequest $request)
    {
        $userInsert = $this->userService->createOrUpdateUser($request->all());
        if ($userInsert) {
            $token = $userInsert->createToken($userInsert->email)->plainTextToken;
            $tokenId = explode('|', $token);
            DB::table('device_token')->insert([
                'device_token' => $request->device_token,
                'access_token_id' => $tokenId[0],
            ]);
            return $this->responseFunction(true, 'User created successfully.', ['token' => $token], 201);
        } else {
            return $this->responseFunction(false, 'Something went wrong. Please try again.', [], 400);
        }

    }
    /**
     * Check email in database
     */
    public function passwordEmail(UserRequest $request)
    {
        $verifyEmail = $this->userService->passwordEmailVerifySendOtpService($request->email);
        if ($verifyEmail) {
            return $this->responseFunction(true, 'Otp successfully send .', [], 201);
        } else {
            return $this->responseFunction(false, 'Please enter register email', [], 400);
        }
    }
    /**
     * Verify Otp
     */
    public function VerifyOtp(UserRequest $request)
    {
        $verifyEmail = $this->userService->VerifyOtpService($request->all());
        if ($verifyEmail['status']) {
            return $this->responseFunction($verifyEmail['status'], $verifyEmail['message'], [], 201);
        } else {
            return $this->responseFunction($verifyEmail['status'], $verifyEmail['message'], [], 400);
        }
    }
    /**
     * email verify send otp
     */
    public function signUpEmailverify(UserRequest $request)
    {
        $verifyEmail = $this->userService->emailVerifyStoreService($request->email);
        if ($verifyEmail) {
            return $this->responseFunction(true, 'Otp successfully send', [], 201);
        } else {
            return $this->responseFunction(false, 'Something went wrong', [], 400);
        }
    }
    /**
     *Update  User Data 
     */
    public function updateUserProfile(UserRequest $request)
    {
        $userUpdate = $this->userService->createOrUpdateUser($request->all());

        if ($userUpdate) {
            return $this->responseFunction(true, 'Profile successfully Updated.', 200);
        } else {
            return $this->responseFunction(false, 'Something went wrong. Please try again.');
        }
    }
    /**
     *View User Profile 
     */
    public function viewUserProfile()
    {
        $userProfile = $this->userService->viewUserProfileService();

        if ($userProfile) {
            return $this->responseFunction(true, 'Profile successfully fatch', ['profile' => $userProfile], 200);
        } else {
            return $this->responseFunction(false, 'Something went wrong. Please try again.');
        }
    }

    /**
     *Delete User 
     */
    public function destroyFrontUser()
    {
        $userDelete = $this->userService->removeUser();

        if ($userDelete) {
            return $this->responseFunction(true, 'User successfully delete');
        } else {
            return $this->responseFunction(false, 'Something went wrong. Please try again.');
        }
    }
    /**
     * User Logout
     */

    public function userLogout()
    {
        $userLogout = $this->userService->LogoutUserService();

        if ($userLogout) {
            return $this->responseFunction(true, 'User successfully Logout');
        } else {
            return $this->responseFunction(false, 'Something went wrong.');
        }
    }
    /**
     * User Password Update
     */

    public function userPasswordUpdate(UserRequest $request)
    {
        $PasswordUpdate = $this->userService->passwordUpdateService($request->all());

        if ($PasswordUpdate) {
            return $this->responseFunction(true, 'User successfully Update Password');
        } else {
            return $this->responseFunction(false, 'Something went wrong.');

        }
    }

    // Show Address List
    public function showAddressList()
    {
        $addresses = $this->userService->fetchAllAddressesService();
        if (count($addresses) > 0) {
            return $this->responseFunction(true, 'User address fatch', ['address' => $addresses], 200);
        } else {
            return $this->responseFunction(false, 'Something went wrong.', [], 404);
        }
    }

    // Show Address Creation Form
    public function showCreateAddressForm()
    {
        return view('front.address.create');
    }

    // Store Address Data
    public function storeAddress(AddressRequest $request)
    {
        $addressData = $request->validated();

        $addressInsert = $this->userService->createOrUpdateAddress($addressData); // Updated function name

        if ($addressInsert) {
            return redirect()->route('front.address.list')->with('flash-success', 'Address added successfully.');
        } else {
            return back()->with('flash-error', 'Something went wrong.');
        }
    }

    // Edit Address
    // public function editAddress($id)
    // {
    //     $address = $this->userService->getAddressById($id); // Updated function name

    //     if ($address) {
    //         return view('front.address.edit', compact('address')); // Assuming this is the edit view
    //     } else {
    //         return redirect()->route('front.address.list')->with('flash-error', 'Address not found.');
    //     }
    // }

    // Update Address Data
    public function updateAddress(AddressRequest $request, $id)
    {
        $addressData = $request->validated();

        $addressUpdate = $this->userService->createOrUpdateAddress($addressData); // Updated function name

        if ($addressUpdate) {
            return redirect()->route('front.address.list')->with('flash-success', 'Address updated successfully.');
        } else {
            return back()->with('flash-error', 'Something went wrong.');
        }
    }

    // Delete Address
    public function destroyAddress($id)
    {
        $data = $this->userService->removeUserAddress($id); // Updated function name

        if ($data) {
            return redirect()->route('front.address.list')->with('flash-success', 'Address deleted successfully.');
        } else {
            return back()->with('flash-error', 'Something went wrong.');
        }
    }
}
