<?php

namespace app\helpers;

use app\dto\UserDTO;
use app\models\User;

class JWTHelper
{
    private string $secretKey;

    public function __construct()
    {
        $this->secretKey = getenv('JWT_SECRET');
    }

    public function encode(User $user)
    {
        $header = json_encode([
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]);

        $payload = json_encode(UserDTO::fromUser($user));

        $encodedHeader = base64_encode($header);
        $encodedPayload = base64_encode($payload);

        $encodedHeader = rtrim(strtr($encodedHeader, '+/', '-_'), '=');
        $encodedPayload = rtrim(strtr($encodedPayload, '+/', '-_'), '=');

        $signature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $this->secretKey, true);
        $encodedSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

        return $encodedHeader . '.' . $encodedPayload . '.' . $encodedSignature;
    }

    private function decode(string $token): array|\Exception
    {
        list($encodedHeader, $encodedPayload, $encodedSignature) = explode('.', $token);

        $decodedHeader = base64_decode(strtr($encodedHeader, '-_', '+/'));
        $header = json_decode($decodedHeader, true);

        $decodedPayload = base64_decode(strtr($encodedPayload, '-_', '+/'));
        $payload = json_decode($decodedPayload, true);

        $signature = base64_decode(strtr($encodedSignature, '-_', '+/'));

        $validSignature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $this->secretKey, true);
        if ($signature !== $validSignature) {
            throw new \Exception("Invalid signature");
        }

        return [
            'header' => $header,
            'payload' => $payload
        ];
    }
}