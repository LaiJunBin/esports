<?php
    session_start();
    if(isset($_SESSION['login']) && $_SESSION['login'] == '帳號'){
        echo true;
    }else{
        echo false;
    }
?>