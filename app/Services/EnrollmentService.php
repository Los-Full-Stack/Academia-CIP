<?php

namespace App\Services;

use App\Contracts\MemberStatusProvider;
use InvalidArgumentException;

class EnrollmentService
{
    public function __construct(
        private MemberStatusProvider $memberProvider
    ) {}

    public function enroll(string $cipNumber, int $courseId): array
    {
        if (empty(trim($cipNumber))) {
            throw new InvalidArgumentException('El número de CIP es requerido.');
        }

        if (! $this->memberProvider->isHabilitado($cipNumber)) {
            throw new InvalidArgumentException('El ingeniero no se encuentra habilitado en el CIP Cusco.');
        }

        return [
            'enrolled' => true,
            'cip' => $cipNumber,
            'course_id' => $courseId,
            'message' => 'Inscripción exitosa',
        ];
    }
}