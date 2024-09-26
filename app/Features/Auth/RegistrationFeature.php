<?php

namespace App\Features\Auth;

 use App\Domains\Auth\Jobs\UserRegistrationJob;
 use App\Http\Resources\UserResource;
 use Symfony\Component\HttpFoundation\Response;

 class RegistrationFeature
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    )
    {
    }

    public function handle(): array
    {
        $customer = (new UserRegistrationJob(name: $this->name,email:  $this->email,password:  $this->password,userType: 'customer'))->handle();
        $token = auth()->attempt([$this->email, $this->password]);
        if (!$token) {
            return [
                'message' => 'Your registration request failed',
                'data' => [],
                'errors' => ['auth' => ['Your registration request failed']],
                'statusCode' => Response::HTTP_BAD_REQUEST
            ];
        }

        return [
            'message' => 'Your Registration request succeeded',
            'data' => [
                'customer' => (new UserResource($customer)),
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ],
            'errors' => [],
            'statusCode' => Response::HTTP_OK,
        ];
    }
}
