<?php

namespace Tests\Feature;

use App\Models\Teams;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use DatabaseTransactions;

   public function test_get_all_team(){

       $teams = Teams::factory()->count(10)->create();

       $response = $this->getJson('/api/teams');
       $response->assertStatus(200);
   }

   public function test_wrong_uri_to_get_all_team(){

       $teams = Teams::factory()->count(10)->create();

       $response = $this->getJson('/api/teams/list');
       $response->assertStatus(404);
   }

    public function test_create_a_team(){

       $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/team',[
            'name' => 'Driver GTeam',
            'logo' => new \Illuminate\Http\UploadedFile(public_path('test-files/sc.jpg'), 'sc.jpg', null, null, true)
        ]);
        $response->assertStatus(201);
    }

    public function test_create_with_invalid_data_a_team(){

        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/team',[
            'name' => 'Driver GTeam',
            'logo' => 'test-file/sc.jpg'
        ]);
        $response->assertStatus(422);
    }

    public function test_create_a_team_without_login(){


        $response = $this->postJson('/api/team',[
            'name' => 'Driver GTeam',
            'logo' => new \Illuminate\Http\UploadedFile(public_path('test-files/sc.jpg'), 'sc.jpg', null, null, true)
        ]);
        $response->assertStatus(401);
    }

    public function test_edit_a_team(){

        $user = User::factory()->create();
        $team = Teams::factory()->create();

        $response = $this->actingAs($user)->putJson('/api/team/'.$team->id,[
            'name' => 'Gteam',
        ]);
        $response->assertStatus(202);
    }

    public function test_edit_a_team_with_invalid_data(){

        $user = User::factory()->create();
        $team = Teams::factory()->create();

        $response = $this->actingAs($user)->putJson('/api/team/'.$team->id,[
            'name' => new \Illuminate\Http\UploadedFile(public_path('test-files/sc.jpg'), 'sc.jpg', null, null, true)
        ]);
        $response->assertStatus(422);
        $response->assertJsonMissing(['massage' => 'Update Team successfully']);
    }

    public function test_delete_a_team(){
        $user = User::factory()->create();
        $team = Teams::factory()->create();

        $response = $this->actingAs($user)->deleteJson('/api/team/'.$team->id);
        $response->assertStatus(204);
    }

    public function test_delete_a_team_without_login(){
        $team = Teams::factory()->create();

        $response = $this->deleteJson('/api/team/'.$team->id);
        $response->assertStatus(401);
    }



}
