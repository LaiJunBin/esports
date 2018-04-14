<hr>
<h1><span style="color:red"><?php echo $_POST['title'];?></span>配對結果</h1>
<?php
    include_once('db.php');
    $keys = $_POST['keys'];
    $sql = 'select * from signup where s_id in '.$keys;
    $query = $db->query($sql);
?>
<table class="rwd-table">
<tr>
    <th>班級</th>
    <th>隊名</th>

    <!-- <th width="150px">操作</th> -->
</tr>
    <?php
        
        while($result = $query->fetch(PDO::FETCH_ASSOC)){ 
            ?>

            <tr va="<?php echo $result['s_id'];?>" data-run="<?php echo $result['s_run'];?>">
                <td data-th="班級"><?php echo $result['s_class'];?></td>
                <td data-th="隊名"><?php echo $result['s_teamName'];?></td>

                <!-- <td data-th="操作">
                    <button class="btn btn-warning operationBtn" va="<?php echo $result['s_id'];?>">晉級</button>
                </td> -->
            </tr>
    <?php }
    ?>

</table>