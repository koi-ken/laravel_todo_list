@extends("layouts.layout")

@section('title', 'タスクリスト')

@section('content')

<div id="task_list" class="mb-2">

</div>
<div id="loading_btn_block" class="my-2">
	<div class="mx-auto" style="width:119.9px;">
		<button class="btn btn-primary fw-light" data-page="1" id="loading_btn" style="display:none;">さらに読み込む</button>
		<div id="loading_icon" style="width:30px;margin-left:auto;margin-right:auto;">
			<span class="spinner-border" style="" role="status" aria-hidden="true" id="loading_icon"></span>
		</div>
	</div>
</div>
<div style="height:70px;">

</div>
<div class="fixed-bottom bg-white container-fluid shadow">
	<form class="bg-white my-3" onsubmit="return false;">
		@csrf
		<div class="mb-3">
			<div class="input-group">
				<input type="text" class="form-control" id="task_form" placeholder="ここにタスクを入力">
				<button class="btn btn-outline-secondary" id="add_task_btn">
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
  					<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
					</svg>
				</button>
			</div>
		</div>
	</form>
</div>

@endsection