<?php

namespace App\Domains\Auth\Operations;

use Illuminate\Support\Facades\Hash;

readonly class PasswordVerifyOperation
{
    public function __construct(
        private string $requestPassword,
        private string $dbPassword
    ) {
        //
    }

    /**
     * Execute the operation.
     */
    public function handle(): bool
    {
        return Hash::check($this->requestPassword, $this->dbPassword);
    }
}
