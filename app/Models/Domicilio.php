<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domicilio extends Model
{
    use SoftDeletes;

    protected $table = 'domicilios';

    protected $fillable = [
        'trabajador_id',
        'direccion',
        'colonia',
        'municipio',
        'cp',
    ];

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}
