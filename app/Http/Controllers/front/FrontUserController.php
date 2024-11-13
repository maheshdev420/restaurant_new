<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AddressRequest;
use App\Traits\GetGuardUser;
class FrontUserController extends Controller
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
     *Login User 
     */
    public function userLogin(UserRequest $request)
    {
        $user = $this->userService->LoginUserService($request->all());
        if ($user) {
            Auth::guard('user')->Login($user);
            return redirect()->route('front.home')->with('success', 'You are successfully login');
        } else {
            return redirect()->route('front.login.form')->with('error', 'Your credentials not match');
        }

    }
    /**
     *Stor  User Data 
     */
    public function storeFrontUser(UserRequest $request)
    {
        $userInsert = $this->userService->createOrUpdateUser($request->all());
        if ($userInsert) {
            Auth::guard('user')->Login($userInsert);
            return redirect()->route('front.home')->with('success', 'You are successfully register');
        } else {
            return redirect()->route('front.login.form')->with('error', 'Some thing want wrong');
        }

    }


    /**
     *Update  User Data 
     */
    public function updateUserProfile(Request $request)
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
     * Check email in database
     */
    public function passwordEmail(UserRequest $request)
    {
        $verifyEmail = $this->userService->passwordEmailVerifySendOtpService($request->email);
        return response()->json(['status' => $verifyEmail]);
    }
    /**
     * email verify send otp
     */
    public function signUpEmailverify(UserRequest $request)
    {
        $verifyEmail = $this->userService->emailVerifyStoreService($request->email);
        return response()->json(['status' => $verifyEmail]);
    }
    /**
     * Verify Otp
     */
    public function VerifyOtp(UserRequest $request)
    {
        $verifyEmail = $this->userService->VerifyOtpService($request->all());
        return response()->json(['status' => $verifyEmail['status'], 'message' => $verifyEmail['message']]);
    }

    /**
     * User Logout
     */

    public function userLogout()
    {
        $userLogout = $this->userService->LogoutUserService();

        if ($userLogout) {
            return redirect()->route('front.login.form')->with('error', 'Your successfully logout');
        } else {
            return redirect()->route('front.home')->with('error', 'Something Want wrong');
        }
    }
    /**
     * User Password Update
     */

    public function userPasswordUpdate(UserRequest $request)
    {
        $PasswordUpdate = $this->userService->passwordUpdateService($request->all());
        if ($PasswordUpdate) {
            return response()->json(['status' => true, 'message' => 'User successfully Update Password']);
        } else {
            return response()->json(['status' => false, 'message' => 'Something went wrong.']);
        }
    }
    /**
     * Socialite login
     */

    public function socialiteCallback($provider)
    {
        $user = $this->userService->socialiteCallbackService($provider);
        if ($user) {
            Auth::guard('user')->Login($user);
            return redirect()->route('front.home')->with('success', 'You are successfully login');
        } else {
            return redirect()->route('front.login.form')->with('error', 'Your credentials not match');
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
