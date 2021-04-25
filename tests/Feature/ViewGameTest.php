<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewGameTest extends TestCase
{
    /** @test */
    public function the_game_shows_correct_game_info()
    {
        

        $response = $this->get(route('games.show','animal-crossing-new-horizons'));

        $response->assertSuccessful();
    }
}
