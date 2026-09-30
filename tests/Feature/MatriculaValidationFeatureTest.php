<?php

namespace Tests\Feature;

use App\Models\Colegiado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatriculaValidationFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba: Colegiado habilitado y puntual puede validar su matrícula exitosamente.
     */
    public function test_colegiado_habilitado_valida_matricula_exitosamente(): void
    {
        $colegiado = Colegiado::factory()->create([
            'cip' => '123456',
            'nombres' => 'Efrain',
            'apellidos' => 'Portilla',
            'habilitado' => true,
            'cuotas_pendientes' => 0,
        ]);

        $response = $this->postJson(route('matricula.validar-colegiado'), [
            'cip' => '123456',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Colegiado habilitado para matrícula.',
                'data' => [
                    'cip' => '123456',
                    'nombres' => 'Efrain',
                    'condicion' => 'Puntual',
                    'aplica_descuento' => true,
                ],
            ]);
    }

    /**
     * Prueba: Colegiado con más de 2 cuotas pendientes es rechazado con error 422.
     */
    public function test_colegiado_inhabilitado_por_deuda_es_rechazado(): void
    {
        Colegiado::factory()->create([
            'cip' => '999888',
            'habilitado' => true,
            'cuotas_pendientes' => 4,
        ]);

        $response = $this->postJson(route('matricula.validar-colegiado'), [
            'cip' => '999888',
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'condicion' => 'Moroso',
            ]);
    }

    /**
     * Prueba: CIP no encontrado en el padrón retorna 404.
     */
    public function test_cip_no_registrado_retorna_404(): void
    {
        $response = $this->postJson(route('matricula.validar-colegiado'), [
            'cip' => '000000',
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
            ]);
    }
}
