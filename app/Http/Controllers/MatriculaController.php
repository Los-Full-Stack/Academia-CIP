<?php

namespace App\Http\Controllers;

use App\Models\Colegiado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Valida el estado del colegiado y procesa la pre-matrícula.
     */
    public function validarColegiado(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'cip' => 'required|string|max:10',
        ]);

        $colegiado = Colegiado::where('cip', $validated['cip'])->first();

        if (!$colegiado) {
            return response()->json([
                'success' => false,
                'message' => 'El número de CIP ingresado no se encuentra registrado en el padrón.',
            ], 404);
        }

        if (!$colegiado->puedeInscribirse()) {
            return response()->json([
                'success' => false,
                'message' => 'El colegiado no se encuentra habilitado para matricularse. Estado: ' . $colegiado->condicion(),
                'condicion' => $colegiado->condicion(),
                'cuotas_pendientes' => $colegiado->cuotas_pendientes,
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Colegiado habilitado para matrícula.',
            'data' => [
                'cip' => $colegiado->cip,
                'nombres' => $colegiado->nombres,
                'apellidos' => $colegiado->apellidos,
                'capitulo' => $colegiado->capitulo,
                'condicion' => $colegiado->condicion(),
                'aplica_descuento' => $colegiado->aplicaDescuento(),
            ],
        ], 200);
    }
}
