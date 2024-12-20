<div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
        Crear Persona
    </button>

    @if (session('error'))
        <div class="alert alert-danger mt-3" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Modal -->
    <div
        class="modal fade"
        id="staticBackdrop"
        data-backdrop="static"
        data-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
        wire:ignore.self
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">
                        {{ $id_persona ? 'Editar Persona' : 'Crear Persona' }}
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                        wire:click='resetInput'
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <label for="nombre_persona">Nombre de la persona *</label>
                        <input
                            type="text"
                            class="form-control"
                            wire:model='nombre_persona'
                            id="nombre_persona"
                            value="{{ old('nombre_persona') }}"
                        >
                    </div>
                    <div>
                        <label for="direccion_persona">Dirección de la persona *</label>
                        <input
                            type="text"
                            class="form-control"
                            wire:model='direccion_persona'
                            id="direccion_persona"
                            value="{{ old('direccion_persona') }}"
                        >
                    </div>
                    <div>
                        <label for="telefono_persona">Teléfono *</label>
                        <input
                            type="text"
                            class="form-control"
                            wire:model='telefono_persona'
                            id="telefono_persona"
                            value="{{ old('telefono_persona') }}"
                        >
                    </div>
                    <div>
                        <label for="correo_persona">Correo</label>
                        <input
                            type="text"
                            class="form-control"
                            wire:model='correo_persona'
                            id="correo_persona"
                            value="{{ old('correo_persona') }}"
                        >
                    </div>
                    <div>
                        <label for="nit_persona">NIT *</label>
                        <input
                            type="text"
                            class="form-control"
                            wire:model='nit_persona'
                            id="nit_persona"
                            value="{{ old('nit_persona') }}"
                        >
                    </div>
                    <div>
                        <label for="cui_persona">CUI *</label>
                        <input
                            type="text"
                            class="form-control"
                            wire:model='cui_persona'
                            id="cui_persona"
                            value="{{ old('cui_persona') }}"
                        >
                    </div>
                    <div>
                        <label for="id_tipo_persona">Tipo Persona *</label>
                        <select
                            class="form-control"
                            wire:model.live="id_tipo_persona"
                            id="id_tipo_persona"
                            @if ($id_persona) disabled @endif
                        >
                            <option value="">--Seleccione--</option>
                            @foreach ($tiposDePersonas as $tipoPersona)
                                <option value="{{ $tipoPersona->id_tipo_persona }}">{{ $tipoPersona->nombre_tipo_persona }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Código:</label>
                        <p>{{ $codigo_siguiente }}</p>
                    </div>

                    <div>
                        <label for="id_estado">Estado *</label>
                        <select
                            class="form-control"
                            wire:model="id_estado"
                            id="id_estado"
                        >
                            <option value="">--Seleccione--</option>
                            @foreach ($estados as $estado)
                                <option
                                    value="{{ $estado->id_estado }}"
                                >
                                    {{ $estado->nombre_estado }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-danger"
                            data-dismiss="modal"
                            wire:click='resetInput'
                        >
                            Cerrar
                        </button>
                        <button
                            type="submit"
                            class="btn btn-success"
                            data-dismiss="modal"
                            wire:click='guardarPersona'
                        >
                            {{ $id_persona ? 'Actualizar Persona' : 'Crear Persona' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-row mb-3">
        <div class="col-md-6">
            <label for="search">Buscar personas</label>
            <input
                type="text"
                class="form-control form-control-sm"
                id="search"
                wire:model.live="search"
                placeholder="Buscar personas"
            >
        </div>

        <div class="col-md-3">
            <label for="tipo_persona_filter">Tipo de Persona</label>
            <select
                class="form-control form-control-sm"
                id="tipo_persona_filter"
                wire:model.live="tipo_persona_filter"
            >
                <option value="">-- Todos --</option>
                @foreach ($tiposDePersonas as $tipoPersona)
                    <option value="{{ $tipoPersona->id_tipo_persona }}">{{ $tipoPersona->nombre_tipo_persona }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="estado_filter">Estado</label>
            <select
                class="form-control form-control-sm"
                id="estado_filter"
                wire:model.live="estado_filter"
            >
                <option value="">-- Todos --</option>
                @foreach ($estados as $estado)
                    <option value="{{ $estado->id_estado }}">{{ $estado->nombre_estado }}</option>
                @endforeach
            </select>
        </div>
    </div>

        <table class="table">
            <thead class="table-dark">
                <tr>
                    <td>Código</td>
                    <td>Nombre</td>
                    <td>Dirección</td>
                    <td>Teléfono</td>
                    <td>Correo</td>
                    <td>NIT</td>
                    <td>CUI</td>
                    <td>Tipo</td>
                    <td>Estado</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @forelse ($personas as $persona)
                    <tr>
                        <td>{{ $persona->codigo_persona }}</td>
                        <td>{{ $persona->nombre_persona }}</td>
                        <td>{{ $persona->direccion_persona }}</td>
                        <td>{{ $persona->telefono_persona }}</td>
                        <td>{{ $persona->correo_persona }}</td>
                        <td>{{ $persona->nit_persona }}</td>
                        <td>{{ $persona->cui_persona }}</td>
                        <td>{{ $persona->tipoPersona->nombre_tipo_persona }}</td>
                        <td>{{ $persona->estado->nombre_estado }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning" wire:click.prevent="editarPersona({{ $persona->id_persona }})" data-toggle="modal" data-target="#staticBackdrop">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Sin resultados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $personas->links() }}
        </div>
    </div>
</div>
