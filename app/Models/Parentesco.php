<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parentesco extends Model
{
    protected $table = 'parentescos';

    protected $fillable = ['nombre'];

    public function contactosEmergencia(): HasMany
    {
        return $this->hasMany(ContactoEmergencia::class);
    }

    public function dependientesFamiliares(): HasMany
    {
        return $this->hasMany(DependienteFamiliar::class);
    }
}
