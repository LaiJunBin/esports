<hr>
<h1><span style="color:red"><?php echo $_GET['title'];?></span>配對結果</h1>
<?php
    include_once('db.php');
    
    $keys = $_GET['keys'];
    $keysArray = $_GET['keysArray'];
    $sql = 'select * from signup where s_run = -1 and s_id in'.$keys;
    $query = $db->query($sql);
    $seed = $query->fetch(PDO::FETCH_ASSOC);
    if(!is_array($keysArray))
        $keysArray = explode(',',$keysArray);
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
    $already = [$seed];
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
            while($result_a = $query->fetch(PDO::FETCH_ASSOC)){
                if(in_array($result_a['s_run'],$already) || in_array($result_a['s_id'],$already)){
                    continue;
                }
                array_push($already,$result_a['s_run']);
                array_push($already,$result_a['s_id']);
                $sql = 'select * from signup where s_id ="'.$result_a['s_run'].'"';
                $query_b = $db->query($sql);
                $result_b = $query_b->fetch(PDO::FETCH_ASSOC);  
            ?>
                <tr>
                    <td><?php echo $result_a['s_class'];?></td>
                    <td><?php echo $result_a['s_teamName'];?></td>
                    <td><input type="radio" name="win[<?php echo $result_a['s_id'];?>]" value="<?php echo $result_a['s_id'];?>" required>勝利方</td>
                    <td>VS</td>
                    <td><?php echo $result_b['s_class'];?></td>
                    <td><?php echo $result_b['s_teamName'];?></td>
                    <td><input type="radio" name="win[<?php echo $result_a['s_id'];?>]" value="<?php echo $result_b['s_id'];?>" required>勝利方</td>
                </tr>
        <?php } ?>
        <input type="hidden" name="seed" value="<?php echo $seed?$seed:-1;?>">
        <input type="hidden" name="uri" value="<?php echo $_GET['uri'];?>">
    </table>
    <button class="btn btn-success fill" type="submit">結算</button>
</form>