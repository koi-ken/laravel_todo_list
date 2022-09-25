<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-5 ctm-navbar-block">
	<div class="container-fluid fw-light">
		ToDoリスト
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
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