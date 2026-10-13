<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoSangre extends Model
{
    use HasFactory;

    protected $table = 'tipo_sangres';

    protected $fillable = ['nombre'];

    public function trabajadores(): HasMany
    {
        return $this->hasMany(Trabajador::class);
    }
}
