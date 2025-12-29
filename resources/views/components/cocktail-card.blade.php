<div class="card h-100 cocktail-card shadow-sm">
    <img
        src="{{ $image }}"
        class="card-img-top"
        alt="{{ $title }}"
        style="height: 180px; object-fit: cover;"
    >

    <div class="card-body d-flex justify-between">
        <div>
            {{ $slot }}
        </div>

        @isset($actions)
            <div class="d-flex justify-center align-items-center gap-2">
                {{ $actions }}
            </div>
        @endisset
    </div>
</div>
