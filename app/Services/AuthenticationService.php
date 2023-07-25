<?php

namespace App\Services;

use App\Models\Contact;
use App\Models\User;


class AuthenticationService
{

    public function register($data)
    {
        $user = User::create([
            'username' => $data->username,
            'first_name' => $data->first_name,
            'last_name' => $data->last_name,
            'address' => $data->address,
            'contact_number' => $data->contact_number,
            'password' => $data->password
        ]);

        Contact::create([
            'user_creator' => auth()->id(),
            'user_created' => $user->id

        ]);

        return $user;
    }
}
