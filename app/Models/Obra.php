<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obra extends Model
{
    protected $table = 'obras';

    protected $fillable = ['nombre'];

    public function historialesTrabajador(): HasMany
    {
        return $this->hasMany(HistorialTrabajador::class);
    }

    public function equiposElectronicos(): HasMany
    {
        return $this->hasMany(EquipoElectronico::class);
    }
}
