@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Encuentra el cocktel que más te guste.</h1>

    <div class="row">
        @forelse ($cocktails as $cocktail)
        @php
            $isFavorite = in_array($cocktail['external_id'], $favorites);
        @endphp
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <x-cocktail-card
                    :image="$cocktail['thumbnail']"
                    :title="$cocktail['name']"
                >
                    <small class="text-muted d-block">
                        Código: {{ $cocktail['external_id'] }}
                    </small>

                    <h6 class="mb-0">{{ $cocktail['name'] }}</h6>

                    <x-slot name="actions">
                        @if (!$isFavorite)
                            <form method="POST" action="{{ route('cocktails.store') }}">
                                @csrf
                                <input type="hidden" name="external_id" value="{{ $cocktail['external_id'] }}">

                                <button class="btn p-0 text-muted" title="Guardar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"> <path d="M20.8 4.6c-1.4-1.4-3.6-1.4-5 0L12 8.4 8.2 4.6c-1.4-1.4-3.6-1.4-5 0s-1.4 3.6 0 5L12 18.4l8.8-8.8c1.4-1.4 1.4-3.6 0-5z"/> </svg>
                                </button>
                            </form>
                        @else
                            <span class="text-danger" title="Ya está en favoritos"> {{-- Corazón rojo --}} <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" viewBox="0 0 24 24"> <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3 c1.74 0 3.41.81 4.5 2.09 C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5 c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/> </svg> </span>
                        @endif
                    </x-slot>
                </x-cocktail-card>

            </div>
        @empty
            <div class="col-12">
                <p class="text-muted">No cocktails available</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
