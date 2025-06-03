<?php

namespace App\Infrastructure\Persistence\Database;

use App\Domain\Auth\Entities\User;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\DB;

class UserStorage
{
    public function findByTelegramId(int $telegramId): ?User
    {
        $userModel = UserModel::query()->where('telegram_id', $telegramId)->first();
        if (!$userModel) {
            return null;
        }

        return new User(
            name: $userModel->name,
            surname: $userModel->surname,
            telegramId: $userModel->telegram_id,
            username: $userModel->username,
        );
    }

    public function save(User $user): void
    {
        DB::transaction(function () use ($user) {
            UserModel::query()->updateOrCreate(
                ['telegram_id' => $user->getTelegramId()],
                [
                    'name' => $user->getName(),
                    'surname' => $user->getSurname(),
                    'username' => $user->getUsername(),
                ]
            );
        });
    }
}
