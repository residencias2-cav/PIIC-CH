<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Psicologia extends Model
{
    protected $table = 'psicologias';

    protected $fillable = [
        'trabajador_id',
        'inteligencia',
        'niveles_da',
        'personalidad',
        'competencias',
        'niveles_dan',
        'comportamiento',
        'fecha_eval',
    ];

    protected function casts(): array
    {
        return [
            'fecha_eval' => 'date',
        ];
    }

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}
