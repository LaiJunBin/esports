<?php
    include_once('db.php'); 
    $sql = 'select * from signup where s_department = "'.$_POST['department'].'" and s_enable ="'.'1'.'" and s_win = "'.($_POST['win']+1).'"';
    $query = $db->query($sql);  
    $vs_end = $query->fetch(PDO::FETCH_ASSOC);
    echo ($vs_end)?true:false;
?>