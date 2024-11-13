<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\UsersModel;
use Mail;
use App\Mail\WelcomeMail;
use App\Services\UserService;

class UsersController extends Controller
{
    protected $userService;

    /**
     * Inject the UserService dependency.
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function get_users_list() {  
        $users_list = $this->userService->fetchAllUsers();  // Updated function name
        return view('admin/users/index', compact('users_list'));
    }

    public function insert_users(UserRequest $request) {
        $userInsert = $this->userService->createOrUpdateUser($request->all()); // Updated function name

        if ($userInsert) {
            return back()->with('flash-success', 'You Have Successfully Added A User.');
        } else {
            return back()->with('flash-error', 'something went wrong.');
        }
    }

    public function check_email_existance(Request $request) {
        $formdata = $request->all();
        if ($request['existance_type'] == 'uemail') {             
            $checkuser = UsersModel::where('email', '=', $request['useremail'])->count(); 
            if ($checkuser == 0) {
                echo 'true';    // Good To Register
            } else {
                echo 'false';    // Already Registered
            }
        }
    }

    public function edit_users(UserRequest $request) {
        $userInsert = $this->userService->createOrUpdateUser($request->all()); // Updated function name

        if ($userInsert) {
            return back()->with('flash-success', 'You Have Successfully Updated A User.');
        } else {
            return back()->with('flash-error', 'something went wrong.');
        }
    }

    public function delete_users($id) {
        $data = $this->userService->removeUser($id); // Updated function name
        if ($data) {   
            return back()->with('flash-success', 'You Have Successfully Deleted A User.');
        } else {
            return back()->with('flash-error', 'something went wrong.');
        }
    }
}
