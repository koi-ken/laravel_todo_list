@extends("layouts.layout")

@section('title', 'タスクリスト')

@section('content')
	<h1>タスクリスト</h1>

<div class="fixed-bottom bg-white container-fluid shadow">
	<form class="bg-white my-3" onsubmit="return false;">
		<div class="mb-3">
			<input type="text" class="form-control">
		</div>
	</form>
</div>

@endsection