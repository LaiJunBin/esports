<?php
    include_once('db.php');
    $sql = "update signup set ";
    $sql.= "s_department=:department,s_class=:cls,s_teamName=:team,s_leaderName=:leaderName,s_leaderId=:leaderId,s_member=:member,s_memberId=:memberId,s_lineId=:lineId,s_phone=:phone where s_id=:id";
    $query = $db->prepare($sql);
    $query->bindValue(':department',$_POST['department']);
    $query->bindValue(':cls',$_POST['_class']);
    $query->bindValue(':team',$_POST['teamName']);
    $query->bindValue(':leaderName',$_POST['leaderName']);
    $query->bindValue(':leaderId',$_POST['leaderId']);
    $query->bindValue(':member',serialize($_POST['member']));
    $query->bindValue(':memberId',serialize($_POST['memberId']));
    $query->bindValue(':lineId',$_POST['line_id']);
    $query->bindValue(':phone',$_POST['phone']);
    $query->bindValue(':id',$_POST['id']);
    $query->execute();
?>