<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
	<div class="container-fluid fw-light">
		<a class="navbar-brand" href="/">
			ToDoリスト
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-2">
				@auth
				<li class="nav-item">
					<a href="/logout">ログアウト</a>
				</li>
				@endauth
				@guest
				<li class="nav-item">
					<a href="/login">ログイン</a>
				</li>
				@endguest
				<li class="nav-item">
					<a href="/signup">新規登録</a>
				</li>
			</ul>
		</div>
	</div>
</nav>