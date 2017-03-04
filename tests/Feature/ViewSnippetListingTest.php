<?php

namespace Tests\Feature;

use App\Snippet;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewSnippetListingTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        auth()->login($this->user);
    }

    /** @test */
    function user_can_view_a_published_snippet_listing()
    {
        $snippet = factory(Snippet::class)->create([
            'title' => 'My Snippet',
            'body' => 'console.log(true);',
        ]);

        $response = $this->get('/snippets/'.$snippet->id);

        $response->assertStatus(200);
        $response->assertSee('My Snippet');
        $response->assertSee('console.log(true);');
        $response->assertSee($this->user->name);
    }

    /** @test */
    function user_cannot_view_unpublished_snippet_listings()
    {
        $response = $this->get('/snippets/foo');
        $response->assertStatus(404);
    }
}
