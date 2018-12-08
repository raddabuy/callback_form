<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Обратная связь</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
  <script>
	    $(document).ready (function() {
		    $("#done").click (function () {
				$('#messageShow').hide ();
				var name = $("#name").val ();
				var email = $("#email").val ();
				var subject = $("#subject").val ();
				var message = $("#message").val ();
				var fail = "";
				if (name.length < 3) fail = "Имя не меньше 3 символов";
				else if (email.split ('@').length - 1 == 0 || email.split ('.').length - 1 == 0)
					     fail = "Вы ввели некоректный email";
				else if (subject.length < 5)
					     fail = "Тема сообщения не менее 5 символов";
				else if (message.length < 20)
                         fail = "Сообщение не менее 20 символов";
                if (fail != "") {
                    $('#messageShow').html (fail + "<div class='clear'><br></div>");
                    $('#messageShow').show ();
                    return false;
				}
				$.ajax ({
					url: '/ajax/feedback.php',
					type: 'POST',
					cache: false,
					data: {'name': name, 'email': email, 'subject': subject, 'message': message},
					dataType: 'html',
					success: function (data) {
						$('#messageShow').html (data + "<div class='clear'><br></div>");
                        $('#messageShow').show ();
					}
              });
			});
		});
	</script>	
</head>
<body>
  <input type="text" placeholder="Имя" id="name" name="name"><br />
        <input type="text" placeholder="Email" id="email" name="email"><br />
        <input type="text" placeholder="Тема сообщения" id="subject" name="subject"><br />
      <textarea name="message" id="message" placeholder="Введите сюда ваше сообщение"></textarea><br />
      <div id="messageShow"></div>
      <input type="button" name="done" id="done" value="Отправить">
</body>
</html>
