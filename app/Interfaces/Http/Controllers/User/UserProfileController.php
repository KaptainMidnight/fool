<?php

namespace App\Interfaces\Http\Controllers\User;

use App\Application\DTOs\UserDTO;
use Illuminate\Http\Request;

class UserProfileController
{
    public function __invoke(Request $request): array
    {
        return UserDTO::fromArray(auth()->user())->toArray();
    }
}
