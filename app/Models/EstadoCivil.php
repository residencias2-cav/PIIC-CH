<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EstadoCivil extends Model
{
    use HasFactory;

    protected $table = 'estado_civils';

    protected $fillable = ['nombre'];

    public function informacionesPersonales(): HasMany
    {
        return $this->hasMany(InformacionPersonal::class, 'estado_civil_id');
    }
}
