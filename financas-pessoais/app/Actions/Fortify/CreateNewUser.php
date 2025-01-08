<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'type' => ['required', 'in:admin,client,other'],
            'cep_id' => ['required', 'exists:ceps,id'],
            'address_number' => ['required', 'string'],
            'address_complement' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'preferred_coin_id' => ['nullable', 'exists:coins,id'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $profileImagePath = null;
        if (isset($input['profile_image']) && $input['profile_image'] instanceof \Illuminate\Http\UploadedFile) {
            $profileImagePath = $input['profile_image']->store('profile_images', 'public');
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'type' => $input['type'],
            'cep_id' => $input['cep_id'],
            'address_number' => $input['address_number'],
            'address_complement' => $input['address_complement'],
            'status' => $input['status'],
            'profile_image' => $profileImagePath,
            'preferred_coin_id' => $input['preferred_coin_id'],
        ]);
    }
}