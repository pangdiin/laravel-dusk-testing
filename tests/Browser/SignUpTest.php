<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\SignUpPage;

class SingUpTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * @test A basic browser test example.
     *
     * @return void
     */
    public function a_user_can_sign_up()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new SignUpPage)
                ->signUp('pangdiin', 'pangdiincelestino@yahoo.com', 'password', 'password')
                ->assertPathIs('/home')
                ->assertSeeIn('.navbar', 'pangdiin');
        });
    }
}
