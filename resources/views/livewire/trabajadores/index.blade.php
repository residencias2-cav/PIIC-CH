<div>
    <div class="mb-8">
        <h1 class="text-2xl font-semibold">Trabajadores</h1>
        <p class="mt-1 text-sm text-slate-600">Administra el registro laboral y los datos básicos del personal.</p>
    </div>

    @if (session('status'))
        <div role="status" class="mb-6 rounded-md bg-green-50 p-3 text-sm text-green-800">{{ session('status') }}</div>
    @endif

    <section class="mb-8 rounded-xl bg-white p-6 shadow-sm">
        <h2 class="text-lg font-semibold">{{ $editingId ? 'Editar trabajador' : 'Registrar trabajador' }}</h2>

        <form wire:submit="save" class="mt-5 space-y-8">
            <fieldset class="grid gap-4 md:grid-cols-3">
                <legend class="mb-3 font-medium">Datos del trabajador</legend>
                <div>
                    <label for="nt" class="block text-sm font-medium">Número de trabajador *</label>
                    <input id="nt" wire:model="form.nt" maxlength="15" required class="form-input">
                    @error('form.nt') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="nombre" class="block text-sm font-medium">Nombre *</label>
                    <input id="nombre" wire:model="form.nombre" maxlength="100" required class="form-input">
                    @error('form.nombre') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="apellido_paterno" class="block text-sm font-medium">Apellido paterno *</label>
                    <input id="apellido_paterno" wire:model="form.apellido_paterno" maxlength="100" required class="form-input">
                    @error('form.apellido_paterno') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="apellido_materno" class="block text-sm font-medium">Apellido materno</label>
                    <input id="apellido_materno" wire:model="form.apellido_materno" maxlength="100" class="form-input">
                    @error('form.apellido_materno') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="sexo" class="block text-sm font-medium">Sexo *</label>
                    <select id="sexo" wire:model="form.sexo" required class="form-input">
                        <option value="">Selecciona...</option>
                        <option value="mujer">Mujer</option>
                        <option value="hombre">Hombre</option>
                    </select>
                    @error('form.sexo') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="fecha_nacimiento" class="block text-sm font-medium">Fecha de nacimiento *</label>
                    <input id="fecha_nacimiento" type="date" wire:model="form.fecha_nacimiento" required class="form-input">
                    @error('form.fecha_nacimiento') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="curp" class="block text-sm font-medium">CURP *</label>
                    <input id="curp" wire:model="form.curp" maxlength="18" minlength="18" required class="form-input uppercase">
                    @error('form.curp') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="nss" class="block text-sm font-medium">NSS</label>
                    <input id="nss" wire:model="form.nss" maxlength="20" class="form-input">
                    @error('form.nss') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="rfc" class="block text-sm font-medium">RFC</label>
                    <input id="rfc" wire:model="form.rfc" maxlength="13" class="form-input uppercase">
                    @error('form.rfc') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="lugar_nacimiento_id" class="block text-sm font-medium">Lugar de nacimiento *</label>
                    <select id="lugar_nacimiento_id" wire:model="form.lugar_nacimiento_id" required class="form-input">
                        <option value="">Selecciona...</option>
                        @foreach ($lugaresNacimiento as $lugar)
                            <option value="{{ $lugar->id }}">{{ $lugar->nombre }}</option>
                        @endforeach
                    </select>
                    @error('form.lugar_nacimiento_id') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="tipo_sangre_id" class="block text-sm font-medium">Tipo de sangre *</label>
                    <select id="tipo_sangre_id" wire:model="form.tipo_sangre_id" required class="form-input">
                        <option value="">Selecciona...</option>
                        @foreach ($tiposSangre as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                    @error('form.tipo_sangre_id') <p class="field-error">{{ $message }}</p> @enderror
                </div>
            </fieldset>

            <fieldset class="grid gap-4 md:grid-cols-3">
                <legend class="mb-3 font-medium">Información personal</legend>
                <div>
                    <label for="estado_civil_id" class="block text-sm font-medium">Estado civil *</label>
                    <select id="estado_civil_id" wire:model="form.estado_civil_id" required class="form-input">
                        <option value="">Selecciona...</option>
                        @foreach ($estadosCiviles as $estado)
                            <option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
                        @endforeach
                    </select>
                    @error('form.estado_civil_id') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="celular" class="block text-sm font-medium">Celular</label>
                    <input id="celular" wire:model="form.celular" maxlength="20" class="form-input">
                    @error('form.celular') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="telefono" class="block text-sm font-medium">Teléfono</label>
                    <input id="telefono" wire:model="form.telefono" maxlength="20" class="form-input">
                    @error('form.telefono') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="correo" class="block text-sm font-medium">Correo personal</label>
                    <input id="correo" type="email" wire:model="form.correo" maxlength="100" class="form-input">
                    @error('form.correo') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="nombre_conyuge" class="block text-sm font-medium">Nombre del cónyuge</label>
                    <input id="nombre_conyuge" wire:model="form.nombre_conyuge" maxlength="100" class="form-input">
                    @error('form.nombre_conyuge') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div class="flex items-center gap-2 pt-6">
                    <input id="licencia_conducir" type="checkbox" wire:model="form.licencia_conducir" class="rounded border-slate-300">
                    <label for="licencia_conducir" class="text-sm font-medium">Tiene licencia de conducir</label>
                </div>
                <div>
                    <label for="tipo_licencia" class="block text-sm font-medium">Tipo de licencia</label>
                    <input id="tipo_licencia" wire:model="form.tipo_licencia" maxlength="50" class="form-input">
                    @error('form.tipo_licencia') <p class="field-error">{{ $message }}</p> @enderror
                </div>
            </fieldset>

            <fieldset class="grid gap-4 md:grid-cols-3">
                <legend class="mb-3 font-medium">Domicilio actual (uno por trabajador)</legend>
                <div class="md:col-span-2">
                    <label for="direccion" class="block text-sm font-medium">Dirección *</label>
                    <input id="direccion" wire:model="form.direccion" maxlength="200" required class="form-input">
                    @error('form.direccion') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="colonia" class="block text-sm font-medium">Colonia *</label>
                    <input id="colonia" wire:model="form.colonia" maxlength="100" required class="form-input">
                    @error('form.colonia') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="municipio" class="block text-sm font-medium">Municipio *</label>
                    <input id="municipio" wire:model="form.municipio" maxlength="100" required class="form-input">
                    @error('form.municipio') <p class="field-error">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="cp" class="block text-sm font-medium">Código postal *</label>
                    <input id="cp" wire:model="form.cp" inputmode="numeric" maxlength="5" minlength="5" required class="form-input">
                    @error('form.cp') <p class="field-error">{{ $message }}</p> @enderror
                </div>
            </fieldset>

            <div class="flex gap-3">
                <button type="submit" class="rounded-md bg-blue-700 px-4 py-2 font-medium text-white hover:bg-blue-800">
                    {{ $editingId ? 'Guardar cambios' : 'Registrar trabajador' }}
                </button>
                @if ($editingId)
                    <button type="button" wire:click="cancelEdit" class="rounded-md border border-slate-300 px-4 py-2 font-medium hover:bg-slate-50">
                        Cancelar
                    </button>
                @endif
            </div>
        </form>
    </section>

    <section class="rounded-xl bg-white p-6 shadow-sm">
        <div class="mb-4 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <h2 class="text-lg font-semibold">Personal registrado</h2>
            <input type="search" wire:model.live.debounce.300ms="search" placeholder="Buscar por número o nombre"
                class="w-full rounded-md border border-slate-300 px-3 py-2 sm:max-w-sm">
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="border-b border-slate-200 text-slate-600">
                    <tr>
                        <th class="px-3 py-2">No. trabajador</th>
                        <th class="px-3 py-2">Nombre</th>
                        <th class="px-3 py-2">Lugar de nacimiento</th>
                        <th class="px-3 py-2">Tipo de sangre</th>
                        <th class="px-3 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trabajadores as $trabajador)
                        <tr wire:key="trabajador-{{ $trabajador->id }}" class="border-b border-slate-100">
                            <td class="px-3 py-3">{{ $trabajador->nt }}</td>
                            <td class="px-3 py-3">{{ $trabajador->nombre }} {{ $trabajador->apellido_paterno }} {{ $trabajador->apellido_materno }}</td>
                            <td class="px-3 py-3">{{ $trabajador->lugarNacimiento->nombre }}</td>
                            <td class="px-3 py-3">{{ $trabajador->tipoSangre->nombre }}</td>
                            <td class="px-3 py-3">
                                <div class="flex gap-3">
                                    <button type="button" wire:click="edit({{ $trabajador->id }})" class="font-medium text-blue-700 hover:text-blue-900">Editar</button>
                                    <button type="button" wire:click="delete({{ $trabajador->id }})" wire:confirm="¿Dar de baja a este trabajador?" class="font-medium text-red-700 hover:text-red-900">Dar de baja</button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-8 text-center text-slate-500">No hay trabajadores registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">{{ $trabajadores->links() }}</div>
    </section>
</div>
