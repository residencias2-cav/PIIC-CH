<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FallaEquipoElectronico extends Model
{
    use SoftDeletes;

    protected $table = 'fallas_equipo_electronico';

    protected $fillable = [
        'equipo_electronico_id',
        'falla',
        'descripcion',
        'fecha',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function equipoElectronico(): BelongsTo
    {
        return $this->belongsTo(EquipoElectronico::class);
    }
}
