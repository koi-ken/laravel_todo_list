<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	/**
		新規登録ページ
		@return void
	*/
	public function signup(){
		return view('pages.signup');
	}

	/**
		ログインページ
		@return void
	*/
	public function login(){
		return view('pages.login');
	}

	/**
		ログアウトページ
		@return void
	*/
	public function logout(Request $request){
		Auth::logout();

		$request->session()->invalidate();

		$request->session()->regenerateToken();

		return redirect('/');
	}

	/**
		ユーザー設定ページ
		@return void
	*/
	public function settings(){

	}
}
