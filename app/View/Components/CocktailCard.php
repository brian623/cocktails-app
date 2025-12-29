<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CocktailCard extends Component
{
    public string $image;
    public string $title;

    public function __construct(string $image, string $title)
    {
        $this->image = $image;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.cocktail-card');
    }
}
