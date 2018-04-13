<?php
    session_start();
    $user = $_POST['username'];
    $pwd = $_POST['password'];

    if($user == 'admin' && $pwd == '1234'){
        $_SESSION['login'] = $user;
        echo true;
    }else{
        echo false;
    }
?>