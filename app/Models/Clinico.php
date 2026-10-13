<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinico extends Model
{
    use SoftDeletes;

    protected $table = 'clinicos';

    protected $fillable = [
        'trabajador_id',
        'tipo_examen',
        'fecha_evaluacion',
        'peso',
        'talla',
        'imc',
        'tas',
        'tad',
        'glucosa',
        'colesterol',
        'trigliceridos',
        'urea',
        'hemoglobina',
        'usa_lentes',
        'disminucion_visual',
        'alergias',
        'tipo_alergias',
        'caso_especial',
        'descripcion_caso',
        'apto_ta',
        'apto_er',
        'apto_ec',
        'apto_cm',
        'apto_v',
        'apto_cs',
        'radiografia',
        'descripcion',
    ];

    protected function casts(): array
    {
        return [
            'fecha_evaluacion' => 'date',
            'peso' => 'decimal:2',
            'talla' => 'decimal:2',
            'imc' => 'decimal:2',
            'glucosa' => 'decimal:2',
            'colesterol' => 'decimal:2',
            'trigliceridos' => 'decimal:2',
            'urea' => 'decimal:2',
            'hemoglobina' => 'decimal:2',
            'usa_lentes' => 'boolean',
            'disminucion_visual' => 'boolean',
            'alergias' => 'boolean',
            'descripcion_caso' => 'boolean',
            'apto_ta' => 'boolean',
            'apto_er' => 'boolean',
            'apto_ec' => 'boolean',
            'apto_cm' => 'boolean',
            'apto_v' => 'boolean',
            'apto_cs' => 'boolean',
        ];
    }

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}
