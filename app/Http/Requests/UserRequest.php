<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Route;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $nullable = ['api.user.login', 'front.password.update', 'api.user.password.update', 'front.login', 'front.password.email', 'front.password.verifyOtp','api.password.email','api.password.verifyOtp','api.password.update','api.signUp.email.verify','front.sign.up.email.verify'];
        $emailNullable = ['front.password.update', 'api.user.password.update', 'front.password.verifyOtp','api.password.verifyOtp','api.user.update'];
        $emailRequired = ['api.user.login', 'front.login', 'front.password.email','api.password.email'];
        $passwordNullable = ['admin.editusers', 'ront.password.email', 'front.password.verifyOtp','api.password.email','api.password.verifyOtp','api.signUp.email.verify','api.user.update','front.password.email','front.sign.up.email.verify'];
        $confirmPasswordRequired = ['api.user.password.update', 'front.password.update'];
        $currentRoute = Route::currentRouteName();
        return [
            'first_name' => in_array($currentRoute, $nullable) ? 'nullable' : 'required',
            'last_name' => in_array($currentRoute, $nullable) ? 'nullable' : 'required',
            'phone' => in_array($currentRoute, $nullable) ? 'nullable' : 'required',
            'email' => in_array($currentRoute, $emailRequired) ? 'required|email' : (in_array($currentRoute, $emailNullable) ? 'nullable' : 'required|email|unique:users_models,email,' . $this->hidden_user_id),
            'password' => in_array($currentRoute, $passwordNullable) ? 'nullable' : 'required',
            'confirm_password' => in_array($currentRoute, $confirmPasswordRequired) ? 'required|same:password' : 'nullable',
            'otp' => request()->routeIs('front.password.verifyOtp') || request()->routeIs('api.password.verifyOtp')? 'required|integer' : 'nullable',
            'device_token' => request()->routeIs('api.user.store') || request()->routeIs('api.user.login')? 'required' : 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.email' => 'Enter a valid email.',
            'email.unique' => 'This email is already taken.',
            'first_name.required' => 'First name is required.',
            'first_name.string' => 'The first name must be a valid string.',
            'last_name.required' => 'Last name is required.',
            'last_name.string' => 'The first name must be a valid string.',
            'phone.required' => 'Phone number is required.',
            'password.required' => 'Password is required.',
            'confirm_password.required' => 'Please confirm your password.',
            'confirm_password.same' => 'The passwords and confirm password must match.',
            'device_token.required' => 'Device token required.',
        ];
    }



}
