<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Получить ссылку на мобильное приложение</title>
</head>
<body>
<div class="window">
    <img class="logo" src="images/vmLogo.svg" alt="">
    <form action="handler.php" method="post">
        <p>Домен: <input id="domain" required type="text" name="domain" ></p>
        <p>Логин: <input id="login" required type="text" name="login"></p>
        <p>Пароль: <input id="password" required type="password" name="password"></p>
        <p> <input id="submit" value="Получить ссылку на приложение" type="submit"></p>
    </form>
    <p>
        <input type="text" id="link" readonly>
        <button onclick="copyToClipboard()">Скопировать</button>
    </p>
    <br>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $("#submit").click(function () {
        $.post(
            '/handler.php',
            {
                domain: $("#domain").val(),
                login: $("#login").val(),
                password: $("#password").val(),
            },
            function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.isError === false) {
                    $('#link').val(data.data.link);
                } else {
                    alert(data.errorMessage)
                }
            }
        );

        return false;
    })

    function copyToClipboard() {
        var copyText = document.getElementById("link");

        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        navigator.clipboard.writeText(copyText.value);
    }
</script>
</body>
</html>