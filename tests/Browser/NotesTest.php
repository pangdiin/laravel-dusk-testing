<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\NotesPage;
use Tests\Browser\Pages\SignUpPage;

class NotesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_save_a_new_note()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit(new NotesPage)
                ->typeNote('One', 'The body')
                ->saveNote()
                ->pause(1000)
                ->assertSeeIn('.alert', 'Your new note has been saved')
                ->assertSeeIn('.notes', 'One')
                ->assertInputValue('#title', 'One')
                ->assertInputValue('#body', 'The body');
        });
    }

     /**
     * @test
     */
    public function a_user_can_the_world_count_of_their_note()
    {   
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                ->visit(new NotesPage)
                ->typeNote('One', 'There are five words here')
                ->assertSee('Word count: 5');
        });
    }

    /**
     * @test
     */
    public function a_user_can_start_a_fresh_note()
    {   
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                ->visit(new NotesPage)
                ->typeNote('One', 'There are five words here')
                ->assertSee('Word count: 5');
        });
    }
    /**
     * @test A basic browser test example.
     *
     * @return void
     */
    public function a_user_should_see_no_notes_when_starting_their_account()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new SignUpPage)
            ->signUp('pangdiin', 'pangdiincelestino@yahoo.com', 'password', 'password')
            ->visit('/home')
            ->assertSee('No notes yet')
            ->assertSee('Untitled')
            ->assertValue('#title', '')
            ->assertValue('#body', '');
        });
    }
}
