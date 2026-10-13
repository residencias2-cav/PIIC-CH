<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LugarNacimiento extends Model
{
    use HasFactory;

    protected $table = 'lugar_nacimientos';

    protected $fillable = ['nombre'];

    public function trabajadores(): HasMany
    {
        return $this->hasMany(Trabajador::class);
    }
}
