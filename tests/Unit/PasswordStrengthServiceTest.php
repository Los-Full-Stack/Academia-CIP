<?php

namespace Tests\Unit;

use App\Services\PasswordStrengthService;
use PHPUnit\Framework\TestCase;

class PasswordStrengthServiceTest extends TestCase
{
    public function test_evalua_contrasena_debil(): void
    {
        // Given: Dada una contraseña corta de menos de 8 caracteres
        $service = new PasswordStrengthService();
        $password = 'abc12';

        // When: Cuando se evalúa la fortaleza de la clave
        $resultado = $service->evaluate($password);

        // Then: Entonces debe indicar que es débil
        $this->assertSame('débil', $resultado);
    }

    public function test_evalua_contrasena_media(): void
    {
        // Given: Dada una contraseña de al menos 8 caracteres con letras y números
        $service = new PasswordStrengthService();
        $password = 'clave123';

        // When: Cuando se evalúa la fortaleza de la clave
        $resultado = $service->evaluate($password);

        // Then: Entonces debe indicar que es media
        $this->assertSame('media', $resultado);
    }

    public function test_evalua_contrasena_fuerte(): void
    {
        // Given: Dada una contraseña de al menos 10 caracteres con letras, números y símbolos
        $service = new PasswordStrengthService();
        $password = 'CipCusco2026!';

        // When: Cuando se evalúa la fortaleza de la clave
        $resultado = $service->evaluate($password);

        // Then: Entonces debe indicar que es fuerte
        $this->assertSame('fuerte', $resultado);
    }
}