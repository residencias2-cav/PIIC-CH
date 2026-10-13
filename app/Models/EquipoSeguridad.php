<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipoSeguridad extends Model
{
    protected $table = 'equipos_seguridad';

    protected $fillable = [
        'tipo_epp',
        'talla_zapatos',
        'talla_overol',
        'talla_camisa',
        'talla_pantalon',
        'talla_chaleco',
        'fecha',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function asignaciones(): HasMany
    {
        return $this->hasMany(EppAsignado::class, 'equipo_epp_id');
    }
}
