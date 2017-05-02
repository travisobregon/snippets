<?php

namespace Tests\Unit;

use App\User;
use App\Snippet;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SnippetTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function retrieving_a_snippets_forks()
    {
        $snippet = factory(Snippet::class)->create();
        $forkedSnippet = factory(Snippet::class)->create([
            'forked_id' => $snippet->id,
        ]);

        $this->assertFalse($snippet->forks->contains($forkedSnippet));
    }

    /** @test */
    public function retrieving_the_snippet_a_snippet_was_forked_from()
    {
        $snippet = factory(Snippet::class)->create([
            'title' => 'Original Snippet',
        ]);
        $forkedSnippet = factory(Snippet::class)->create([
            'forked_id' => $snippet->id,
        ]);

        $this->assertEquals($forkedSnippet->originalSnippet->title, 'Original Snippet');
    }

    /** @test */
    public function retrieving_the_author_of_a_snippet()
    {
        $user = factory(User::class)->create();
        $snippet = factory(Snippet::class)->create([
            'user_id' => $user->id,
        ]);

        $this->assertEquals($snippet->user->name, $user->name);
        $this->assertEquals($snippet->user->username, $user->username);
        $this->assertEquals($snippet->user->email, $user->email);
    }
}
