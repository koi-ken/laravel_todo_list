<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class TaskTest extends TestCase
{
    /**
     * ログインした状態でタスクリストのページへアクセス
     *
     * @return void
     */
    public function test_get_tasklist()
    {

				$user = User::factory()->create();

				$response = $this->actingAs($user)->get('/');

        $response->assertStatus(200);
    }


    /**
     * ログインした状態でデータを投稿する
     *
     * @return void
     */
    public function test_add_task()
    {

				$user = User::factory()->create();

				$response = $this->actingAs($user)->postJson('/api/v1/add_task',[
					'task' => "歯を磨く",
				]);

        $response->assertStatus(200);
    }
}
