<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EppAsignado extends Model
{
    protected $table = 'epp_asignados';

    protected $fillable = [
        'trabajador_id',
        'equipo_epp_id',
    ];

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function equipoSeguridad(): BelongsTo
    {
        return $this->belongsTo(EquipoSeguridad::class, 'equipo_epp_id');
    }
}
