<?php

namespace App\Domains\Auth\Jobs;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

readonly class FindCustomerByAttributesJob
{
    public function __construct(
        private string $key,
        private string $value,
    ) {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): Model|null
    {
        return User::query()
            ->where($this->key, $this->value)
            ->first();
    }
}
