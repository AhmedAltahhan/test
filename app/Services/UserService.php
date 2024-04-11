<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    // to show all users
    public function all()
    {
        $users = User::with('media')->get();
        return $users;
    }

    // to update a user
    public function update($id,$data)
    {
        $user = User::whereId($id)->update($data);
        return $user;
    }

    // to create a new user
    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        return $user;
    }

    // to show a product
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return $user;
    }

    // to delete a user
    public function destroy(string $id)
    {
        User::whereId($id)->delete();
    }
}
