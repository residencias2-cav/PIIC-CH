<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sancion extends Model
{
    use SoftDeletes;

    protected $table = 'sanciones';

    protected $fillable = [
        'trabajador_id',
        'fecha',
        'tipo',
        'motivo',
        'adjunto',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'date',
        ];
    }

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }
}
