// $(document).ready(function () {
// 	$('#formReplyComment').show(0);
// 	$("#replyComments").click(function (e) {
// 		e.preventDefault();
// 		$("#formReplyComment").toggle(200);
// 	});
// });





// $(document).ready(function() {
// 	jQuery('#formReplyComment').submit(function(e) {
// 		e.preventDefault();

// 		var uri = window.location.search;
// 		var id = new URLSearchParams(uri);
// 		var reply = id.get('reply')
// 		console.log(reply);

// 		var form = this;
// 		$.ajax({
// 			 url:$(form).attr('action'),
// 			headers: {'X-Requested-With': 'XMLHttpRequest'},
// 			 method:$(form).attr('method'),
// 			 data:new FormData(form),
// 			 processData:false,
// 			 dataType:'json',
// 			 contentType:false,
// 			success: function (response) {
				
// 			}
// 		});

// 	});
// });
// $(document).ready(function () {

// 	$("#replySubmit").click(function () {

// 		var replyName = $("#replyName").val();
// 		var replyEmail = $("#replyEmail").val();
// 		var replyComment = $("#replyComment").val();

// 		if (replyName == '' || replyEmail == '' || replyComment == '') {
// 			alert("Please fill all fields.");
// 			return false;
// 		}

// 		$.ajax({
// 			type: "POST",
// 			url: "",
// 			data: {
// 				replyName: replyName,
// 				replyEmail: replyEmail,
// 				replyComment: replyComment,
// 			},
// 			cache: false,
// 			success: function (data) {
// 				alert(data);
// 			},
// 			error: function (xhr, status, error) {
// 				console.error(xhr);
// 			}
// 		});

// 	});

// });













// Prevent form from submit or refresh
// var form = document.getElementById("formReplyComment");
// function handleForm(event) { event.preventDefault(); }
// form.addEventListener('replySubmit', handleForm);
// // Function
// function insert(){
//   $(document).ready(function(){

// 	$.ajax({
// 	  // Action
// 	  url: 'http://comment.local/comment/reply',
// 	  // Method
// 	  type: 'POST',
// 	  data: {
// 		// Get value
// 		name: $("input[name=replyName]").val(),
// 		email: $("input[name=replyEmail]").val(),
// 		comment: $("input[name=replyComment]").val(),
// 		action: "insert"
// 	  },
// 	  success:function(response){
// 		// Response is the output of action file
// 		if(response == 1){
// 		  alert("Data Added Successfully!");
// 		}
// 		else if(response == 2){
// 		  alert("Email Is Not Available");
// 		}
// 		else{
		  
// 		}
// 	  }
// 	});
//   });
// }













// $(document).ready(function() {

// 	$('#replySubmit').on('click', function(event){
// 		event.preventDefault();
// 		var form_data = $(this).serialize();
// 		$.ajax({
// 			url: "http://comment.local/comment/reply",
// 			method: "POST",
// 			dataType:"text",
// 			data: {
// 				email: $("input[name=replyEmail]").val(),
// 				name: $("input[name=replyName]").val(),
// 				comment: $("input[name=replyComment]").val(),
// 				action: "insert"
// 			},
// 			success:function(response)
// 			{
// 				if(response == 1){
// 					alert("data added successfuly");
// 				}
// 				{
// 					$('#formReplyComment')[0].reset();
// 				}
// 			}
// 		})
// 	});
// });