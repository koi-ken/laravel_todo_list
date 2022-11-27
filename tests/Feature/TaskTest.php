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

    /**
     * ログインした状態でデータを編集して成功させる
     *
     * @return void
     */
		public function test_edit_task(){
				$user = User::factory()->create();

				// データを追加する
				$response = $this->actingAs($user)->postJson('/api/v1/add_task',[
					'task' => "歯を磨く",
				]);

				$response->assertStatus(200);

				// データを編集する
       // successが返る
				$response = $this->actingAs($user)->postJson('/api/v1/edit_task', [
					'task' => "顔を洗う",
					'task_id' => 2
				]);


				$response
					->assertStatus(200)
					->assertExactJson([
						'message' => 'success',
					]);
		}


    /**
     * ログインした状態でデータを編集して失敗させる
     *
     * @return void
     */
		public function test_fail_edit_task(){
				$user = User::factory()->create();

				// データを追加する
				$response = $this->actingAs($user)->postJson('/api/v1/add_task',[
					'task' => "歯を磨く",
				]);

				$response->assertStatus(200);

				// タスクを入れないで編集する
        // 422のステータスコードが返る
				$response = $this->actingAs($user)->postJson('/api/v1/edit_task', [
					'task' => "",
					'task_id' => 2
				]);

				$response
					->assertStatus(422)
					->assertExactJson([
						'errors' => [
							'task' => ['The task field is required.']
						],
						'message' => 'The task field is required.'
					]);

				// task_idを入れないで編集する
        // 422のステータスコードが返る
				$response = $this->actingAs($user)->postJson('/api/v1/edit_task', [
					'task' => "ヒゲを剃る",
					'task_id' => ""
				]);

				$response
					->assertStatus(422)
					->assertExactJson([
						'errors' => [
							'task_id' => ['The task id field is required.']
						],
						'message' => 'The task id field is required.'
					]);

       // task_idに数字(数字文字列)じゃない値をいれて編集する
       // SQLSTATE[22P02]: Invalid text representation 500のステータスコードが返った。
				$response = $this->actingAs($user)->postJson('/api/v1/edit_task', [
					'task' => "ヒゲを剃る",
					'task_id' => "test"
				]);

				$response->assertStatus(500);

        // task_idに0を渡す
        // 200のステータスコードで、not foundが返る。
				$response = $this->actingAs($user)->postJson('/api/v1/edit_task', [
					'task' => "ヒゲを剃る",
					'task_id' => -1
				]);

				$response
					->assertStatus(200)
					->assertExactJson([
						'message' => 'not found',
					]);

        // task_idに負の値を渡す
        // 200のステータスコードで、not foundが返る。
				$response = $this->actingAs($user)->postJson('/api/v1/edit_task', [
					'task' => "ヒゲを剃る",
					'task_id' => -1
				]);

				$response
					->assertStatus(200)
					->assertExactJson([
						'message' => 'not found',
					]);
		}
}
