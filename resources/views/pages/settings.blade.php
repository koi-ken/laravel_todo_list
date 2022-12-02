@extends("layouts.layout")

@section('title', '設定 - ToDoリスト')

@section('content')

<div class="bg-white fw-light shadow-sm mx-5 px-4 py-4 rounded">
	<h5 class="mb-3">ユーザー設定</h5>
	<div id="userinfo_block" style="display:none;">
		<form>
			<div class="mb-3 row">
				<label class="col-sm-3 col-form-label">Eメール</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="userinfo_email" />
					<div class="valid-feedback">
						OKです
					</div>
					<div class="invalid-feedback">

					</div>
				</div>
			</div>
			<div class="mb-3 row">
				<label class="col-sm-3 col-form-label">ユーザー名</label>
				<div class="col-sm-9">
					<input type="text" class="form-control"  id="userinfo_username" />
					<div class="valid-feedback">
						OKです
					</div>
					<div class="invalid-feedback">

					</div>
				</div>
			</div>
			<div class="d-flex">
				<button type="button" id="edit_userinfo_btn" class="btn btn-primary ms-auto">保存</button>
			</div>
		</form>
		<div class="border-top mt-4">
		</div>
		<div class="my-2">
			<h5 class="my-3">ユーザー情報削除</h5>
			<form>
				<div class="col mb-3">
					アカウントを削除する場合、以下のフォームに『<label class="form-label fw-bold" id="random-string"></label>』と入力してから、削除ボタンを押してください。
				</div>
				<div class="col mb-3">
					<input type="text" class="form-control" id="input-random-string">
				</div>
				<div class="d-flex">
					<button type="button" id="delete_userinfo_btn" class="btn btn-danger ms-auto" disabled>削除</button>
				</div>
			</form>
		</div>
	</div>
	<div id="loading_block" class="mx-auto" style="width:40px;">
		<div class="spinner-border" role="status">
  			<span class="visually-hidden">Loading...</span>
		</div>
	</div>
</div>

@endsection