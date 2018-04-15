<?php
    include_once('db.php');
    $id = $_POST['id'];
    $sql = 'select s_enable from signup where s_id = :id';
    $query = $db->prepare($sql); 
    $query->bindValue(':id',$id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $enable = !$result['s_enable'];
    $sql = 'update signup set s_enable = :enable where s_id = :id';
    $query = $db->prepare($sql); 
    $query->bindValue(':enable',$enable);
    $query->bindValue(':id',$id);
    $query->execute();
    $value = ['status'=>!$result['s_enable']?"參加比賽":"一般狀態",'btnText'=>$result['s_enable']?"參加比賽":"一般狀態",'color'=>$result['s_enable']?"success":"info"];
    echo json_encode($value);
?>