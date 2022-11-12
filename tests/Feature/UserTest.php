<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use Carbon\Carbon;

class UserTest extends TestCase
{
		use RefreshDatabase;

    // 正しい形式のEメール
		private $valid_email = "validemail@google.com";

		// 不正な形式のEメール
		private $invalid_email = "invalidmailaddressgoogle.com";

		// 正しいユーザー名
    private $valid_username = "username";

		// 英数字とダッシュ以外のユーザー名
		private $invalid_username_non_alpha = "*+vswy3#あ";

		// 36字以上のユーザー名
		private $invalid_username_more = "ifh48chsjx6rhoxpqhfp7gp0shepgukd4owis3ptjyhv9pcfukrld";

    // 正しいパスワード
		private $valid_password = "k3bruxt8spz";

    // 36文字以上のパスワード
		private $invalid_password_more = "ojfu4hd8wo293gwjsouyph0fywfo4jgudhvpg8rlgu5igpeofeprjt";

		// 9文字以下のパスワード
		private $invalid_password_less = "yuc8rldh";

    // 英数字以外のパスワード
    private $invalid_password_non_alpha = "i*fs+<q4o?*";

		/**
		 * 新規登録時に、email、useranme、password共に間違った組み合わせのデータを送信
		 *
		 */

    public function test_post_request_with_invalid_data()
    {
				$email_arr = ['', $this->invalid_email, $this->valid_email];
				$username_arr = ['', $this->invalid_username_non_alpha, $this->invalid_username_more, $this->valid_username];
				$password_arr = ['', $this->invalid_password_more, $this->invalid_password_less, $this->valid_password];

				for($i = 0; $i < count($email_arr); $i++){
					for($j = 0; $j < count($username_arr); $j++){
						for($k = 0; $k < count($password_arr); $k++){
							if($i !== count($email_arr) - 1 && $j !== count($username_arr) - 1 && $k !== count($password_arr) - 1){

								$response = $this->postJson('/api/v1/signup', [
									'email' => $email_arr[$i],
									'username' => $username_arr[$j],
									'password' => $password_arr[$k]
								]);

								$response->assertStatus(422);

							}
						}
					}
				}
    }


		/**
		 * 新規登録時に、email、useranme、password共にの正しいデータを送信
		 *
		 */
    public function test_post_request_with_valid_data()
    {
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => $this->valid_password
				]);

        $response->assertStatus(200);

    }

		/**
		 * 間違ったusernameと正しいpasswordでデータ送信しログイン
     * 間違ったemailと間違ったpasswordでデータ送信しログイン
		 *
		 */
    public function test_post_login_invalid_username_or_email_and_invalid_password()
    {

				// ファクトリでユーザーデータを、属性のオーバーライドで作成する
				$user = User::factory()->create([
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => Hash::make($this->valid_password),
					'created_at' => Carbon::now(),
				]);

				$email_arr = ['', $this->invalid_email, $this->valid_email];
				$username_arr = ['', $this->invalid_username_non_alpha, $this->invalid_username_more, $this->valid_username];
				$password_arr = ['', $this->invalid_password_more, $this->invalid_password_less, $this->valid_password];

				for($j = 0; $j < count($username_arr); $j++){
					for($k = 0; $k < count($password_arr); $k++){
						if($j !== count($username_arr) - 1 && $k !== count($password_arr) - 1){

							$response = $this->postJson('/api/v1/login', [
													'email_or_username' => $username_arr[$j],
													'password' => $password_arr[$k],
													'remember_me' => true
							]);


							$response->assertStatus(200)
							->assertExactJson([
								'message' => 'failure - not exists',
							]);

						}
					}
				}


				for($j = 0; $j < count($email_arr); $j++){
					for($k = 0; $k < count($password_arr); $k++){
						if($j !== count($email_arr) - 1 && $k !== count($password_arr) - 1){

							$response = $this->postJson('/api/v1/login', [
													'email_or_username' => $email_arr[$j],
													'password' => $password_arr[$k],
													'remember_me' => true
							]);

							$response->assertStatus(200)
							->assertExactJson([
								'message' => 'failure - not exists',
							]);

						}
					}
				}
    }


		/**
		 * 正しいusernameと正しいpasswordでデータ送信しログイン
		 *
		 */
    public function test_post_login_valid_username_and_valid_password()
    {

				// ファクトリでユーザーデータを、属性のオーバーライドで作成する
				$user = User::factory()->create([
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => Hash::make($this->valid_password),
					'created_at' => Carbon::now(),
				]);

				$response = $this->actingAs($user, 'web')
										->postJson('/api/v1/login', [
					'email_or_username' => $this->valid_username,
					'password' => $this->valid_password,
					'remember_me' => true
				]);


				$response
					->assertStatus(200)
					->assertExactJson([
						'message' => 'success',
					]);
    }

		/**
		 * 正しいemailと正しいpasswordでデータ送信しログイン
		 *
		 */
    public function test_post_login_valid_email_and_valid_password()
    {

				// ファクトリでユーザーデータを、属性のオーバーライドで作成する
				$user = User::factory()->create([
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => Hash::make($this->valid_password),
					'created_at' => Carbon::now(),
				]);

				$response = $this->actingAs($user, 'web')
										->postJson('/api/v1/login', [
					'email_or_username' => $this->valid_email,
					'password' => $this->valid_password,
					'remember_me' => true
				]);

				$response
					->assertStatus(200)
					->assertExactJson([
						'message' => 'success',
					]);

    }

		/**
		 * ログインページへアクセスする
		 *
		 */
		public function test_access_login(){

			$response = $this->get('/login');
			$response->assertStatus(200);

		}

		/**
		 * 新規登録ページへアクセスする
		 *
		 */
		public function test_access_signup(){

			$response = $this->get('/signup');
			$response->assertStatus(200);

		}

		/**
		 * ログインした状態でログアウトする
		 *
		 */
    public function test_logout()
    {
				// ファクトリでユーザーデータを、属性のオーバーライドで作成する
				$user = User::factory()->create([
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => Hash::make($this->valid_password),
					'created_at' => Carbon::now(),
				]);

        $response = $this->actingAs($user, 'web')->get('/logout');

        // リダイレクトする
				$response->assertStatus(302);
    }

}
