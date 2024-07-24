<?php

namespace Tests\Feature;

use App\Http\Controllers\RepositoriesController;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterRepositoriesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $language_controler=new RepositoriesController();
        $languages = $language_controler->fetchLanguages();
        $language_key=array_rand($languages);
        $language=$languages[$language_key];
        $limits=[10,50,100];
        $limit_key=array_rand($limits);
        $limit=$limits[$limit_key];
        $response = $this->call('POST', 'api/get-data', array(
            'limit'=>$limit,
            'language'=> $language,
            'date_from'=>Carbon::now()->subYear(rand(1,20))->format('Y-m-d'),
        ));

        $response->assertStatus(200);
    }
}
