<?php
    include_once('db.php');
    $sql = 'insert * into esports(s_department,s_class,s_teamName,s_leaderName,s_leaderId,s_member,s_lineId,s_phone,s_win) values(:department,:cls,:team,:leaderName,:leaderId,:member,:lineId,:phone)';
    
?>