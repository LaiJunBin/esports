<?php
    session_start();
    if(isset($_SESSION['login']) && $_SESSION['login'] == 'admin'){
        echo true;
    }else{
        echo false;
    }
?>