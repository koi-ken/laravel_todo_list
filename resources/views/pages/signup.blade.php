@extends("layouts.layout")

@section('title', '新規登録')

@section('content')
	<form class="container bg-white px-4 py-5 rounded shadow fw-light" style="max-width:380px;">
		@csrf
		<div class="row mb-3">
			<label for="inputEmail" class="col-sm-12 col-form-label">メールアドレス</label>
			<div class="col-sm-12">
				<input type="email" class="form-control" id="inputEmail">
				<div class="valid-feedback">
					正しいメールアドレスです
				</div>
				<div class="invalid-feedback">
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<label for="inputUsername" class="col-sm-12 col-form-label">ユーザー名</label>
			<div class="col-sm-12">
				<input type="text" class="form-control" id="inputUsername">
				<div class="valid-feedback">
					正しいユーザー名です
				</div>
				<div class="invalid-feedback">
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<label for="inputPassword" class="col-sm-12 col-form-label">パスワード</label>
			<div class="col-sm-12">
				<input type="password" class="form-control" id="inputPassword">
				<div class="valid-feedback">
					正しいパスワードです
				</div>
				<div class="invalid-feedback">
				</div>
			</div>
		</div>
		<div class="row mb-3">
			<label for="inputPasswordOneMore" class="col-sm-12 col-form-label">パスワード(もう一度)</label>
			<div class="col-sm-12">
				<input type="password" class="form-control" id="inputPasswordOneMore">
				<div class="valid-feedback">
					正しいパスワードです
				</div>
				<div class="invalid-feedback">
				</div>
			</div>
		</div>
		<div class="d-flex mb-auto">
			<button type="button" class="btn btn-primary ms-auto" id="signup_btn">新規登録</button>
		</div>
	</form>
@endsection

