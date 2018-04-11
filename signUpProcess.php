<?php
    include_once('db.php');
    $sql = "insert into signup";
    $sql.= "(s_department,s_class,s_teamName,s_leaderName,s_leaderId,s_member,s_memberId,s_lineId,s_phone,s_win)";
    $sql.= " values(:department,:cls,:team,:leaderName,:leaderId,:member,:memberId,:lineId,:phone,:win)";
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
    $query->bindValue(':win','0');
    $query->execute();
?>