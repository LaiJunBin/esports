<?php
    include_once('db.php');
    $win = $_POST['win'];
    $seed = $_POST['seed'];
    if($seed != -1)
        array_push($win,$seed);
    foreach($win as $id){
        $sql = 'select s_win from signup where s_id = "'.$id.'"';
        $query = $db->query($sql);
        $winNumber = $query->fetch(PDO::FETCH_ASSOC)['s_win'];
        $winNumber++;
        $sql = 'update signup set s_win = "'.$winNumber.'",s_run = "'.'0'.'" where s_id ="'.$id.'"';
        $db->query($sql);
    }
    header('location:manager.php');
?>