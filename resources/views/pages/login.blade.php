@extends("layouts.layout")

@section('title', 'ログイン')

@section('content')
	<form class="container bg-white px-4 py-5 rounded shadow fw-light" style="max-width:380px;">
		@csrf
		<div class="row mb-3">
			<label for="inputEmail" class="col-sm-12 col-form-label">メールアドレス/ユーザー名</label>
			<div class="col-sm-12">
				<input type="text" class="form-control" id="inputEmailOrUsername">
			</div>
		</div>
		<div class="row mb-3">
			<label for="inputPassword" class="col-sm-12 col-form-label">パスワード</label>
			<div class="col-sm-12">
				<input type="password" class="form-control" id="inputPassword">
			</div>
		</div>

		<div class="form-check">
			<input class="form-check-input" type="checkbox" value="" id="remember_me">
			<lavel class="form-check-label" for="remember_me">
				ログイン状態を維持する
			</lavel>
		</div>
		
		<div class="d-flex mb-auto">
			<button type="button" class="btn btn-primary ms-auto" id="login_btn">ログイン</button>
		</div>
	</form>
@endsection