<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- <script src="js/script.js"></script> -->
	<title>Document</title>
	<style>
		.error {
			color: red;
		}
	</style>

</head>

<body>
	<div class="container">
		<?php if (session()->has('success')) : ?>
			<div class="alert alert-success"><?= session('success') ?></div>
		<?php endif; ?>

		<form action="/create" method="post" id="formComment">
			<div class="form-group row my-3">
				<label for="email" class="col-form-label col-xl-2 fw-bold text-right" id="align"> Email*</label>
				<div class="col-xl-4">
					<input type="text" name="email" id="email" class="form-control">

					<div class="error">
						<?php echo $errors['email'] ?? '' ?>
					</div>
				</div>
				<label for="name" class="col-form-label col-xl-1 fw-bold" id="align"> Name*</label>
				<div class="col-xl-4">
					<input type="text" name="name" id="name" class="form-control">
					<div class="error">
						<?php echo $errors['name'] ?? '' ?>
					</div>
				</div>
			</div>
			<div class="row">
				<label for="comment" class="col-form-label col-xl-2 fw-bold" id="align"> Comment*</label>
				<div class="col-xl-9">
					<textarea type="text" name="comment" id="comment" class="form-control"> </textarea>
					<div class="error">
						<?php echo $errors['comment'] ?? '' ?>
					</div>
					<button class="button my-3" name="submit" id="submit">Submit</button>
				</div>
			</div>
		</form>
	</div>

	<div class="container">
		<?php foreach ($comments as $comment) : ?>
			<?php if ($comment['reply_of'] == 0) : ?>
				<div class='row mb-4'>
					<div class='col-12' style='background-color:gray'>
					<?php else : ?>
						<div class='row mb-4 justify-content-end'>
							<div class='col-10' style='background-color:gray'>
							<?php endif; ?>

							<span class='fw-bold fst-italic'> <?= $comment['name'] ?></span>
							<span class='fst-italic'> <?= date("d M Y", strtotime($comment['created_at'])) ?></span>
							<?php if ($comment['reply_of'] == 0) { ?>
								<div class="wrapper">
									<a class="float-end fw-bold text-dark text-decoration-none" id="reply" href="?reply=<?= $comment['comment_id'] ?>"><i class='bi bi-reply-fill'></i></i>Reply</a>
								</div>
							<?php } ?>

							<div class='md-3 my-1 text-break'> <?= $comment['comment'] ?></div>
							</div>
						</div>
					<?php endforeach; ?>
					</div>
				</div>
	</div>
	<div class="container">
		<div class="row mb-4 justify-content-end">
			<div class="col-8">
				<form action="" method="post" id="formReplyComment" style="display: hidden">
					<div class="form-group row my-3">
						<label for="email" class="col-form-label col-xl-2 fw-bold text-right" id="align"> Email*</label>
						<div class="col-xl-4">
							<input type="text" name="replyEmail" id="replyEmail" class="form-control">

							<div class="error">
								<?php echo $errors['email'] ?? '' ?>
							</div>
						</div>
						<label for="name" class="col-form-label col-xl-1 fw-bold" id="align"> Name*</label>
						<div class="col-xl-4">
							<input type="text" name="replyName" id="replyName" class="form-control">
							<div class="error">
								<?php echo $errors['name'] ?? '' ?>
							</div>
						</div>
					</div>
					<div class="row">
						<label for="comment" class="col-form-label col-xl-2 fw-bold" id="align"> Comment*</label>
						<div class="col-xl-9">
							<textarea type="text" name="replyComment" id="replyComment" class="form-control"> </textarea>
							<div class="error">
								<input type="hidden" id="replyId" name="replyId">
								<?php echo $errors['comment'] ?? '' ?>
							</div>
							<button class="button my-3" name="replySubmit" id="replySubmit">Submit</button>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		$.each($('.wrapper'), function() {
			$this = $(this);
			text = $this.find('#replyComment').text();
			$this.find('input[name="reply"]').val(text);
		});




		$(document).ready(function() {
			jQuery('#formReplyComment').submit(function(e) {
				e.preventDefault();
				var uri = window.location.search;
				var id = new URLSearchParams(uri);
				var reply = id.get('reply')
				console.log(reply);



				$.ajax({
					url: '/comment/reply',
					headers: {
						'X-Requested-With': 'XMLHttpRequest'
					},
					method: 'POST',
					data: JSON.stringify({
						"replyEmail": $('#replyEmail').val(),
						"replyName": $('#replyName').val(),
						"replyComment": $('#replyComment').val(),
						"replyId": reply
					}),
					contentType: false,
					success: function() {
						location.reload();
					}
				});

			});
		});



		// jQuery('#formReplyComment').submit(function(e) {
		// 	e.preventDefault();
		// 	var form = this;
		// 	$.ajax({
		// 		url:$(form).attr('action'),
		// 		method:$(form).attr('method'),
		// 		data:new FormData(form),
		// 		processData:false,
		// 		dataType:'json',
		// 		contentType:false,
		// 		beforeSend:function() {

		// 		},
		// 		success:function(data){
		// 			if($.isEmptyObject(data.error)){
		// 				if(data.code == 1) {
		// 					$(form)[0].reset();
		// 					// alert(data.msg);
		// 				} else {
		// 					// alert(data.msg);
		// 				}
		// 			}
		// 		}
		// 	})
		// });
	</script>



</body>

</html>