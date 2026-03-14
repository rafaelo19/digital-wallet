<?php

declare(strict_types=1);

namespace App\Service\Auth;

use App\Entity\User;
use Exception;

class JwtService
{
    /**
     * @var string
     */
    private $secret;

    /**
     * @var int
     */
    private $ttl;

    public function __construct(string $secret, int $ttl)
    {
        $this->secret = $secret;
        $this->ttl = $ttl;
    }

    /**
     * @throws Exception
     */
    public function generateToken(User $user): array
    {
        if ($this->secret === '') {
            throw new Exception('Configuracao JWT invalida!', 500);
        }

        $issuedAt = time();
        $expiresAt = $issuedAt + $this->ttl;
        $payload = [
            'sub' => $user->getId(),
            'email' => $user->getEmail(),
            'iat' => $issuedAt,
            'exp' => $expiresAt,
        ];

        return [
            'token' => $this->encode($payload),
            'expira_em' => $expiresAt,
        ];
    }

    /**
     * @throws Exception
     */
    public function validateToken(string $token): array
    {
        if ($this->secret === '') {
            throw new Exception('Configuracao JWT invalida!', 500);
        }

        $tokenParts = explode('.', $token);
        if (count($tokenParts) !== 3) {
            throw new Exception('Token invalido!', 401);
        }

        [$encodedHeader, $encodedPayload, $encodedSignature] = $tokenParts;
        $signature = $this->base64UrlDecode($encodedSignature);
        $expectedSignature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $this->secret, true);

        if (!hash_equals($expectedSignature, $signature)) {
            throw new Exception('Token invalido!', 401);
        }

        $payload = json_decode($this->base64UrlDecode($encodedPayload), true);
        if (!is_array($payload) || !isset($payload['exp']) || time() >= (int) $payload['exp']) {
            throw new Exception('Token expirado ou invalido!', 401);
        }

        return $payload;
    }

    private function encode(array $payload): string
    {
        $header = [
            'typ' => 'JWT',
            'alg' => 'HS256',
        ];

        $encodedHeader = $this->base64UrlEncode(json_encode($header));
        $encodedPayload = $this->base64UrlEncode(json_encode($payload));
        $signature = hash_hmac('sha256', $encodedHeader . '.' . $encodedPayload, $this->secret, true);

        return $encodedHeader . '.' . $encodedPayload . '.' . $this->base64UrlEncode($signature);
    }

    private function base64UrlEncode(string $value): string
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $value): string
    {
        $remainder = strlen($value) % 4;
        if ($remainder > 0) {
            $value .= str_repeat('=', 4 - $remainder);
        }

        $decoded = base64_decode(strtr($value, '-_', '+/'), true);

        return $decoded === false ? '' : $decoded;
    }
}
