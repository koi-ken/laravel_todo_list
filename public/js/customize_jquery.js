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

	$('#add_task_btn').on('click', function(){
		var task = $('#task_form').val();
		var csrf_token = $('input[name="_token"]').val();

		if(task === ''){
			alert("タスクが入力されていません");
			return false;
		}

		$('#add_task_btn').prop('disabled', true);

		var sp = document.createElement('span');
		sp.classList.add('spinner-border', 'spinner-border-sm');
		sp.role = 'status';
		sp.ariaHidden = 'true';
		document.getElementById('add_task_btn').replaceChild(sp, document.getElementById('add_task_btn').getElementsByTagName("svg")[0]);

		axios.post('/api/v1/add_task',{
			task: task,
			_token: csrf_token,
		}).then(function(res){
			if(res.data.message === 'success'){

				// データを追加
				var parent_ele = document.createElement('div');
				parent_ele.classList.add('rounded','fw-light','bg-white','py-3','px-3','mx-3','my-2','shadow-sm');
				var child_ele = document.createElement('div');
				child_ele.className = 'form-check';
				var input = document.createElement('input');
				input.classList.add('form-check-input','todo-checkbox');
				input.type = 'checkbox';
				var label = document.createElement('label');
				label.className = 'form-check-label';
				label.dataset.taskId = res.data.id;
				label.appendChild(document.createTextNode(task));
				child_ele.appendChild(input);
				child_ele.appendChild(label);
				parent_ele.appendChild(child_ele);
				document.getElementById('task_list').prepend(parent_ele);

				$('#task_form').val("")
			}
		}).catch(function(err){

			var res = err.response.status;

			if(res === 422){

			}

		}).finally(function(){
			$('#add_task_btn').prop('disabled', false);
			var svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
			svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
			svg.setAttribute('width', '16');
			svg.setAttribute('height', '16');
			svg.setAttribute('fill', 'currentColor');
			svg.classList.add('bi','bi-pencil');
			svg.setAttribute('viewBox', '0 0 16 16');
			var path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
			path.setAttribute('d', 'M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z');
			svg.appendChild(path);
			document.getElementById('add_task_btn').replaceChild(svg, document.getElementById('add_task_btn').getElementsByTagName("span")[0]);
		});
	});

	$(document).on('change', 'input.todo-checkbox', function(e){
		var idx = $('input.todo-checkbox').index(this);
		var task_id = $('input.todo-checkbox').eq(idx).next().data('task-id');
		var finished = $('input.todo-checkbox').eq(idx).prop('checked');

		if($('input.todo-checkbox').eq(idx).prop('checked')){
			$('input.todo-checkbox').eq(idx).next().addClass('text-decoration-line-through');
			$('#task_list > div').eq(idx).remove();
		}else{
			$('input.todo-checkbox').eq(idx).next().removeClass('text-decoration-line-through');
		}

		axios.post('/api/v1/toggle_task_achive',{
			task_id: task_id,
			finished: finished,
		}).then(function(res){

			if(res.data.message === 'success'){

			}

		}).catch(function(err){
			var res = err.response.status;

			// 失敗した場合、もとに戻す
			if($('input.todo-checkbox').eq(idx).prop('checked')){
				$('input.todo-checkbox').eq(idx).prop('checked', false);
				$('input.todo-checkbox').eq(idx).next().removeClass('text-decoration-line-through');
			}else{
				$('input.todo-checkbox').eq(idx).prop('checked', true);
				$('input.todo-checkbox').eq(idx).next().addClass('text-decoration-line-through');
			}

		}).finally(function(){

		});

	});

	$(window).on('load', function(){
		var page = 1;
		loading_data(page);
	});

	$('#loading_btn').on('click', function(){
		var page = $('#loading_btn').data('page');
		loading_data(page);
	});

	function loading_data(page){
		if($('#task_list').length){

			// ここでローディングアイコンを表示させる
			$('#loading_btn').css('display','none');
			$('#loading_icon').css('display','block');

			axios.get('/api/v1/fetch_tasks?page=' + page,{

			}).then(function(res){
				if(res.data.tasks){
					console.log(res.data.tasks);
					var tasks = res.data.tasks;
					var checked = "";
					var through = "";
					for(var i = 0; i < tasks.length; i++){

						if(tasks[i].finished_task){
							checked = "checked";
							through = " text-decoration-line-through";
						}else{
							checked = "";
							through = "";
						}

						var parent_ele = document.createElement('div');
						parent_ele.classList.add('rounded', 'fw-light', 'bg-white', 'py-3', 'px-3', 'mx-3', 'my-2', 'shadow-sm');
						var child_ele = document.createElement('div');
						child_ele.className = 'form-check';
						var input = document.createElement('input');
						input.classList.add('form-check-input', 'todo-checkbox');
						input.type = 'checkbox';
						if(checked !== ''){
							input.checked = true;
						}
						var label = document.createElement('label');
						if(through !== ''){
							label.classList.add('form-check-label',through);
						}else{
							label.className = 'form-check-label';
						}
						label.dataset.taskId = tasks[i].id;
						label.appendChild(document.createTextNode(tasks[i].task));
						child_ele.prepend(label);
						child_ele.prepend(input);
						parent_ele.prepend(child_ele);
						document.getElementById('task_list').append(parent_ele);
					}

					if(tasks.length !== 0){
						$('#loading_btn').data('page', page + 1);

						$('#loading_icon').css('display','none');
						$('#loading_btn').css('display', 'block');
					}else{

						$('#loading_icon').css('display','none');

						var div = document.createElement('div');
						div.className = 'mx-auto';
						div.style.width = '200px';
						div.style.textAlign = 'center';
						var strong = document.createElement('strong');
						strong.appendChild(document.createTextNode('データはありません'));
						div.appendChild(strong);
						document.getElementById('loading_btn_block').replaceChild(div, document.getElementById('loading_btn_block').getElementsByTagName("div")[0]);
					}
				}
			}).catch(function(err){
				var res = err.response.status;

				if(res === 422){

				}
			}).finally(function(){

			});
		}
	}

})();