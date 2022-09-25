(function(){
	$('#signup_btn').on('click', function(){

		var email = $('#inputEmail').val();
		var username = $('#inputUsername').val();
		var password = $('#inputPassword').val();
		var password_one_more = $('#inputPasswordOneMore').val();

		if(email === '' || username === '' || password === '' || password_one_more === ''){
			alert("入力されていない項目があります");
			return false;
		}

		if(password !== password_one_more){
			alert("パスワードが一致しません");
			return false
		}


		$('#signup_btn').attr('disabled', true);
		$('#signup_btn').html(' \
			<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> \
			処理中 \
		');


		axios.post('/api/v1/signup',{
			email: email,
			username: username,
			password: password,
		}).then(function(res){
			$('#inputEmail').removeClass('is-invalid');
			$('#inputUsername').removeClass('is-invalid');
			$('#inputPassword').removeClass('is-invalid');
			$('#inputEmail').addClass('is-valid');
			$('#inputUsername').addClass('is-valid');
			$('#inputPassword').removeClass('is-valid');

			if(res.data.message === 'success'){
				location.href = "/";
			}

		}).catch(function(err){
			var res = err.response.status;

			if(res === 422){
				var errors = err.response.data.errors;
				

				if(errors.email){
					$('#inputEmail').removeClass('is-valid');
					$('#inputEmail').addClass('is-invalid');
					if( errors.email[0] === 'The email must be a valid email address.'){
						$('.invalid-feedback').eq(0).html('Eメールが不正な形式です');
					}else if(errors.email[0] === 'The email has already been taken.'){
						$('.invalid-feedback').eq(0).html('Eメールはすでに登録されています');
					}else if(errors.email[0] === 'The email field is required.'){
						$('.invalid-feedback').eq(0).html('Eメールが空です');
					}
				}else{
					$('#inputEmail').removeClass('is-invalid');
					$('#inputEmail').addClass('is-valid');
				}

				if(errors.username){
					$('#inputUsername').removeClass('is-valid');
					$('#inputUsername').addClass('is-invalid');
					if(errors.username[0] === 'The username has already been taken.'){
						$('.invalid-feedback').eq(1).html('ユーザー名はすでに登録されています');
					}else if(errors.username[0] === 'The username field is required.'){
						$('.invalid-feedback').eq(1).html('ユーザー名が空です');
					}
				}else{
					$('#inputUsername').removeClass('is-invalid');
					$('#inputUsername').addClass('is-valid');
				}

				if(errors.password){
					$('#inputPassword').removeClass('is-valid');
					$('#inputPassword').addClass('is-invalid');
					if(errors.password[0] === 'The password field is required.'){
						$('.invalid-feedback').eq(2).html('パスワードが空です');
					}else if(errors.password[0] === 'The password must be at least 9 characters.'){
						$('.invalid-feedback').eq(2).html('パスワードは最低9文字以上の英数字にしてください');
					}else if(errors.password[0] === 'The password must not be greater than 36 characters.'){
						$('.invalid-feedback').eq(2).html('パスワードは最大36文字以下の英数字にしてください');
					}
				}else{
					$('#inputPassword').removeClass('is-invalid');
					$('#inputPassword').addClass('is-valid');
				}
			}
		}).finally(function(){
			$('#signup_btn').attr('disabled', false);
			$('#signup_btn').html("新規登録");

		});

	});

	$('#login_btn').on('click', function(){
		var email_or_username = $('#inputEmailOrUsername').val();
		var password = $('#inputPassword').val();
		var remember_me = $('#remember_me').prop("checked");
		
		if(email_or_username === '' || password === ''){
			alert('必要なデータが入力されていません');
			return false;
		}

		$('#login_btn').attr('disabled', true);
		$('#login_btn').html(' \
			<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> \
			処理中 \
		');

		axios.post('/api/v1/login',{
			email_or_username: email_or_username,
			password: password,
			remember_me: remember_me,
		}).then(function(res){
			$('#inputEmailOrUsername').removeClass('is-invalid');
			$('#inputPassword').removeClass('is-invalid');
			$('#inputEmailOrUsername').addClass('is-valid');
			$('#inputPassword').removeClass('is-valid');

			if(res.data.message === 'success'){
				location.href = "/";
			}

		}).catch(function(err){
			var res = err.response.status;

			if(res === 422){
				var errors = err.response.data.errors;
				

				if(errors.email){
					$('#inputEmail').removeClass('is-valid');
					$('#inputEmail').addClass('is-invalid');
					if( errors.email[0] === 'The email must be a valid email address.'){
						$('.invalid-feedback').eq(0).html('Eメールが不正な形式です');
					}else if(errors.email[0] === 'The email has already been taken.'){
						$('.invalid-feedback').eq(0).html('Eメールはすでに登録されています');
					}else if(errors.email[0] === 'The email field is required.'){
						$('.invalid-feedback').eq(0).html('Eメールが空です');
					}
				}else{
					$('#inputEmail').removeClass('is-invalid');
					$('#inputEmail').addClass('is-valid');
				}

				if(errors.username){
					$('#inputUsername').removeClass('is-valid');
					$('#inputUsername').addClass('is-invalid');
					if(errors.username[0] === 'The username has already been taken.'){
						$('.invalid-feedback').eq(1).html('ユーザー名はすでに登録されています');
					}else if(errors.username[0] === 'The username field is required.'){
						$('.invalid-feedback').eq(1).html('ユーザー名が空です');
					}
				}else{
					$('#inputUsername').removeClass('is-invalid');
					$('#inputUsername').addClass('is-valid');
				}

				if(errors.password){
					$('#inputPassword').removeClass('is-valid');
					$('#inputPassword').addClass('is-invalid');
					if(errors.password[0] === 'The password field is required.'){
						$('.invalid-feedback').eq(2).html('パスワードが空です');
					}else if(errors.password[0] === 'The password must be at least 9 characters.'){
						$('.invalid-feedback').eq(2).html('パスワードは最低9文字以上の英数字にしてください');
					}else if(errors.password[0] === 'The password must not be greater than 36 characters.'){
						$('.invalid-feedback').eq(2).html('パスワードは最大36文字以下の英数字にしてください');
					}
				}else{
					$('#inputPassword').removeClass('is-invalid');
					$('#inputPassword').addClass('is-valid');
				}
			}
		}).finally(function(){
			$('#signup_btn').attr('disabled', false);
			$('#signup_btn').html("ログイン");
		});
	});
})();