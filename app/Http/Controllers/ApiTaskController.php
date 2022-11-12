<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApiTaskController extends Controller
{
	/**
		タスク一覧を取得
		@param
		@return 
	*/
	public function fetch_tasks(Request $request){
		$page = $request->input("page");
		

		//認証して大丈夫ならば
		//データベースを取ってくる
		$offset = ($page - 1) * 15;
		$user = Auth::user();
		$tasks = DB::table('tasks')
				->where('user_id', $user->id)
				->where('finished_task', false)
				->orderByDesc('id')
				->offset($offset)
				->limit(15)
				->get();

		return response()->json([
			'message' => 'success',
			'tasks' => $tasks
		]);
	}

	/**
		単一のタスクを取得
		@param
		@return 
	*/
	public function fetch_task(){

	}

	/**
		単一のタスクを取得
		@param
		@return 
	*/
	public function add_task(Request $request){
		$task = $request->input("task");

		$validated = $request->validate([
			'task' => 'required',
		]);

		$user = Auth::user();
		$id = DB::table('tasks')->insertGetId([
			'task' => $task,
			'user_id' => $user->id,
			'created_at' => Carbon::now(),
		]);

		return response()->json([
			'message' => 'success',
			'id' => $id,
		]);
	}

	/**
		タスクの完了済み/未完了を切り替える
		@return
	*/
	public function toggle_task_achive(Request $request){
		$task_id = $request->input('task_id');
		$finished = $request->input('finished');

		$validated = $request->validate([
			'task_id' => 'required|numeric',
			'finished' => 'required|boolean',
		]);

		$user = Auth::user();
		$affected = DB::table('tasks')
								->where('id', $task_id)
								->where('user_id', $user->id)
								->update(['finished_task' => $finished]);

		return response()->json([
			'message' => 'success',
		]);
	}

	/**
		タスクを編集
		@return
	*/
	public function edit_task(){

	}

	/**
		タスクを削除
		@return
	*/
	public function delete_task(){

	}
}
