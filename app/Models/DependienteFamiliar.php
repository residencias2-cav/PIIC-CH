<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DependienteFamiliar extends Model
{
    use SoftDeletes;

    protected $table = 'dependientes_familiares';

    protected $fillable = [
        'trabajador_id',
        'parentesco_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'curp',
        'es_beneficiario',
    ];

    protected function casts(): array
    {
        return [
            'es_beneficiario' => 'boolean',
        ];
    }

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function parentesco(): BelongsTo
    {
        return $this->belongsTo(Parentesco::class);
    }
}
