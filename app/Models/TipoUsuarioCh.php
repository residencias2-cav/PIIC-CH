<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TipoUsuarioCh extends Model
{
    protected $table = 'tipo_usuario_ch';

    protected $fillable = ['nombre'];

    public function usuarios(): HasMany
    {
        return $this->hasMany(User::class, 'tipo_usuario_id');
    }
}
