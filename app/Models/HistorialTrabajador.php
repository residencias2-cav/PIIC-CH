<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialTrabajador extends Model
{
    use SoftDeletes;

    protected $table = 'historial_trabajadores';

    protected $fillable = [
        'trabajador_id',
        'departamento_id',
        'obra_id',
        'puesto_id',
        'gerencia_id',
        'fecha_inicio',
        'fecha_fin',
        'salario_base',
        'salario_diario',
        'registro_patronal',
        'activo',
        'correo_laboral',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
            'salario_base' => 'decimal:2',
            'salario_diario' => 'decimal:2',
            'activo' => 'boolean',
        ];
    }

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function departamento(): BelongsTo
    {
        return $this->belongsTo(Departamento::class);
    }

    public function obra(): BelongsTo
    {
        return $this->belongsTo(Obra::class);
    }

    public function puesto(): BelongsTo
    {
        return $this->belongsTo(Puesto::class);
    }

    public function gerencia(): BelongsTo
    {
        return $this->belongsTo(Gerencia::class);
    }
}
