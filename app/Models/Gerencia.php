<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gerencia extends Model
{
    protected $table = 'gerencias';

    protected $fillable = ['nombre'];

    public function historialesTrabajador(): HasMany
    {
        return $this->hasMany(HistorialTrabajador::class);
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
