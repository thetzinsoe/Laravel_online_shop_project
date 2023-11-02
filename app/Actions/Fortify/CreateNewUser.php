<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'gender' => ['required'],
            'address' => ['required'],
            'password' => $this->passwordRules(),
            'password_confirmation' => 'required',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        $imgName = '';
        if(isset($input['image'])){
            $imgName = uniqid().'_'.$input['image']->getClientOriginalName();
            ($input['image'])->storeAs('public/'.$imgName);
        }
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'gender' => $input['gender'],
            'address' => $input['address'],
            'password' => Hash::make($input['password']),
            'image' => $imgName,
        ]);

    }
}
