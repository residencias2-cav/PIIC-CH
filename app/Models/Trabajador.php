<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trabajador extends Model
{
    /** @use HasFactory<\Database\Factories\TrabajadorFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'trabajadors';

    protected $fillable = [
        'nt',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'sexo',
        'nss',
        'curp',
        'rfc',
        'fecha_nacimiento',
        'lugar_nacimiento_id',
        'tipo_sangre_id',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
        ];
    }

    public function lugarNacimiento(): BelongsTo
    {
        return $this->belongsTo(LugarNacimiento::class);
    }

    public function tipoSangre(): BelongsTo
    {
        return $this->belongsTo(TipoSangre::class);
    }

    public function informacionPersonal(): HasOne
    {
        return $this->hasOne(InformacionPersonal::class);
    }

    public function domicilio(): HasOne
    {
        return $this->hasOne(Domicilio::class);
    }

    public function contactosEmergencia(): HasMany
    {
        return $this->hasMany(ContactoEmergencia::class);
    }

    public function dependientesFamiliares(): HasMany
    {
        return $this->hasMany(DependienteFamiliar::class);
    }

    public function historialLaboral(): HasMany
    {
        return $this->hasMany(HistorialTrabajador::class);
    }

    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class);
    }

    public function vacaciones(): HasMany
    {
        return $this->hasMany(Vacacion::class);
    }

    public function incapacidades(): HasMany
    {
        return $this->hasMany(Incapacidad::class);
    }

    public function cursos(): HasMany
    {
        return $this->hasMany(Curso::class);
    }

    public function sanciones(): HasMany
    {
        return $this->hasMany(Sancion::class);
    }

    public function escolaridades(): HasMany
    {
        return $this->hasMany(Escolaridad::class);
    }

    public function evaluacionesClinicas(): HasMany
    {
        return $this->hasMany(Clinico::class);
    }

    public function evaluacionesPsicologicas(): HasMany
    {
        return $this->hasMany(Psicologia::class);
    }

    public function asignacionesEquipo(): HasMany
    {
        return $this->hasMany(EquipoAsignado::class);
    }

    public function asignacionesEpp(): HasMany
    {
        return $this->hasMany(EppAsignado::class);
    }

    public function usuarioCuenta(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
