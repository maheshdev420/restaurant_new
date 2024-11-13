<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
// use App\Rules\MatchAdminOldPassword;

use App\Models\AdminUser;

use File;
use Google\Client;







class AdminController extends Controller
{

    public function admin_login_func(Request $request){
        
        // $data = $request->all();
        // dd($data);
       
        $credentials = $request->validate([            
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); 
            return redirect()->route('admin.dashboard');
        }
        // if (Auth::guard('subadmin')->attempt($credentials)) { 
        //     $request->session()->regenerate();          
        //     return redirect()->route('admin.dashboard');
        // } 
 
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }
    

    public function admin_logout_func(Request $request){
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('admin');
        
    }


    public function get_admin_info_func(){
        $GetData['data'] = Auth::user();                
        return view('admin/auth/profile', $GetData);
    }

    public function update_admin_generalinfo(Request $request){
        //$data = $request->all();
        //dd($data);
        $validatedData = $request->validate([
                'username' => 'required',
                'email' => 'required|email',
                'mobile' => 'required|max:10'
            ]);

        $User = AdminUser::find(1);        
        $User->name = $request->username;
        $User->email = $request->email;
        $User->mobile = $request->mobile;      

        $User->save();

        return back()->with('flash-success', 'You Have Successfully Update Your Profile.');
    }

    public function update_admin_password_func(Request $request){
        //$allpass = $request->all();
        //dd($allpass);
        
        $request->validate([
            // 'current_password' => ['required', new MatchAdminOldPassword],
            'current_password' => 'required',
            'password' => 'required|same:confirm_password',
            'confirm_password'=>'required_with:password|same:password|min:6'
        ]);   
           
        #Match The Current Password
        if(!Hash::check($request->current_password, auth()->user()->password)){
            return back()->with("flash-error", "Old Password Does Not Match!");
        }     

        #Update the new Password        
        AdminUser::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);

        return back()->with("flash-success", "Password changed successfully!");
    }

    public function storeImage(Request $request){

        // dd(public_path('images'));
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //$originalname = $request->image->getClientOriginalName(); 
        $fileextension = $request->image->extension();
        $filenename = 'admin'.'.'.$fileextension;          

        //Create directory if not exist
        $path = public_path('/admin-assets/assets/img/profile_img/admin');
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        //Move File
        $request->image->move($path, $filenename);

        $User = AdminUser::find(1);   
        $User->pro_img = $filenename; 
        $User->save();
       
        return response()->json($path);    
        

    }









    // public function sendPushNotification(Request $request)
    // {
    //     //dd('test');

    //     $credentialsFilePath = public_path()."/firebase/filename.json";
    //     //dd($credentialsFilePath);
    //     $client = new \Google_Client();
    //     $client->setAuthConfig($credentialsFilePath);
    //     $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
    //     $apiurl = 'https://fcm.googleapis.com/v1/projects/Project-id/messages:send';
    //     $client->refreshTokenWithAssertion();
    //     $token = $client->getAccessToken();
    //     $access_token = $token['access_token'];
    //     // dd($access_token);
        
    //     $headers = [
    //          "Authorization: Bearer $access_token",
    //          'Content-Type: application/json'
    //     ];

    //     /*
    //     $test_data = [
    //         "title" => "this is test 02",
    //         "description" => "this is test description",
    //     ]; 
    //     $data['data'] =  $test_data;
    //     $data['token'] = 'Device token here';
    
    //     $payload['message'] = $data;
    //     */

    //     $notification = [
    //                         "message" => [
    //                         "token" => "Device token here",
    //                         "notification" => [
    //                             "title"=>"title for notification",
    //                             "body"=>"Body of Notification"
    //                             ]
    //                         ]
    //                     ]; 
    
    //     $payload = $notification;
        
    //     $payload = json_encode($payload);
        
        
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $apiurl);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);       
    //     $response = curl_exec($ch);
    //     dd($response);
    //     $res = curl_close($ch);        
    //     if($res){
    //         return response()->json([
    //                       'message' => 'Notification has been Sent'
    //                ]);
    //     }   
                        



        
    // }



}
