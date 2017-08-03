<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\SignInPage;

class SingInTest extends DuskTestCase
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
            'email'     => 'pandiincelestino@yahoo.com',
            'password'  => bcrypt('password'),
        ]);

        $this->browse(function (Browser $browser) use ($user){
            $browser->visit(new SignInPage)
                ->signIn()
                ->assertPathIs('/home')
                ->assertSeeIn('.navbar', $user->name);
        });
    }
}
