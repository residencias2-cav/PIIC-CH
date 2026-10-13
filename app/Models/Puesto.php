<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Puesto extends Model
{
    protected $table = 'puestos';

    protected $fillable = ['nombre'];

    public function historialesTrabajador(): HasMany
    {
        return $this->hasMany(HistorialTrabajador::class);
    }
}
