<?php

namespace App\Services\Cocktail;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CocktailApiService
{
    private const BASE_URL = 'https://www.thecocktaildb.com/api/json/v1/1';

    /**
     * Obtener listado de cócteles normalizados
     */
    public function list(): array
    {
        try {
            $response = Http::timeout(5)
                ->acceptJson()
                ->get(self::BASE_URL . '/filter.php', [
                    'c' => 'Cocktail',
                ])
                ->throw();

            $drinks = $response->json('drinks');

            if (!is_array($drinks)) {
                Log::warning('Cocktail API returned invalid drinks payload', [
                    'payload' => $drinks,
                ]);

                return [];
            }

            return $this->normalize($drinks);

        } catch (\Throwable $e) {
            Log::error('Cocktail API error', [
                'message' => $e->getMessage(),
            ]);

            return [];
        }
    }

    public function findById(string $externalId): ?array
    {
        $response = Http::get(
            'https://www.thecocktaildb.com/api/json/v1/1/lookup.php',
            ['i' => $externalId]
        );

        if (! $response->successful()) {
            return null;
        }

        $drink = $response->json('drinks.0');

        if (! $drink) {
            return null;
        }

        return [
            'external_id' => $drink['idDrink'],
            'name'        => $drink['strDrink'],
            'category'    => $drink['strCategory'],
            'alcoholic'   => $drink['strAlcoholic'],
            'thumbnail'   => $drink['strDrinkThumb'],
        ];
    }


    /**
     * Normaliza la respuesta de la API
     */
    private function normalize(array $drinks): array
    {
        return collect($drinks)->map(function ($drink) {
            return [
                'external_id' => $drink['idDrink'],
                'name'        => $drink['strDrink'],
                'thumbnail'   => $drink['strDrinkThumb'],
            ];
        })->toArray();
    }
}
