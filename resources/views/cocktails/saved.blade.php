@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Cócteles guardados</h1>

    <div class="row">
        @forelse ($cocktails as $cocktail)
            <div class="col-md-3 mb-4">
                <x-cocktail-card
                    :image="$cocktail->thumbnail"
                    :title="$cocktail->name"
                >
                    <h5 class="card-title">{{ $cocktail->name }}</h5>

                    <p class="card-text mb-0">
                        <strong>Categoría:</strong> {{ $cocktail->category ?? 'N/A' }} <br>
                        <strong>Tipo:</strong> {{ $cocktail->alcoholic ?? 'N/A' }}
                    </p>

                    <x-slot name="actions">
                        <form 
                            method="POST" 
                            action="{{ route('cocktails.destroy', $cocktail) }}"
                            class="js-delete-form"
                            data-name="{{ $cocktail->name }}"
                            >
                            @csrf
                            @method('DELETE')

                            <button class="btn btn-sm btn-danger" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                        <button
                            class="btn btn-sm btn-primary btn-edit-cocktail"
                            data-bs-toggle="modal"
                            data-bs-target="#editCocktailModal"
                            data-id="{{ $cocktail->id }}"
                            data-name="{{ $cocktail->name }}"
                            data-category="{{ $cocktail->category }}"
                            data-alcoholic="{{ $cocktail->alcoholic }}"
                        >
                            <i class="bi bi-pencil"></i>
                        </button>
                    </x-slot>
                </x-cocktail-card>

            </div>
            @empty
            <div class="col-12 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
                <div class="text-center d-flex flex-column align-items-center">

                    {{-- Icono vacío (SVG inline, sin CDN) --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="96"
                        height="96"
                        fill="currentColor"
                        class="text-muted mb-3"
                        viewBox="0 0 16 16"
                    >
                        <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0-1A6 6 0 1 1 8 2a6 6 0 0 1 0 12z"/>
                        <path d="M4.5 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                    </svg>

                    <h4 class="mb-2">No tienes cócteles guardados</h4>

                    <p class="text-muted mb-4">
                        Guarda tus cócteles favoritos para verlos aquí 🍸
                    </p>

                    <a href="{{ route('cocktails.index') }}" class="btn btn-primary">
                        Ver lista de cócteles
                    </a>
                </div>
            </div>

        @endforelse

        <div class="modal fade" id="editCocktailModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" id="editCocktailForm">
                    @csrf
                    @method('PUT')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar cóctel</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" id="edit-name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Categoría</label>
                                <input type="text" name="category" id="edit-category" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <input type="text" name="alcoholic" id="edit-alcoholic" class="form-control">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Guardar cambios
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
