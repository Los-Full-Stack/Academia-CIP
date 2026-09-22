<?php

namespace App\Services;

use App\Contracts\CouponRepository;
use InvalidArgumentException;

class DiscountService
{
    public function __construct(private CouponRepository $coupons)
    {
    }

    public function calculate(string $code, int $subtotalCents): int
    {
        if ($subtotalCents <= 0) {
            throw new InvalidArgumentException('El subtotal debe ser mayor que cero.');
        }

        if (! $this->coupons->exists($code)) {
            return 0;
        }

        return (int) round($subtotalCents * ($this->coupons->percentageFor($code) / 100));
    }
}