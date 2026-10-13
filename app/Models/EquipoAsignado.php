<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipoAsignado extends Model
{
    protected $table = 'equipos_asignados';

    protected $fillable = [
        'equipo_electronico_id',
        'trabajador_id',
        'fecha_alta',
        'fecha_baja',
    ];

    protected function casts(): array
    {
        return [
            'fecha_alta' => 'date',
            'fecha_baja' => 'date',
        ];
    }

    public function equipoElectronico(): BelongsTo
    {
        return $this->belongsTo(EquipoElectronico::class);
    }

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}
