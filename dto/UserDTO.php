<?php

namespace app\dto;

use app\models\User;

class UserDTO
{
    public static function fromUser(User $user): array
    {
        return [
            'id' => $user->id,
            'email' => $user->email,
            'username' => $user->username
        ];
    }
}