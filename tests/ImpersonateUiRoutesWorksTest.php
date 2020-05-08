<?php

namespace Hapidjus\ImpersonateUI\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class ImpersonateUiRoutesWorksTest extends TestCase
{

    public function testCanSeeHome()
    {

    	$response = $this->actingAs($this->user)
	    	->get('home');

    	$response->assertStatus(200);

    }

    public function testCantSeeHomeAsNonAuth()
    {

    	$response = $this->get('home');

    	$response->assertRedirect();

    }

    public function testImpersonateUiRoutesWorks()
    {

        $newUser = factory(User::class)->create();

        $response = $this->actingAs($this->user)
                            ->get('home');

        $response->assertSee('<span id="current-user"><strong>'.$this->user->name.'</strong></span>');

        $response = $this->actingAs($this->user)
                            ->followingRedirects()
                            ->post('impersonate-ui', ['impersonate_id' => $newUser->id]);


        $response->assertSee('<span id="current-user"><strong>'.$newUser->name.'</strong></span>');

        $response = $this->actingAs($newUser)
                            ->followingRedirects()
                            ->get('impersonate-ui');

        $response->assertSee($this->user->name);

        $newUser->delete();
    }

    public function tearDown(): void
    {

        $this->user->delete();

        parent::tearDown();

    }


}
