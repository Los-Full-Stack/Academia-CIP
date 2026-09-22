<?php

namespace App\Contracts;

interface CouponRepository
{
    public function exists(string $code): bool;
    public function percentageFor(string $code): int;
}