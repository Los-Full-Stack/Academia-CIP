<?php

namespace Tests\Feature;

use App\Models\Colegiado;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColegiadoModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Verificar que la factory genera una instancia válida de Colegiado en memoria.
     */
    public function test_la_factory_puede_crear_un_modelo_colegiado(): void
    {
        $colegiado = Colegiado::factory()->make();

        $this->assertInstanceOf(Colegiado::class, $colegiado);
        $this->assertNotEmpty($colegiado->cip);
        $this->assertNotEmpty($colegiado->nombres);
        $this->assertNotEmpty($colegiado->apellidos);
        $this->assertNotEmpty($colegiado->email);
        $this->assertNotEmpty($colegiado->capitulo);
    }

    /**
     * Test 2: Verificar persistencia en base de datos.
     */
    public function test_un_colegiado_puede_guardarse_en_la_base_de_datos(): void
    {
        $colegiado = Colegiado::factory()->create([
            'cip' => '254890',
            'nombres' => 'Carlos Alberto',
            'apellidos' => 'Pérez Quispe',
            'email' => 'cperez@cipcusco.org.pe',
            'capitulo' => 'Ingeniería de Sistemas',
            'habilitado' => true,
            'cuotas_pendientes' => 0,
        ]);

        $this->assertDatabaseHas('colegiados', [
            'id' => $colegiado->id,
            'cip' => '254890',
            'email' => 'cperez@cipcusco.org.pe',
            'capitulo' => 'Ingeniería de Sistemas',
            'habilitado' => 1,
            'cuotas_pendientes' => 0,
        ]);
    }

    /**
     * Test 3: Creación masiva usando count().
     */
    public function test_la_factory_puede_crear_multiples_colegiados(): void
    {
        $colegiados = Colegiado::factory()->count(5)->create();

        $this->assertCount(5, $colegiados);
        $this->assertDatabaseCount('colegiados', 5);
    }

    /**
     * Test 4: Regla de negocio - está habilitado cuando debe 2 cuotas o menos.
     */
    public function test_colegiado_esta_habilitado_si_debe_hasta_dos_cuotas(): void
    {
        $colegiado = Colegiado::factory()->make([
            'habilitado' => true,
            'cuotas_pendientes' => 2,
        ]);

        $this->assertTrue($colegiado->estaHabilitado());
        $this->assertTrue($colegiado->puedeInscribirse());
    }

    /**
     * Test 5: Regla de negocio - inhabilitado si debe más de 2 cuotas.
     */
    public function test_colegiado_esta_inhabilitado_si_debe_mas_de_dos_cuotas(): void
    {
        $colegiado = Colegiado::factory()->make([
            'habilitado' => true,
            'cuotas_pendientes' => 3,
        ]);

        $this->assertFalse($colegiado->estaHabilitado());
        $this->assertFalse($colegiado->puedeInscribirse());
    }

    /**
     * Test 6: Regla de negocio - inhabilitado administrativo.
     */
    public function test_colegiado_inhabilitado_administrativo(): void
    {
        $colegiado = Colegiado::factory()->make([
            'habilitado' => false,
            'cuotas_pendientes' => 0,
        ]);

        $this->assertFalse($colegiado->estaHabilitado());
        $this->assertSame('Inhabilitado Administrativo', $colegiado->condicion());
    }

    /**
     * Test 7: Condición puntual vs moroso.
     */
    public function test_evaluacion_de_condicion_puntual_y_moroso(): void
    {
        $puntual = Colegiado::factory()->puntual()->make();
        $this->assertSame('Puntual', $puntual->condicion());
        $this->assertTrue($puntual->aplicaDescuento());

        $moroso = Colegiado::factory()->make([
            'habilitado' => true,
            'cuotas_pendientes' => 4,
        ]);
        $this->assertSame('Moroso', $moroso->condicion());
        $this->assertFalse($moroso->aplicaDescuento());
    }
}
