<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colegiado extends Model
{
    use HasFactory;

    protected $table = 'colegiados';

    protected $fillable = [
        'cip',
        'nombres',
        'apellidos',
        'email',
        'capitulo',
        'habilitado',
        'cuotas_pendientes',
    ];

    /**
     * Determina si el colegiado está formalmente habilitado.
     * Un colegiado está habilitado si la bandera está en true y no debe más de 2 cuotas.
     */
    public function estaHabilitado(): bool
    {
        return (bool) $this->habilitado && $this->cuotas_pendientes <= 2;
    }

    /**
     * Determina si el colegiado puede inscribirse a cursos de la academia CIP.
     */
    public function puedeInscribirse(): bool
    {
        return $this->estaHabilitado();
    }

    /**
     * Calcula la condición o beneficio del colegiado según sus cuotas y estado.
     */
    public function condicion(): string
    {
        if (!$this->habilitado) {
            return 'Inhabilitado Administrativo';
        }

        if ($this->cuotas_pendientes === 0) {
            return 'Puntual';
        }

        if ($this->cuotas_pendientes <= 2) {
            return 'Regular';
        }

        return 'Moroso';
    }

    /**
     * Aplica descuento del 20% si es colegiado puntual (0 cuotas pendientes) y habilitado.
     */
    public function aplicaDescuento(): bool
    {
        return $this->estaHabilitado() && $this->cuotas_pendientes === 0;
    }
}
