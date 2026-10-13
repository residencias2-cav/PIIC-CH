<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class InformacionPersonal extends Model
{
    use SoftDeletes;

    protected $table = 'informacion_personal';

    protected $fillable = [
        'trabajador_id',
        'estado_civil_id',
        'nombre_conyuge',
        'celular',
        'telefono',
        'correo',
        'licencia_conducir',
        'tipo_licencia',
    ];

    protected function casts(): array
    {
        return [
            'licencia_conducir' => 'boolean',
        ];
    }

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function estadoCivil(): BelongsTo
    {
        return $this->belongsTo(EstadoCivil::class, 'estado_civil_id');
    }
}
