<?php

namespace Tests\Feature;

use App\Models\Players;
use App\Models\Teams;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PlayerTest extends TestCase
{
    use DatabaseTransactions;


    public function test_get_all_player_of_team(){

        $teams = Teams::factory()->create();
        $player = Players::factory()->count(10)->create([
            'team_id'=>$teams->id
        ]);

        $response = $this->get('/api/team/'.$teams->id.'/players');
        $response->assertStatus(200);
        $response->assertJson(['data'=>$player->toArray()]);
    }

    public function test_wrong_uri_to_get_all_player_of_team(){

        $team = Teams::factory()->create();
        $player = Players::factory()->count(10)->create([
            'team_id'=>$team->id
        ]);

        $response = $this->get('/api/teams/'.$team->id.'/players');
        $response->assertStatus(404);
    }

    public function test_create_a_player(){

        $user = User::factory()->create();
        $team = Teams::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/player',[
            'first_name' => 'mark',
            'last_name' => 'star',
            'image' => new \Illuminate\Http\UploadedFile(public_path('test-files/sc.jpg'), 'sc.jpg', null, null, true),
            'team' => $team->id
        ]);
        $response->assertStatus(201);
    }

    public function test_create_a_player_with_invalid_data(){
        $user = User::factory()->create();

        $response = $this->actingAs($user)->postJson('/api/player',[
            'first_name' => 'mark',
            'last_name' => 'star',
            'image' => 'AAsa/AsaS/AsSA.jpg'
        ]);
        $response->assertStatus(422);
    }

    public function test_create_a_player_without_login(){


        $team = Teams::factory()->create();

        $response = $this->postJson('/api/player',[
            'first_name' => 'mark',
            'last_name' => 'star',
            'image' => new \Illuminate\Http\UploadedFile(public_path('test-files/sc.jpg'), 'sc.jpg', null, null, true),
            'team_id' => $team->id
        ]);
        $response->assertStatus(401);
    }

    public function test_edit_a_player(){
        $user = User::factory()->create();
        $team = Teams::factory()->create();
        $player = Players::factory()->create(['team_id'=>$team->id]);

        $response = $this->actingAs($user)->putJson('api/player/'.$player->id,[
            'first_name'=>'test1',
            'last_name'=>'two',
        ]);
        $response->assertStatus(202);

    }

    public function test_edit_a_player_with_invalid_data(){

        $user = User::factory()->create();
        $player = Players::factory()->create();

        $response = $this->actingAs($user)->putJson('/api/player/'.$player->id,[
            'name' => new \Illuminate\Http\UploadedFile(public_path('test-files/sc.jpg'), 'sc.jpg', null, null, true)
        ]);
        $response->assertStatus(422);
        $response->assertJsonMissing(['massage' => 'Players updated successfully']);
    }

    public function test_delete_a_player(){
        $user = User::factory()->create();
        $player = Players::factory()->create();

        $response = $this->actingAs($user)->deleteJson('/api/player/'.$player->id);
        $response->assertStatus(204);
    }

    public function test_delete_a_player_without_login(){
        $player = Players::factory()->create();

        $response = $this->deleteJson('/api/player/'.$player->id);
        $response->assertStatus(401);
    }
}
