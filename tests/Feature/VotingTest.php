<?php

namespace Tests\Feature;

use App\Snippet;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VotingTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function snippets_can_be_voted_on()
    {
        $user = factory(User::class)->create();
        auth()->login($user);
        $snippet = factory(Snippet::class)->create();

        $response = $this->post('/votes/'.$snippet->id);
        $response->assertStatus(200);
        $response->assertJson([
            'count' => 1,
        ]);

        $this->assertDatabaseHas('snippets_votes', [
            'user_id' => $user->id,
            'snippet_id' => $snippet->id,
        ]);
    }
}
