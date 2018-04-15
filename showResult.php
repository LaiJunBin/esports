<hr>
<h1><span style="color:red"><?php echo $_POST['title'];?></span>配對結果</h1>
<?php
    include_once('db.php');
    
    $keys = $_POST['keys'];
    $keysArray = $_POST['keysArray'];
    $sql = 'select * from signup where s_run = -1 and s_id in'.$keys;
    $query = $db->query($sql);
    $seed = $query->fetch(PDO::FETCH_ASSOC);
    if($seed){
        echo "<h3>";
        echo "種子為".$seed['s_class']."班".$seed['s_teamName'].'隊伍';
        echo "</h3>";
        $seed = $seed['s_id'];
        array_splice($keysArray,array_search($seed,$keysArray),1);
    }else{
        $seed = null;
    
    }
    $sql = 'select * from signup where s_id in '.$keys;
    $query = $db->query($sql);
?>
<form action="vsProcess.php" method="post">
    <table class="rwd-table">
    <tr>
        <th>班級</th>
        <th>隊名</th>
        <th>操作</th>
        <th></th>
        <th>班級</th>
        <th>隊名</th>
        <th>操作</th>
        <!-- <th width="150px">操作</th> -->
    </tr>
        <?php
            $count = count($keysArray);
            for($i=0;$i<$count/2;$i++){
                $sql = 'select * from signup where s_id ="'.$keysArray[$i].'"';
                $query = $db->query($sql);
                $result_a = $query->fetch(PDO::FETCH_ASSOC);    
                $sql = 'select * from signup where s_id ="'.$result_a['s_run'].'"';
                $query = $db->query($sql);
                $result_b = $query->fetch(PDO::FETCH_ASSOC);  
            ?>
                <tr>
                    <td><?php echo $result_a['s_class'];?></td>
                    <td><?php echo $result_a['s_teamName'];?></td>
                    <td><input type="radio" name="win[<?php echo $i;?>]" value="<?php echo $result_a['s_id'];?>" required>勝利方</td>
                    <td>VS</td>
                    <td><?php echo $result_b['s_class'];?></td>
                    <td><?php echo $result_b['s_teamName'];?></td>
                    <td><input type="radio" name="win[<?php echo $i;?>]" value="<?php echo $result_b['s_id'];?>" required>勝利方</td>
                </tr>
        <?php } ?>
        <input type="hidden" name="seed" value="<?php echo $seed?$seed:-1;?>">  
    </table>
    <button class="btn btn-success fill" type="submit">結算</button>
</form>