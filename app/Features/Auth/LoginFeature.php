<?php

namespace App\Features\Auth;

use App\Domains\Auth\Jobs\FindCustomerByAttributesJob;
use App\Domains\Auth\Operations\PasswordVerifyOperation;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;

readonly class LoginFeature
{
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }

    public function handle(): array
    {
        $user = (new FindCustomerByAttributesJob(key: 'email',value: $this->email))->handle();

        if (!$user){
            return [
                'message' => 'Unauthenticated',
                'data' => [],
                'errors' => ['auth' => ['Your email or password is incorrect.']],
                'statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY
            ];
        }

        $response = (new PasswordVerifyOperation(requestPassword: $this->password, dbPassword: $user->password))->handle();

        if (!$response) {
            return [
                'message' => 'Unauthenticated',
                'data' => [],
                'errors' => ['auth' => ['Your email or password is incorrect.']],
                'statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY
            ];
        }

        $token = auth('api')->login($user);

        return [
            'message' => 'Login succeeded',
            'data' => [
                'customer' => (new UserResource($user)),
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth('api')->factory()->getTTL() * 60
            ],
            'errors' => [],
            'statusCode' => Response::HTTP_OK,
        ];
    }

}
