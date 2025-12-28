@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Cócteles guardados</h1>

    <div class="row">
        @forelse ($cocktails as $cocktail)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img
                        src="{{ $cocktail->thumbnail }}"
                        class="card-img-top"
                        alt="{{ $cocktail->name }}"
                    >

                    <div class="card-body">
                        <h5 class="card-title">{{ $cocktail->name }}</h5>

                        <p class="card-text">
                            <strong>Categoría:</strong> {{ $cocktail->category ?? 'N/A' }} <br>
                            <strong>Tipo:</strong> {{ $cocktail->alcoholic ?? 'N/A' }}
                        </p>
                        <form
                            method="POST"
                            action="{{ route('cocktails.destroy', $cocktail) }}"
                            class="mt-3"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm w-100">
                                Eliminar
                            </button>
                        </form>
                        <button
                            type="button"
                            class="btn btn-outline-primary btn-sm w-100 mb-2 btn-edit-cocktail"
                            data-bs-toggle="modal"
                            data-bs-target="#editCocktailModal"
                            data-id="{{ $cocktail->id }}"
                            data-name="{{ $cocktail->name }}"
                            data-category="{{ $cocktail->category }}"
                            data-alcoholic="{{ $cocktail->alcoholic }}"
                        >
                            Editar
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p>No hay cócteles guardados.</p>
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
