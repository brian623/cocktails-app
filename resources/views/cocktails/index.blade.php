@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Cocktails</h1>

    <div class="row">
        @forelse ($cocktails as $cocktail)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 shadow-sm">
                    <img
                        src="{{ $cocktail['thumbnail'] }}"
                        class="card-img-top"
                        alt="{{ $cocktail['name'] }}"
                        style="height: 180px; object-fit: cover;"
                    >

                    <div class="card-body">
                        <p class="text-muted mb-1">
                            <strong>Código:</strong> {{ $cocktail['external_id'] }}
                        </p>
                        <h6 class="card-title mb-0">
                            {{ $cocktail['name'] }}
                        </h6>
                        <form method="POST" action="{{ route('cocktails.store') }}">
        @csrf

        <input type="hidden" name="external_id" value="{{ $cocktail['external_id'] }}">
        <input type="hidden" name="name" value="{{ $cocktail['name'] }}">
        <input type="hidden" name="thumbnail" value="{{ $cocktail['thumbnail'] }}">

        <button type="submit" class="btn btn-primary btn-sm w-80">
            Guardar
        </button>
    </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No cocktails available</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
