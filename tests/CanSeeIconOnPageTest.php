<?php

namespace Hapidjus\ImpersonateUI\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class CanSeeIconOnPage extends TestCase
{

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_that_home_page_contains_container()
    {

        $response = $this->actingAs($this->user)
		                  ->get('/');

		$response->assertSee('<div id="impersonate-ui"');

    }

    public function test_that_home_page_contains_icon()
    {

    	$response = $this->actingAs($this->user)
                        ->get('/');

    	$response->assertSee('<a id="impersonate-ui-icon"');

    }

    public function tearDown(): void
    {

        $this->user->delete();

        parent::tearDown();

    }
}
