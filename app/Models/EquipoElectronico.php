<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EquipoElectronico extends Model
{
    use SoftDeletes;

    protected $table = 'equipos_electronicos';

    protected $fillable = [
        'obra_id',
        'act_ina',
        'marca',
        'modelo',
        'no_serie',
        'procesador',
        'color',
        'hd',
        'ram',
        'os',
        'fecha_alta',
        'foto',
        'robo_ext',
        'funcionalidad',
        'costos',
        'tipo_dispositivo',
        'estatus',
    ];

    protected function casts(): array
    {
        return [
            'fecha_alta' => 'date',
            'costos' => 'decimal:0',
        ];
    }

    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }

    public function asignaciones(): HasMany
    {
        return $this->hasMany(EquipoAsignado::class);
    }

    public function fallas(): HasMany
    {
        return $this->hasMany(FallaEquipoElectronico::class);
    }
}
