<?php
    include_once('db.php');
    $sql = 'select * from signup';
    $query = $db->query($sql);
    ?>
    <table class="rwd-table">
    <tr>
        <th>科系</th>
        <th>班級</th>
        <th>隊名</th>
        <th>報名時間</th>
        <th width="150px">操作</th>
    </tr>
    <?php
    while($result = $query->fetch(PDO::FETCH_ASSOC)){ ?>
        
        <tr>
            <td data-th="科系"><?php echo $result['s_department'];?></td>
            <td data-th="班級"><?php echo $result['s_class'];?></td>
            <td data-th="隊名"><?php echo $result['s_teamName'];?></td>
            <td data-th="報名時間"><?php echo $result['s_date'];?></td>
            <td data-th="操作">
                <button class="btn btn-info modifyBtn" uri="modify" va="<?php echo $result['s_id'];?>">修改</button>
                <button class="btn btn-danger deleteBtn" uri="delete" va="<?php echo $result['s_id'];?>">刪除</button>
            </td>
        </tr>
    <?php }
?>

    </table>