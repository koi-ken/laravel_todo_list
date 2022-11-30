<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ApiUserController extends Controller
{
	/**
		新規登録で登録させる
		@param \Illuminate\Http\Request $request
		@return void
	*/
	public function signup(Request $request){
		$validated = $request->validate([
			'email' => 'required|unique:users|email:rfc,dns',
			'username' => 'required|unique:users|alpha_dash|max:36',
			'password' => 'required|alpha_num|min:9|max:36',
		]);

		$hashed_password = Hash::make($validated['password']);
		DB::table('users')->insert([
			'email' => $validated['email'],
			'username' => $validated['username'],
			'password' => $hashed_password,
			'created_at' => Carbon::now(),
		]);

		if(Auth::attempt([
			'email' => $validated['email'],
			'password' => $validated['password'],
			'username' => $validated['username']
		])){
			$request->session()->regenerate();
			return response()->json([
				'message' => 'success'
			]);
		}

		return response()->json([
			'data' => $validated,
		]);
	}

	/**
		ログインを完了させる
		@param \Illuminate\Http\Request $request
		@return void
	*/
	public function login(Request $request){
		$email_or_username = $request->input('email_or_username');
		$password = $request->input('password');
		$remember_me = $request->input('remember_me');

		$user = DB::table('users')
						->where(function($query) use ($email_or_username) {
							$query->orWhere('email', $email_or_username)
										->orWhere('username', $email_or_username);
						})
						->first();
		
		if(empty($user)){
			return response()->json([
				'message' => 'failure - not exists',
			]);
		}

		if(Auth::attempt([
			'email' => $user->email,
			'username' => $user->username,
			'password' => $password
		], $remember_me)){
			$request->session()->regenerate();
			return response()->json([
				'message' => 'success',
			]);
		}

		return response()->json([
			'message' => 'failure - not authenticated.',
		]);
	}


	/**
		ユーザー情報を取得
		@param
		@return Response
	*/
	public function fetch_userinfo(){
		$user = Auth::user();

		$users = DB::table('users')
								->select('email', 'username')
								->where('id', $user->id)
								->get();

		return response()->json([
			'userinfo' => $users,
		]);
	}

	/**
		ユーザー情報を編集
		@return void
	*/
	public function edit_userinfo(Request $request){
    // Authファサードは読み込みで1回使うと、2回目は取得とれない？
		$user = Auth::user();

		$email = $request->input('email');
		$username = $request->input('username');

		// 変更したデータだけをバリデーションする
		$validate_rules = [];

		if($email !== $user->email){
			$validate_rules['email'] = 'required|unique:users|email:rfc,dns';
		}

		if($username !== $user->username){
			$validate_rules['username'] = 'required|unique:users|regex:/^[a-zA-z0-9]{1,36}$/i';
		}

		if(count($validate_rules) === 0){
			return response()->json([
				'message' => 'same userinfo'
			]);
		}

		$validated = $request->validate($validate_rules);

		$affected = DB::table('users')
								->where('id', $user->id)
								->update(['email' => $email, 'username' => $username]);

		if($affected === 0){
			return response()->json([
				'message' => 'not found',
			]);
		}

		return response()->json([
			'message' => 'success',
		]);
	}

	/**
		ユーザー情報を削除
		@return void
	*/
	public function delete_userinfo(){

	}
}
