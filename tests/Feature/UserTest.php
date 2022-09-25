<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

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
		 * email、useranme、password共に空のデータを送信
		 *
		 */
    public function test_post_request_with_empty_data()
    {
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' =>'',
					'password' => ''
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 不正なemail、空のuseranme、空のpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_invalid_email_and_empty_username_and_empty_password()
    {
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' =>'',
					'password' => ''
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 空のemail、不正なuseranme、空のpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_empty_email_and_invalid_username_and_empty_password()
    {
				// 英数字以外の文字列
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' => $this->invalid_username_non_alpha,
					'password' => ''
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上の文字列
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' => $this->invalid_username_more,
					'password' => ''
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 空のemail、空のuseranme、不正なpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_empty_email_and_empty_username_and_invalid_password()
    {
				// パスワードが9文字以下の場合
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' =>'',
					'password' => $this->invalid_password_less
				]);

        $response->assertStatus(422);

				$response->dump();

				// パスワードが36文字以下の場合
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' =>'',
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// パスワードが英数字じゃない文字が含まれていた場合
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' =>'',
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();


    }

		/**
		 * 不正のemail、不正のuseranme、空のpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_invalid_email_and_invalid_username_and_empty_password()
    {
				// 英数字以外の文字列
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->invalid_username_non_alpha,
					'password' => ''
				]);

        $response->assertStatus(422);

				$response->dump();


				// 36文字以上の文字列
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->invalid_username_more,
					'password' => ''
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 空のemail、不正のuseranme、不正のpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_empty_email_and_invalid_username_and_invalid_password()
    {
				// 英数字以外の文字列 + 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// 英数字以外の文字列 + 36文字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上の文字列 + 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' => $this->invalid_username_more,
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上の文字列 + 36文字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => '',
					'username' => $this->invalid_username_more,
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 不正なemail、空のuseranme、不正なpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_invalid_email_and_empty_username_and_invalid_password()
    {
				// パスワードが英数字ではない
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' =>'',
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// パスワードが36文字以上
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' =>'',
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// パスワードが9文字以上
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' =>'',
					'password' => $this->invalid_password_less
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 不正なemail、不正なuseranme、不正なpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_invalid_email_and_invalid_username_and_invalid_password()
    {
				// 英数字以外の文字列 + 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// 英数字以外の文字列 + 36文字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上の文字列 + 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->invalid_username_more,
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上の文字列 + 36文字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->invalid_username_more,
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();
    }


		/**
		 * 正しいemail、空のuseranme、空のpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_valid_email_and_empty_username_and_empty_password()
    {
				// 英数字以外の文字列 + 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => "",
					'password' => ""
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 空のemail、正しいuseranme、空のpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_empty_email_and_valid_username_and_empty_password()
    {
				
        $response = $this->postJson('/api/v1/signup', [
					'email' => "",
					'username' => $this->valid_username,
					'password' => ""
				]);

        $response->assertStatus(422);

				$response->dump();
    }


		/**
		 * 空のemail、空のuseranme、正しいpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_empty_email_and_empty_username_and_valid_password()
    {
				
        $response = $this->postJson('/api/v1/signup', [
					'email' => "",
					'username' => "",
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();
    }


		/**
		 * 正しいemail、正しいuseranme、空のpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_valid_email_and_valid_username_and_empty_password()
    {
				
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => ""
				]);

        $response->assertStatus(422);

				$response->dump();
    }


		/**
		 * 正しいemail、空のuseranme、正しいpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_valid_email_and_empty_username_and_valid_password()
    {
				
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => "",
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 空のemail、正しいuseranme、正しいpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_empty_email_and_valid_username_and_valid_password()
    {
				
        $response = $this->postJson('/api/v1/signup', [
					'email' => "",
					'username' => $this->valid_username,
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 正しいemail、不正なuseranme、不正なpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_valid_email_and_invalid_username_and_invalid_password()
    {
				// 英数字以外のユーザー名 + 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// 英数字以外のユーザー名 + 36字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// 英数字以外のユーザー名 + 9文字以下のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->invalid_password_less
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以外のユーザー名 + 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_more,
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以外のユーザー名 + 36文字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_more,
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以外のユーザー名 + 9文字以下のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_more,
					'password' => $this->invalid_password_less
				]);

        $response->assertStatus(422);

				$response->dump();
    }


		/**
		 * 不正なemail、正しいuseranme、不正なpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_invalid_email_and_valid_username_and_invalid_password()
    {
				
				// 36文字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->valid_username,
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// 9文字以下のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->valid_username,
					'password' => $this->invalid_password_less
				]);

        $response->assertStatus(422);

				$response->dump();

				// 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->valid_username,
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();
    }



		/**
		 * 不正なemail、不正なuseranme、正しいpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_invalid_email_and_invalid_username_and_valid_password()
    {
				
				// 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->invalid_username_more,
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();

    }


		/**
		 * 正しいemail、正しいuseranme、不正なpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_valid_email_and_valid_username_and_invalid_password()
    {
				
				// 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// 9字以下のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => $this->invalid_password_less
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 正しいemail、不正なuseranme、正しいpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_valid_email_and_invalid_username_and_valid_password()
    {
				
				// 英数字以外のユーザー名
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上のユーザー名
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_more,
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();
    }


		/**
		 * 不正なemail、正しいuseranme、正しいpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_invalid_email_and_valid_username_and_valid_password()
    {
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->valid_username,
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();
    }


		/**
		 * 正しいemail、不正なuseranme、空のpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_valid_email_and_invalid_username_and_empty_password()
    {
				
				// 英数字以外のユーザー名
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_non_alpha,
					'password' => ""
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上のユーザー名
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->invalid_username_more,
					'password' => ""
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 正しいemail、空のuseranme、不正なpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_valid_email_and_empty_username_and_invalid_password()
    {
				
				// 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => "",
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => "",
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// 9文字以下のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => "",
					'password' => $this->invalid_password_less
				]);

        $response->assertStatus(422);

				$response->dump();
    }


		/**
		 * 不正なemail、空のuseranme、正しいpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_invalid_email_and_empty_username_and_valid_password()
    {
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => "",
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 不正なemail、正しいuseranme、空のpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_invalid_email_and_valid_username_and_empty_password()
    {
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->invalid_email,
					'username' => $this->valid_username,
					'password' => ""
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 空のemail、正しいuseranme、不正なpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_empty_email_and_valid_username_and_invalid_password()
    {
				// 英数字以外のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => "",
					'username' => $this->valid_username,
					'password' => $this->invalid_password_non_alpha
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => "",
					'username' => $this->valid_username,
					'password' => $this->invalid_password_more
				]);

        $response->assertStatus(422);

				$response->dump();

				// 9文字以下のパスワード
        $response = $this->postJson('/api/v1/signup', [
					'email' => "",
					'username' => $this->valid_username,
					'password' => $this->invalid_password_less
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 空のemail、不正なuseranme、正しいpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_empty_email_and_invalid_username_and_valid_password()
    {
				// 英数字以外のユーザー名
        $response = $this->postJson('/api/v1/signup', [
					'email' => "",
					'username' => $this->invalid_username_non_alpha,
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();

				// 36文字以上のユーザー名
        $response = $this->postJson('/api/v1/signup', [
					'email' => "",
					'username' => $this->invalid_username_more,
					'password' => $this->valid_password
				]);

        $response->assertStatus(422);

				$response->dump();
    }

		/**
		 * 正しいemail、正しいuseranme、正しいpasswordのデータを送信
		 *
		 */
    public function test_post_request_with_valid_email_and_valid_username_and_valid_password()
    {
        $response = $this->postJson('/api/v1/signup', [
					'email' => $this->valid_email,
					'username' => $this->valid_username,
					'password' => $this->valid_password
				]);

        $response->assertStatus(200);

				$response->dump();
    }
}
