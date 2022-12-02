@extends("layouts.layout")

@section('title', 'トップページ')

@section('content')
<div style="max-width:550px;text-align:center;margin-left:auto;margin-right:auto;padding:15px;">
	<h1>身の回りのタスクを整理しよう。</h1>
	<h6 class="fw-light">仕事で行うたくさんのタスク、日々の生活の中でやらなければならないタスクを一元して管理し、スッキリしましょう。</h6>
	<button class="btn btn-danger fw-bold" onclick="location.href='/signup'">今すぐ開始する</button>
</div>
<div class="m-3 p-1" style="text-align:center;">
	<h2 class="fw-light">やることは2ステップ</h2>
</div>
<div class="d-flex" style="max-width:600px;margin-left:auto;margin-right:auto;">
	<div class="p-2 flex-fill" style="text-align:center;">
		<div class="m-3">
			<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
			  <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
			</svg>
		</div>
		<div class="fw-light">
			思いついたタスクを書き込む
		</div>
	</div>
	<div class="p-2 flex-fill"  style="text-align:center;">
		<div class="m-3">
			<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check2-square" viewBox="0 0 16 16">
			  <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z"/>
			  <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
			</svg>
		</div>
		<div class="fw-light">
			終わったら、タスクにチェックを入れる
		</div>
	</div>
</div>
<div class="m-5 p-1" style="text-align:center;">
	<h2 class="fw-light">たった、これだけ。</h2>
</div>
@endsection