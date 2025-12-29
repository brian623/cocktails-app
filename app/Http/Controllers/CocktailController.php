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

        $favorites = Cocktail::query()
            ->pluck('external_id')
            ->toArray();

        return view('cocktails.index', compact('cocktails', 'favorites'));
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
            ->with('toast', [
                    'type' => 'success',
                    'message' => 'Cóctel guardado en favoritos']);
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
            ->with('toast', [
            'type' => 'success',
            'message' => 'Cóctel retirado de favoritos 🍸'
        ]);
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
            ->with('toast', [
            'type' => 'success',
            'message' => 'Cóctel actualizado correctamente 🍸'
        ]);
    }
}
