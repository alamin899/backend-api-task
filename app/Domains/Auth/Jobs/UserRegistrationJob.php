<?php

namespace App\Domains\Auth\Jobs;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRegistrationJob
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly string $userType="customer",
    )
    {
    }

    public function handle(){
        return User::query()->updateOrCreate([
            'email' => $this->email,
        ],[
            'name' => $this->name,
            'user_type' => $this->userType,
            'password' => Hash::make('password'),
        ]);
    }

}
