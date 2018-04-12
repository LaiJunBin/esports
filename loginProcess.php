<?php
    session_start();
    $user = $_POST['username'];
    $pwd = $_POST['password'];

    if($user == '帳號' && $pwd == '密碼'){
        $_SESSION['login'] = $user;
        echo true;
    }else{
        echo false;
    }
?>