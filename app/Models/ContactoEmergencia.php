<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactoEmergencia extends Model
{
    use SoftDeletes;

    protected $table = 'contacto_emergencias';

    protected $fillable = [
        'trabajador_id',
        'parentesco_id',
        'emergencia_c',
        'telefono_emergencia',
    ];

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class);
    }

    public function parentesco(): BelongsTo
    {
        return $this->belongsTo(Parentesco::class);
    }
}
