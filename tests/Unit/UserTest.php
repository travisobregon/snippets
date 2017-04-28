<?php

namespace Tests\Unit;

use App\User;
use App\Snippet;
use Tests\TestCase;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function trying_to_add_the_same_username_throws_an_exception()
    {
        try {
            factory(User::class)->create([
                'username' => 'foobar',
                'name' => 'First User',
            ]);

            factory(User::class)->create([
                'username' => 'foobar',
                'name' => 'Second User',
            ]);
        } catch (QueryException $e) {
            $this->assertDatabaseHas('users', [
                'username' => 'foobar',
                'name' => 'First User',
            ]);

            $this->assertDatabaseMissing('users', [
                'username' => 'foobar',
                'name' => 'Second User',
            ]);

            return;
        }

        $this->fail('User creation succeeded even though the username was already taken.');
    }

    /** @test */
    public function a_user_has_not_voted_for_a_snippet()
    {
        $user = factory(User::class)->create();
        $snippet = factory(Snippet::class)->create();

        $this->assertFalse($user->votedFor($snippet));
    }

    /** @test */
    public function a_user_has_voted_for_a_snippet()
    {
        $user = factory(User::class)->create();
        $snippet = factory(Snippet::class)->create();

        $user->votes()->toggle($snippet);

        $this->assertTrue($user->votedFor($snippet));
        $this->assertDatabaseHas('snippets_votes', [
            'user_id' => $user->id,
            'snippet_id' => $snippet->id,
        ]);
    }
}
