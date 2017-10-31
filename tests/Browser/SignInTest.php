<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\SignInPage;

class SignInTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @test A basic browser test example.
     *
     * @return void
     */
    public function a_user_can_sign_in()
    {
         $user = factory(User::class)->create([
            'email' => 'celestinoguiller@gmail.com',
            'password' => bcrypt('password'),
            'name' => 'guiller celestino'
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit(new SignInPage)
                ->signIn($user->email, 'password')
                ->assertPathIs('/home')
                ->assertSeeIn('.navbar', $user->name);
        });
    }
}
