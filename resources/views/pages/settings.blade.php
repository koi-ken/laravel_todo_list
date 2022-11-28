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
				</div>
			</div>
			<div class="mb-3 row">
				<label class="col-sm-3 col-form-label">ユーザー名</label>
				<div class="col-sm-9">
					<input type="text" class="form-control"  id="userinfo_username" />
				</div>
			</div>
			<div class="d-flex">
				<button type="button" id="edit_settings_btn" class="btn btn-primary ms-auto">保存</button>
			</div>
		</form>
	</div>
	<div id="loading_block" class="mx-auto" style="width:40px;">
		<div class="spinner-border" role="status">
  			<span class="visually-hidden">Loading...</span>
		</div>
	</div>
</div>

@endsection