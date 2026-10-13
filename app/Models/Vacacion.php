<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacacion extends Model
{
    protected $table = 'vacaciones';

    protected $fillable = [
        'trabajador_id',
        'fecha_inicio',
        'fecha_fin',
        'dias',
        'tipo',
        'folio',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
            'dias' => 'integer',
        ];
    }

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}
