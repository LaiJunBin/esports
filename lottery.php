<?php
    include_once('db.php');
    $keys = $_POST['keys'];
    $count = count($keys);
    if($count %2 !=0){
        $index = mt_rand(0,$count-1);
        modifyRun($keys[$index],-1);
        unset($keys[$index]);
    }
    shuffle($keys);
    $count = count($keys);
    $arr = [[],[]];
    for($i=0;$i<$count/2;$i++){
        array_push($arr[0],$keys[$i]);
        array_push($arr[1],$keys[$count/2+$i]);
    }
    for($i=0;$i<count($arr[0]);$i++){
        modifyRun($arr[0][$i],$arr[1][$i]);
        modifyRun($arr[1][$i],$arr[0][$i]);
    }
    function modifyRun($id,$target){
        global $db;
        $sql = 'update signup set s_run = :run where s_id = :id';
        $query = $db->prepare($sql);
        $query->bindValue(":run",$target);
        $query->bindValue(":id",$id);
        $query->execute();
    }
?>