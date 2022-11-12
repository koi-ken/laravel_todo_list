<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{

		/** 
		* 正しいユーザー名
		* @val string
		*/
		private $valid_username = 'koiken';

		/**
		* 正しいメールアドレス
　　* @val string
		*/
		private $valid_email = '';

		/**
		* 正しいパスワード
　　* @val string
		*/
		private $valid_password = 'youtubers';

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function login_post_data()
    {

    }
}
