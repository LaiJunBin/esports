<?php
    include_once('db.php');
    $id = $_POST['id'];
    $sql = 'select * from signup where s_id = :id';
    $query = $db->prepare($sql);
    $query->bindValue(":id",$id);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $result['s_member'] = unserialize($result['s_member']);
    $result['s_memberId'] = unserialize($result['s_memberId']);
    echo json_encode($result);
?>