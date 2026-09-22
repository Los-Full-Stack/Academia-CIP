<?php

namespace App\Services;

class PasswordStrengthService
{
    public function evaluate(string $password): string
    {
        $length = strlen($password);
        $hasLetters = preg_match('/[a-zA-Z]/', $password);
        $hasNumbers = preg_match('/[0-9]/', $password);
        $hasSymbols = preg_match('/[\W_]/', $password);

        if ($length >= 10 && $hasLetters && $hasNumbers && $hasSymbols) {
            return 'fuerte';
        }

        if ($length >= 8 && $hasLetters && $hasNumbers) {
            return 'media';
        }

        return 'débil';
    }
}