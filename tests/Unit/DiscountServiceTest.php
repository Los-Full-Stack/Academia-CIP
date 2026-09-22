<?php

namespace Tests\Unit;

use App\Contracts\CouponRepository;
use App\Services\DiscountService;
use Mockery;
use PHPUnit\Framework\TestCase;

class DiscountServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_calcula_descuento_con_cupon_existente(): void
    {
        // Given: Dado un cupón existente 'PROMO15' con un 15% de descuento
        $coupons = Mockery::mock(CouponRepository::class);
        $coupons->shouldReceive('exists')
            ->once()
            ->with('PROMO15')
            ->andReturn(true);

        $coupons->shouldReceive('percentageFor')
            ->once()
            ->with('PROMO15')
            ->andReturn(15);

        $service = new DiscountService($coupons);

        // When: Cuando se calcula el descuento para una matrícula de S/ 100.00 (10000 centavos)
        $descuento = $service->calculate('PROMO15', 10000);

        // Then: Entonces el descuento obtenido debe ser S/ 15.00 (1500 centavos)
        $this->assertSame(1500, $descuento);
    }

    public function test_retorna_cero_si_cupon_no_existe(): void
    {
        // Given: Dado un código de cupón 'NOEXISTE' que no figura en la base de datos
        $coupons = Mockery::mock(CouponRepository::class);
        $coupons->shouldReceive('exists')
            ->once()
            ->with('NOEXISTE')
            ->andReturn(false);

        $coupons->shouldNotReceive('percentageFor');

        $service = new DiscountService($coupons);

        // When: Cuando se intenta procesar el descuento
        $descuento = $service->calculate('NOEXISTE', 10000);

        // Then: Entonces el descuento debe ser 0
        $this->assertSame(0, $descuento);
    }
}