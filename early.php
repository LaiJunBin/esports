<hr>
<select id="department" name="department" class="form-control">
    <option value="資料處理科" selected>資料處理科</option>
    <option value="時尚造型科">時尚造型科</option>
    <option value="商業經營科">商業經營科</option>
    <option value="觀光事業科">觀光事業科</option>
    <option value="餐飲管理科">餐飲管理科</option>
    <option value="多媒體設計科">多媒體設計科</option>
    <option value="建教班">建教班</option>
    <option value="普通科">普通科</option>
    <option value="綜合科">綜合科</option>
</select>
<?php
    include_once('db.php');
    $sql = 'select * from signup where s_enable ="'.'1'.'" and s_win = "'.($_GET['win']+1).'"';
    $query = $db->query($sql);  
    $vs_end = $query->fetch(PDO::FETCH_ASSOC);
    $sql = 'select * from signup where s_enable ="'.'1'.'" and s_win >= "'.$_GET['win'].'"';
    $query = $db->query($sql);  
?>
<table class="rwd-table">
<tr>
    <?php if($vs_end){ ?>
        <th>狀態</th>
    <?php } ?>
    <th>科系</th>
    <th>班級</th>
    <th>隊名</th>
    <th>LineID</th>
    <th>報名時間</th>
    <!-- <th width="150px">操作</th> -->
</tr>
    <?php
        
        while($result = $query->fetch(PDO::FETCH_ASSOC)){ 
            ?>

            <tr va="<?php echo $result['s_id'];?>" data-run="<?php echo $result['s_run'];?>">
                <?php if($vs_end){ ?>
                    <td data-th="狀態"><?php echo ($result['s_win']>=$_GET['win']+1)?"勝":"敗";?></td>
                <?php } ?>
                <td data-th="科系"><?php echo $result['s_department'];?></td>
                <td data-th="班級"><?php echo $result['s_class'];?></td>
                <td data-th="隊名"><?php echo $result['s_teamName'];?></td>
                <td data-th="LineID"><?php echo $result['s_lineId'];?></td>
                <td data-th="報名時間"><?php echo $result['s_date'];?></td>
                <!-- <td data-th="操作">
                    <button class="btn btn-warning operationBtn" va="<?php echo $result['s_id'];?>">晉級</button>
                </td> -->
            </tr>
    <?php }
    ?>

</table>
<?php 
    if(!$vs_end){ ?>
        <div id="operationBtnGroup">
            <button class="btn btn-danger fill" style="display:none;" id="randomBtn">亂數配對(配對後不可更改)</button>
            <button class="btn btn-success fill" style="display:none;" id="viewResultBtn">查看配對結果</button>
        </div>
    <?php } ?>
<script>
    $("#department").change(filterDepartment);
    function filterDepartment(){
        var department = $("#department").val();
        $("tr").show();
        if(department != 'null'){
            $('td[data-th="科系"]').each(function(){
                if($(this).text() != department)
                    $(this).parent().hide();
            });
        }
        $("#operationBtnGroup button").hide();
        // if($("tr[va]:visible").length==6){
            var isRun = true;
            $("tr[va]:visible").each(function(){
                if($(this).data('run')>0){
                    isRun = false;
                    return false;
                }
            });
            if($("tr[va]:visible").length>0){
                if(isRun)
                    $("#randomBtn").show();
                else
                    $("#viewResultBtn").show();
            }

        // }
    }
    $("#randomBtn").click(function(){
        if(confirm('當前名單中有'+$("tr[va]:visible").length +'隊，確定配對嗎?')){
            var n = [];
            $("tr[va]:visible").each(function(){
                n.push($(this).attr("va"));
            });
            $.ajax({
                url:'lottery.php',
                method:'POST',
                data:{
                    keys:n
                },
                success:function(result){
                    $("#operationBtnGroup button").hide();
                    $("#viewResultBtn").show();
                    alert('配對完成');
                },
                error:function(err){
                    console.log(err);
                }
            });
        }
    });
    $("#viewResultBtn").click(function(){
        var title = $("#department").val();
        var keys = [];
        
        $("tr[va]:visible").each(function(){
            keys.push($(this).attr("va"));
        });
        keysStr = '('+keys.join(',')+')';
        // $("<form>").attr({
        //     action:'showResult.php',
        //     method:'POST'
        // }).append($("<input>").attr({
        //     type:'hidden',
        //     name:'title',
        //     value:title
        // })).append($("<input>").attr({
        //     type:'hidden',
        //     name:'keys',
        //     value:keys
        // })).appendTo('body').submit();
        $.ajax({
            url:'showResult.php',
            method:'POST',
            data:{
                title:title,
                keys:keysStr,
                keysArray:keys
            },
            success:function(result){
                $("main").html(result);
            },
            error:function(err){
                console.log(err);
            }
        })
    });
    filterDepartment();
    
</script>