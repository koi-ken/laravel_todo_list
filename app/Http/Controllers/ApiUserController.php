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
				'message' => 'failure',
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
			'message' => 'failure',
		]);
	}

	/**
		ユーザー情報を取得
		@param
		@return void
	*/
	public function fetch_userinfo(){

	}

	/**
		ユーザー情報を編集
		@return void
	*/
	public function edit_userinfo(){

	}

	/**
		ユーザー情報を削除
		@return void
	*/
	public function delete_userinfo(){

	}
}
