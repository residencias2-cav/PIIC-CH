<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Escolaridad extends Model
{
    protected $table = 'escolaridades';

    protected $fillable = [
        'trabajador_id',
        'escolaridad',
        'profesion',
        'doc_profecion',
        'matricula_cp',
        'estudia',
        'estudia_algo',
        'becas_escolares',
        'grado_escolar',
    ];

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}
