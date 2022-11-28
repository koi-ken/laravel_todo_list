<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
	/**
		タスク一覧を表示する
		@retrun void
	*/
	public function task_list(){
		if(!Auth::check()){
			return view('pages.toppage');
		}

		return view('pages.task_list');
	}


}
