<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelGmail;

class GmailApiController extends Controller
{
  
	public function oauth_login(){
		return LaravelGmail::redirect();
	}

	public function callback(){
		LaravelGmail::makeToken();
    return redirect()->to('/');
	}
}
