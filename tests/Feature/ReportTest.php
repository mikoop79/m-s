<?php

namespace Tests\Feature;

use App\User;
use App\Report;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ReportTest extends TestCase
{
	use RefreshDatabase;
	use DatabaseMigrations;
	
    /** @test */
    function report_can_be_added_to_database()
    {
        $this->disableExceptionHandling();
    	// add one report to the db
    	$report = factory(Report::class)->make()->toArray();

        $this->json('POST','/reports', $report)
            ->assertStatus(201)
            ->assertJson([
                'id' => true,
                'name' => true,    
                'description' => true,
                'created_at' => true,
                'updated_at' => true]
            );

        $this->assertDatabaseHas('reports', $report);
    }

    /** @test */
    function can_view_list_of_reports()
    {
        $this->disableExceptionHandling();   
        $reports = factory('App\Report', 5)->create();
        $this->get('/reports')
            ->assertStatus(200)
            ->assertJson($reports->toArray());

    }

    /** @test */
    function check_user_can_not_add_empty_report()
    {
        $this->json('POST','/reports', [])
            ->assertStatus(201)
            ->assertJson([
                'id' => true,
                'name' => true,    
                'description' => true,
                'created_at' => true,
                'updated_at' => true]
            );
    }
}
