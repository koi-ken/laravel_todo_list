(function(){

  // モーダルをJavaScriptで操作するためにオブジェクトを入れる変数
	var myModal;

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

		// タスクに何も入っていなければ終了
		if(task === ''){
			alert("タスクが入力されていません");
			return false;
		}

		// 渡すデータを取得する
		var task = $('#task_form').val();
		var csrf_token = $('meta[name="csrf-token"]').attr('content');

		// ボタンのクリックを禁止する
		$('#add_task_btn').prop('disabled', true);

		// ボタンにローディングアイコンを追加する
		$('#add_task_btn').html("");
		$('<span>').attr({
			class: 'spinner-border spinner-border-sm',
			role: 'status',
			ariaHidden: 'true',
		}).appendTo('#add_task_btn');

		axios.post('/api/v1/add_task',{
			task: task,
			"X-CSRF-TOKEN": csrf_token
		}).then(function(res){
			if(res.data.message === 'success'){

				// データを追加する
				$('#task_list').prepend(' \
					<div class="d-flex rounded fw-light bg-white py-3 px-3 mx-3 my-2 shadow-sm"> \
						<div class="d-flex align-items-center flex-grow-1"> \
							<div class="form-check"> \
								<input type="checkbox" class="form-check-input todo-checkbox" /> \
								<label class="form-check-label" data-task-id="' + res.data.id + '">' + task + '</label> \
							</div> \
						</div> \
						<div class="d-flex align-items-center ms-3 open_edit_menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEdit"> \
							<svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="bi bi-pencil-square" style="cursor: pointer;"> \
								<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path> \
								<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path> \
							</svg> \
						</div> \
						<div class="d-flex align-items-center ms-3 open_delete_modal" data-bs-toggle="modal" data-bs-target="#deleteModal"> \
							<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16" style="cursor: pointer;"> \
								<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/> \
							</svg> \
						</div> \
					</div> \
				');

				$('#task_form').val("")
			}
		}).catch(function(err){

			var status = err.response.status;

			// CSRF token mismatch
			if(status === 419){
        // 現在のページをリダイレクトさせる
				location.href = location.pathname;
			}else{
				alert("追加できませんでした。やり直してください。");
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
		create_offcanvas();
		create_modal();
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

						$('#task_list').append(' \
							<div class="d-flex rounded fw-light bg-white py-3 px-3 mx-3 my-2 shadow-sm"> \
								<div class="d-flex align-items-center flex-grow-1"> \
									<div class="form-check"> \
										<input type="checkbox" class="form-check-input todo-checkbox" /> \
										<label class="form-check-label" data-task-id="' + tasks[i].id + '">' + tasks[i].task + '</label> \
									</div> \
								</div> \
								<div class="d-flex align-items-center ms-3 open_edit_menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEdit"> \
									<svg width="22" height="22" fill="currentColor" viewBox="0 0 16 16" class="bi bi-pencil-square" style="cursor: pointer;"> \
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path> \
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path> \
									</svg> \
								</div> \
								<div class="d-flex align-items-center ms-3 open_delete_modal" data-bs-toggle="modal" data-bs-target="#deleteModal"> \
									<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16" style="cursor: pointer;"> \
										<path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/> \
									</svg> \
								</div> \
							</div> \
						');
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

				var status = err.response.status;

				// CSRF token mismatch
				if(status === 419){
	        // 現在のページをリダイレクトさせる
					location.href = location.pathname;
				}else{
					alert("読み込みできませんでした。やり直してください。");
				}

			}).finally(function(){

			});
		}
	}

	$(document).on('click', '.open_edit_menu', function(){

		var idx = $('.open_edit_menu').index(this);

		$('#edit_task_input_textarea').val('');
		$('#edit_task_task_id').val('');
		$('#idx_pos_data').val('');

		$('#edit_task_input_textarea').val($('label.form-check-label').eq(idx).text());
		$('#edit_task_task_id').val($('label.form-check-label').eq(idx).data("task-id"));
		$('#idx_pos_data').val(idx);

	});

	function create_offcanvas(){

		$('body').append(' \
			<div class="offcanvas offcanvas-start" id="offcanvasEdit" tabindex="-1" aria-labelledby="offcanvasLabel"> \
				<div class="offcanvas-header"> \
					<h5 class="offcanvas-title">タスク編集</h5> \
					<button class="btn-close text-reset" data-bs-dismiss="offcanvas"></button> \
				</div> \
				<div class="offcanvas-body"> \
					<form> \
						<div class="row mb-3"> \
							<div class="col-sm-12"> \
								<textarea class="form-control" id="edit_task_input_textarea"></textarea> \
							</div> \
						</div> \
						<input type="hidden" id="edit_task_task_id" /> \
						<input type="hidden" id="idx_pos_data" /> \
						<div class="d-flex"> \
							<button type="button" id="edit_task_btn" class="btn btn-primary ms-auto">編集</button> \
						</div> \
					</form> \
				</div> \
			</div> \
		');

	}

  function create_modal(){
		$('body').append(' \
			<div class="modal fade" tabindex="-1" id="deleteModal"> \
			  <div class="modal-dialog modal-dialog-centered"> \
			    <div class="modal-content"> \
			      <div class="modal-header"> \
			        <h5 class="modal-title">このタスクを削除しますか？</h5> \
			        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> \
			      </div> \
			      <div class="modal-body"> \
			        <div id="delete_dialog_body"></div> \
							<input type="hidden" id="delete_task_id" /> \
							<input type="hidden" id="idx_delete_pos_data" /> \
			      </div> \
			      <div class="modal-footer"> \
			        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button> \
			        <button type="button" class="btn btn-danger" id="delete_task_btn">削除</button> \
			      </div> \
			    </div> \
			  </div> \
			</div> \
		');

		myModal = new bootstrap.Modal(document.getElementById('deleteModal'), null)
	}

	$(document).on('click', '#edit_task_btn', function(){

		if($('#edit_task_input_textarea').val() === ''){
			alert("タスクが何も入っていません");
			return false;
		}

		// ボタンをクリック禁止にする
		$('#edit_task_btn').prop('disabled', true);

		// ボタンにローディングアイコンを追加する
		$('#edit_task_btn').text("");
		$('<span>').attr({
			class: 'spinner-border spinner-border-sm',
			role: 'status',
			ariaHidden: 'true',
		}).appendTo('#edit_task_btn');

		// 必要なデータを取得
		var task = $('#edit_task_input_textarea').val();
		var task_id = $('#edit_task_task_id').val();
		var csrf_token = $('meta[name="csrf-token"]').attr('content');

		axios.post('/api/v1/edit_task',{
			task: task,
			task_id: task_id,
			"X-CSRF-TOKEN": csrf_token,
		}).then(function(res){
			if(res.data.message === 'success'){

				// リスト内のデータを変更
				var idx = $('#idx_pos_data').val();
				$('.form-check-label').eq(idx).text(task);

			}else if(res.data.message === 'not found'){
				alert("編集できませんでした。やり直してください。");
			}

		}).catch(function(err){

			var status = err.response.status;

			// CSRF token mismatch
			if(status === 419){
        // 現在のページをリダイレクトさせる
				location.href = location.pathname;
			}else{
				alert("編集できませんでした。やり直してください。");
			}

		}).finally(function(){

			// ボタンのクリックを解除する
			$('#edit_task_btn').prop('disabled', false);

			// ボタンのローディングアイコンを解除する
			$('#edit_task_btn').empty();
			$('#edit_task_btn').text("編集");

		});
	});

	$(document).on('click', '.open_delete_modal', function(){
		var idx = $('.open_delete_modal').index(this);

		$('#delete_dialog_body').text('');
		$('#delete_task_id').val('');
		$('#idx_delete_pos_data').val('');

		$('#delete_dialog_body').text($('label.form-check-label').eq(idx).text());
		$('#delete_task_id').val($('label.form-check-label').eq(idx).data("task-id"));
		$('#idx_delete_pos_data').val(idx);
	});

	$(document).on('click', '#delete_task_btn', function(){
		if($('#delete_dialog_body').text() === ''){
			alert("タスクが何も入っていません");
			return false;
		}

		// ボタンをクリック禁止にする
		$('#delete_task_btn').prop('disabled', true);

		// ボタンにローディングアイコンを追加する
		$('#delete_task_btn').text("");
		$('<span>').attr({
			class: 'spinner-border spinner-border-sm',
			role: 'status',
			ariaHidden: 'true',
		}).appendTo('#delete_task_btn');

		// 必要なデータを取得
		var task_id = $('#delete_task_id').val();
		var csrf_token = $('meta[name="csrf-token"]').attr('content');


		axios.post('/api/v1/delete_task',{
			task_id: task_id,
			"X-CSRF-TOKEN": csrf_token,
		}).then(function(res){
			if(res.data.message === 'success'){

				// リスト内のデータを削除
				var idx = $('#idx_delete_pos_data').val();
				$('#task_list > div').eq(idx).remove();

				// モーダルを閉じる
				myModal.hide();

			}else if(res.data.message === 'not found'){
				alert("削除できませんでした。やり直してください。");
			}

		}).catch(function(err){

			var status = err.response.status;

			// CSRF token mismatch
			if(status === 419){
        // 現在のページをリダイレクトさせる
				location.href = location.pathname;
			}else{
				alert("削除できませんでした。やり直してください。");
			}

		}).finally(function(){

			// ボタンのクリックを解除する
			$('#delete_task_btn').prop('disabled', false);

			// ボタンのローディングアイコンを解除する
			$('#delete_task_btn').empty();
			$('#delete_task_btn').text("削除");

		});
	});
})();