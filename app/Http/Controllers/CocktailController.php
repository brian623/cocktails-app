<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cocktail;
use App\Services\Cocktail\CocktailApiService;

class CocktailController extends Controller
{
    public function index(CocktailApiService $service)
    {
        $cocktails = $service->list();

        return view('cocktails.index', compact('cocktails'));
    }

    public function store(Request $request, CocktailApiService $api)
    {
        $request->validate([
            'external_id' => ['required', 'string'],
        ]);

        $cocktailData = $api->findById($request->external_id);

        if (! $cocktailData) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'No se pudo obtener la información del cóctel']);
        }

        Cocktail::updateOrCreate(
            ['external_id' => $cocktailData['external_id']],
            $cocktailData
        );

        return redirect()
            ->route('cocktails.index')
            ->with('success', 'Cóctel guardado correctamente');
    }

    public function saved()
    {
        $cocktails = Cocktail::query()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cocktails.saved', compact('cocktails'));
    }

    public function destroy(Cocktail $cocktail)
    {
        $cocktail->delete();

        return redirect()
            ->route('cocktails.saved')
            ->with('success', 'Cóctel eliminado correctamente');
    }

    public function edit(Cocktail $cocktail)
    {
        return view('cocktails.edit', compact('cocktail'));
    }

    public function update(Request $request, Cocktail $cocktail)
    {
        $validated = $request->validate([
            'name'      => ['required', 'string', 'max:255'],
            'category'  => ['nullable', 'string', 'max:255'],
            'alcoholic' => ['nullable', 'string', 'max:255'],
        ]);

        $cocktail->update($validated);

        return redirect()
            ->route('cocktails.saved')
            ->with('success', 'Cóctel actualizado correctamente');
    }
}
