<?php
    include_once('db.php');
    $sql = 'select * from signup';
    $query = $db->query($sql);
    ?>
    <table class="rwd-table">
    <?php
    while($result = $query->fetch(PDO::FETCH_ASSOC)){ ?>
        <tr>
            <th>科系</th>
            <th>班級</th>
            <th>隊名</th>
            <th width="150px">操作</th>
        </tr>
        <tr>
            <td data-th="科系"><?php echo $result['s_department'];?></td>
            <td data-th="班級"><?php echo $result['s_class'];?></td>
            <td data-th="隊名"><?php echo $result['s_teamName'];?></td>
            <td data-th="操作">
                <button class="btn btn-info">修改</button>
                <button class="btn btn-danger">刪除</button>
            </td>
        </tr>
    <?php }
?>

    </table>