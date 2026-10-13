<?php

namespace App\Livewire\Trabajadores;

use App\Models\EstadoCivil;
use App\Models\LugarNacimiento;
use App\Models\TipoSangre;
use App\Models\Trabajador;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public ?int $editingId = null;

    public array $form = [
        'nt' => '',
        'nombre' => '',
        'apellido_paterno' => '',
        'apellido_materno' => '',
        'sexo' => '',
        'nss' => '',
        'curp' => '',
        'rfc' => '',
        'fecha_nacimiento' => '',
        'lugar_nacimiento_id' => '',
        'tipo_sangre_id' => '',
        'estado_civil_id' => '',
        'nombre_conyuge' => '',
        'celular' => '',
        'telefono' => '',
        'correo' => '',
        'licencia_conducir' => false,
        'tipo_licencia' => '',
        'direccion' => '',
        'colonia' => '',
        'municipio' => '',
        'cp' => '',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function save(): void
    {
        $validated = $this->validate();
        $form = $validated['form'];

        DB::transaction(function () use ($form): void {
            $trabajadorData = Arr::only($form, [
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
            ]);

            if ($this->editingId === null) {
                $trabajador = Trabajador::query()->create($trabajadorData);
            } else {
                $trabajador = Trabajador::query()->findOrFail($this->editingId);
                $trabajador->update($trabajadorData);
            }

            $trabajador->informacionPersonal()->updateOrCreate([], Arr::only($form, [
                'estado_civil_id',
                'nombre_conyuge',
                'celular',
                'telefono',
                'correo',
                'licencia_conducir',
                'tipo_licencia',
            ]));

            $trabajador->domicilio()->updateOrCreate([], Arr::only($form, [
                'direccion',
                'colonia',
                'municipio',
                'cp',
            ]));
        });

        session()->flash('status', $this->editingId === null
            ? 'Trabajador registrado correctamente.'
            : 'Cambios guardados correctamente.');

        $this->resetForm();
    }

    public function edit(int $trabajadorId): void
    {
        $trabajador = Trabajador::query()
            ->with(['informacionPersonal', 'domicilio'])
            ->findOrFail($trabajadorId);

        $this->editingId = $trabajador->id;
        $this->form = array_merge($this->form, $trabajador->only([
            'nt',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'sexo',
            'nss',
            'curp',
            'rfc',
            'lugar_nacimiento_id',
            'tipo_sangre_id',
        ]), [
            'fecha_nacimiento' => $trabajador->fecha_nacimiento->format('Y-m-d'),
        ], $trabajador->informacionPersonal?->only([
            'estado_civil_id',
            'nombre_conyuge',
            'celular',
            'telefono',
            'correo',
            'licencia_conducir',
            'tipo_licencia',
        ]) ?? [], $trabajador->domicilio?->only([
            'direccion',
            'colonia',
            'municipio',
            'cp',
        ]) ?? []);

        $this->resetValidation();
    }

    public function delete(int $trabajadorId): void
    {
        Trabajador::query()->findOrFail($trabajadorId)->delete();
        session()->flash('status', 'Trabajador dado de baja.');
    }

    public function cancelEdit(): void
    {
        $this->resetForm();
    }

    protected function rules(): array
    {
        return [
            'form.nt' => ['required', 'string', 'max:15', Rule::unique('trabajadors', 'nt')->ignore($this->editingId)],
            'form.nombre' => ['required', 'string', 'max:100'],
            'form.apellido_paterno' => ['required', 'string', 'max:100'],
            'form.apellido_materno' => ['nullable', 'string', 'max:100'],
            'form.sexo' => ['required', Rule::in(['hombre', 'mujer'])],
            'form.nss' => ['nullable', 'string', 'max:20'],
            'form.curp' => ['required', 'string', 'size:18', Rule::unique('trabajadors', 'curp')->ignore($this->editingId)],
            'form.rfc' => ['nullable', 'string', 'max:13'],
            'form.fecha_nacimiento' => ['required', 'date', 'before:today'],
            'form.lugar_nacimiento_id' => ['required', 'integer', 'exists:lugar_nacimientos,id'],
            'form.tipo_sangre_id' => ['required', 'integer', 'exists:tipo_sangres,id'],
            'form.estado_civil_id' => ['required', 'integer', 'exists:estado_civils,id'],
            'form.nombre_conyuge' => ['nullable', 'string', 'max:100'],
            'form.celular' => ['nullable', 'string', 'max:20'],
            'form.telefono' => ['nullable', 'string', 'max:20'],
            'form.correo' => ['nullable', 'email', 'max:100'],
            'form.licencia_conducir' => ['boolean'],
            'form.tipo_licencia' => ['nullable', 'string', 'max:50'],
            'form.direccion' => ['required', 'string', 'max:200'],
            'form.colonia' => ['required', 'string', 'max:100'],
            'form.municipio' => ['required', 'string', 'max:100'],
            'form.cp' => ['required', 'regex:/^\d{5}$/'],
        ];
    }

    public function render()
    {
        $trabajadores = Trabajador::query()
            ->with(['lugarNacimiento', 'tipoSangre'])
            ->when($this->search !== '', function (Builder $query): void {
                $query->where(function (Builder $query): void {
                    $query->where('nt', 'like', '%'.$this->search.'%')
                        ->orWhere('nombre', 'like', '%'.$this->search.'%')
                        ->orWhere('apellido_paterno', 'like', '%'.$this->search.'%')
                        ->orWhere('apellido_materno', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('apellido_paterno')
            ->orderBy('nombre')
            ->paginate(15);

        return view('livewire.trabajadores.index', [
            'trabajadores' => $trabajadores,
            'estadosCiviles' => EstadoCivil::query()->orderBy('nombre')->get(),
            'lugaresNacimiento' => LugarNacimiento::query()->orderBy('nombre')->get(),
            'tiposSangre' => TipoSangre::query()->orderBy('nombre')->get(),
        ])->layout('layouts.app');
    }

    private function resetForm(): void
    {
        $this->editingId = null;
        $this->form = [
            'nt' => '',
            'nombre' => '',
            'apellido_paterno' => '',
            'apellido_materno' => '',
            'sexo' => '',
            'nss' => '',
            'curp' => '',
            'rfc' => '',
            'fecha_nacimiento' => '',
            'lugar_nacimiento_id' => '',
            'tipo_sangre_id' => '',
            'estado_civil_id' => '',
            'nombre_conyuge' => '',
            'celular' => '',
            'telefono' => '',
            'correo' => '',
            'licencia_conducir' => false,
            'tipo_licencia' => '',
            'direccion' => '',
            'colonia' => '',
            'municipio' => '',
            'cp' => '',
        ];
        $this->resetValidation();
    }
}
