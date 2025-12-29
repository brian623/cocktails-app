<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\Cocktail\CocktailApiService;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class CocktailApiServiceTest extends TestCase
{
    #[Test]
    public function list_returns_normalized_cocktails()
    {
        Http::fake([
            '*' => Http::response([
                'drinks' => [
                    [
                        'idDrink' => '123',
                        'strDrink' => 'Negroni',
                        'strDrinkThumb' => 'img.jpg',
                        'strCategory' => 'Cocktail',
                        'strAlcoholic' => 'Alcoholic',
                    ]
                ]
            ], 200)
        ]);

        $service = new CocktailApiService();

        $result = $service->list();

        $this->assertCount(1, $result);
        $this->assertEquals('123', $result[0]['external_id']);
        $this->assertEquals('Negroni', $result[0]['name']);
        $this->assertEquals('img.jpg', $result[0]['thumbnail']);
    }

    #[Test]
    public function list_returns_empty_array_when_api_returns_null()
    {
        Http::fake([
            '*' => Http::response([
                'drinks' => null
            ], 200)
        ]);

        $service = new CocktailApiService();

        $result = $service->list();

        $this->assertSame([], $result);
    }

    #[Test]
    public function find_by_id_returns_normalized_cocktail()
    {
        Http::fake([
            '*' => Http::response([
                'drinks' => [
                    [
                        'idDrink' => '999',
                        'strDrink' => 'Mojito',
                        'strDrinkThumb' => 'mojito.jpg',
                        'strCategory' => 'Cocktail',
                        'strAlcoholic' => 'Alcoholic',
                    ]
                ]
            ], 200)
        ]);

        $service = new CocktailApiService();

        $result = $service->findById('999');

        $this->assertEquals('999', $result['external_id']);
        $this->assertEquals('Mojito', $result['name']);
        $this->assertEquals('mojito.jpg', $result['thumbnail']);
        $this->assertEquals('Cocktail', $result['category']);
        $this->assertEquals('Alcoholic', $result['alcoholic']);
    }

    #[Test]
    public function find_by_id_returns_null_when_not_found()
    {
        Http::fake([
            '*' => Http::response([
                'drinks' => null
            ], 200)
        ]);

        $service = new CocktailApiService();

        $result = $service->findById('000');

        $this->assertNull($result);
    }
}
