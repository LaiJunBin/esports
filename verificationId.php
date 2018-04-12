<?php
    include_once('db.php');
    session_start();
    $id = $_POST['index'];
    $user = $_POST['userInput'];
    $uri = $_POST['uri'];
    $sql = 'select s_lineId from signup where s_id=:id';
    $query = $db->prepare($sql);
    $query->bindValue(":id",$id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $arr = [];
    if($result['s_lineId'] == $user || (isset($_SESSION['login']) && $_SESSION['login']=='admin')){
        $arr['status'] = 'OK';
        $arr['url'] = $uri.'.php?id='.$id.'&code='.md5($result['s_lineId']);
    }else
        $arr['status'] = 'Err';
    echo json_encode($arr);
?>