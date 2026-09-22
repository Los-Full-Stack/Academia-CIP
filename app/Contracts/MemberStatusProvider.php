<?php

namespace App\Contracts;

interface MemberStatusProvider
{
    /**
     * Consulta si el colegiado CIP está habilitado para capacitarse.
     */
    public function isHabilitado(string $cipNumber): bool;
}