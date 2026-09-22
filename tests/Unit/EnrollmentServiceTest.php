<?php

namespace Tests\Unit;

use App\Contracts\MemberStatusProvider;
use App\Services\EnrollmentService;
use InvalidArgumentException;
use Mockery;
use PHPUnit\Framework\TestCase;

class EnrollmentServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        // Limpieza de dependencias simuladas al finalizar cada prueba
        Mockery::close();
        parent::tearDown();
    }

    public function test_inscribe_correctamente_a_colegiado_habilitado(): void
    {
        // Given: Dado un colegiado con CIP '123456' cuyo estado en el sistema es habilitado
        $memberProvider = Mockery::mock(MemberStatusProvider::class);
        $memberProvider->shouldReceive('isHabilitado')
            ->once()
            ->with('123456')
            ->andReturn(true);

        $service = new EnrollmentService($memberProvider);

        // When: Cuando intenta matricularse al curso de la academia CIP con ID 101
        $result = $service->enroll(cipNumber: '123456', courseId: 101);

        // Then: Entonces la matrícula debe completarse de forma exitosa
        $this->assertTrue($result['enrolled']);
        $this->assertSame('123456', $result['cip']);
        $this->assertSame('Inscripción exitosa', $result['message']);
    }

    public function test_rechaza_inscripcion_si_colegiado_no_esta_habilitado(): void
    {
        // Given: Dado un ingeniero con CIP '999999' que se encuentra inhabilitado
        $memberProvider = Mockery::mock(MemberStatusProvider::class);
        $memberProvider->shouldReceive('isHabilitado')
            ->once()
            ->with('999999')
            ->andReturn(false);

        $service = new EnrollmentService($memberProvider);

        // When: Cuando intenta inscribirse al curso
        try {
            $service->enroll(cipNumber: '999999', courseId: 101);
            $this->fail('La inscripción debió fallar pero fue permitida.');
        } catch (InvalidArgumentException $e) {
            // Then: Entonces se comprueba que se atrapó la excepción y el mensaje correcto
            $this->assertSame('El ingeniero no se encuentra habilitado en el CIP Cusco.', $e->getMessage());
        }
    }
}
