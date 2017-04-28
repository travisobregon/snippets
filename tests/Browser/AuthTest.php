<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function logging_in_with_invalid_credentials()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'foobar@example.com')
                ->type('password', 'foobar')
                ->press('Login')
                ->assertPathIs('/login')
                ->assertSee('These credentials do not match our records');
        });
    }

    /** @test */
    public function logging_in_with_valid_credentials()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/');
        });
    }

    /** @test */
    public function registering_with_invalid_data()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->type('name', 'Foo Bar')
                ->type('username', 'foobar')
                ->type('email', 'foobar@example.com')
                ->type('password', 'foobar')
                ->type('password_confirmation', 'barfoo')
                ->press('Register')
                ->assertPathIs('/register');
        });
    }

    /** @test */
    public function registering_with_valid_data()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                ->type('name', 'Foo Bar')
                ->type('username', 'foobar')
                ->type('email', 'foobar@example.com')
                ->type('password', 'foobar')
                ->type('password_confirmation', 'foobar')
                ->press('Register')
                ->assertPathIs('/');
        });
    }

    /** @test */
    public function a_user_is_unable_to_view_the_home_page_if_they_are_not_authenticated()
    {
        $this->browse(function ($browser) {
            $browser->visit('/')
                ->assertPathIs('/login');
        });
    }

    /** @test */
    public function a_user_is_unable_to_view_the_login_and_register_pages_if_they_are_authenticated()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
        ]);

        auth()->login($user);

        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->assertPathIs('/');

            $browser->visit('/register')
                ->assertPathIs('/');
        });
    }
}
