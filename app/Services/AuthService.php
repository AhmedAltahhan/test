<?php


namespace App\Services;

use App\Models\User;

class AuthService
{
    // to register a new user
    public function user(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'username' =>  $data['username'],
            'password' => bcrypt($data['password']),
            'is_active' =>  $data['is_active'],
            'type' => $data['type']
        ]);
        return $user;
    }

}
