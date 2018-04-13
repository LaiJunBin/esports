<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>107校內技藝競賽 - 電子競技報名修改</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
        crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">

    <?php
        session_start();
        if(!isset($_SESSION['login']) || $_SESSION['login'] !='admin'){
            header('location:index.html');
            exit();
        }

        

    ?>
    <script>
        $(function(){
            function searchToObject() {
                var pairs = window.location.search.substring(1).split("&"),
                    obj = {},
                    pair,
                    i;
                for ( i in pairs ) {
                    if ( pairs[i] === "" ) continue;
                    pair = pairs[i].split("=");
                    obj[ decodeURIComponent( pair[0] ) ] = decodeURIComponent( pair[1] );
                }
                return obj;
            }
            $("#menu button").click(function(){
                $("#menu button").removeClass('active');
                $(this).addClass('active');
                var uri = $(this).attr('uri');
                $("main").load(uri);
                if (typeof(Storage) !== "undefined") {
                    localStorage.uri = uri;
                } else {
                    location.search = 'uri='+uri;
                }
                
            });
            var uri = '';
            if (typeof(Storage) !== "undefined") {
                uri = localStorage.uri || 'allSignUp.php';
            } else {
                uri = searchToObject().uri || 'allSignUp.php';
            }
            $("main").load(uri);
            $('button[uri="'+uri+'"]').addClass('active');
        });
    </script>
</head>
<body>
    <div class="container">
        <header>107校內技藝競賽 - 電子競技管理</header>
        <a class="btn btn-default" href="index.html">回首頁</a>
        <div class="btn-group" id="menu">
            <button class="btn btn-default" uri='allSignUp.php'>全部一覽</button>
            <button class="btn btn-default" uri="early.php">初賽名單</button>
            <button class="btn btn-default" uri="Advanced.php">晉級名單</button>
        </div>
        <main></main>
    </div>
</body>
</html>