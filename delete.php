<?php
    include_once('db.php');
    $keys = array_keys($_GET);
    foreach($keys as $key){
        $$key = $_GET[$key];
    }
    $sql = 'select s_lineId from signup where s_id = :id';
    $query = $db->prepare($sql);
    $query->bindValue(":id",$id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $key = md5($result['s_lineId']);
    if(!($key == $code)){
        header('location:index.html');
        exit();
    }

    $sql = 'delete from signup where s_id =:id';
    $query = $db->prepare($sql);
    $query->bindValue(":id",$id);
    $query->execute();
    header('location:index.html');

?>