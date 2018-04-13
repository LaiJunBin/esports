<hr>
<select id="department" name="department" class="form-control">
    <option value="null">篩選科系</option>
    <option value="資料處理科">資料處理科</option>
    <option value="時尚造型科">時尚造型科</option>
    <option value="商業經營科">商業經營科</option>
    <option value="觀光事業科">觀光事業科</option>
    <option value="餐飲管理科">餐飲管理科</option>
    <option value="多媒體設計科">多媒體設計科</option>
    <option value="建教班">建教班</option>
    <option value="普通科">普通科</option>
    <option value="綜合科">綜合科</option>
</select>
<div class="btnGroup">
    
</div>
<?php
    include_once('db.php');
    $sql = 'select * from signup';
    $query = $db->query($sql);   

?>
<table class="rwd-table">
<tr>
    <th>狀態</th>
    <th>科系</th>
    <th>班級</th>
    <th>隊名</th>
    <th>報名時間</th>
    <th width="150px">操作</th>
</tr>
    <?php
        while($result = $query->fetch(PDO::FETCH_ASSOC)){ ?>
            
            <tr va="<?php echo $result['s_id'];?>">
                <td data-th="狀態"><?php echo $result['s_enable']?"參加初賽":"一般狀態";?></td>
                <td data-th="科系"><?php echo $result['s_department'];?></td>
                <td data-th="班級"><?php echo $result['s_class'];?></td>
                <td data-th="隊名"><?php echo $result['s_teamName'];?></td>
                <td data-th="報名時間"><?php echo $result['s_date'];?></td>
                <td data-th="操作">
                    <button class="btn btn-<?php echo !$result['s_enable']?"success":"info";?> operationBtn" va="<?php echo $result['s_id'];?>"><?php echo !$result['s_enable']?"參加初賽":"取消參加";?></button>
                </td>
            </tr>
    <?php }
    ?>

</table>

<script>
    $(".operationBtn").click(function(){
        var n = $(this).attr('va');
        $.ajax({
            url:'enableSwitch.php',
            method:'POST',
            data:{
                id:n
            },
            dataType:'json',
            success:function(res){
                $("tr[va=" + n + ']').find("[data-th=狀態]").text(res.status).parent().find(" button").text(res.btnText).removeClass((res.color=='info')?'btn-success':'btn-info').addClass('btn-' + res.color);
            },
            error:function(err){
                console.log(err);
            }
        });
    });
    $("#department").change(function(){
        var department = $(this).val();
        $("tr").show();
        if(department != 'null'){
            $('td[data-th="科系"]').each(function(){
                if($(this).text() != department)
                    $(this).parent().hide();
            });
        }
    });
</script>