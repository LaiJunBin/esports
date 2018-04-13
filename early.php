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
    $sql = 'select * from signup where s_enable ="'.'1'.'"';
    $query = $db->query($sql);   

?>
<table class="rwd-table">
<tr>
    <th>科系</th>
    <th>班級</th>
    <th>隊名</th>
    <th>LineID</th>
    <th>報名時間</th>
    <th width="150px">操作</th>
</tr>
    <?php
        while($result = $query->fetch(PDO::FETCH_ASSOC)){ ?>

            <tr va="<?php echo $result['s_id'];?>">
                <td data-th="科系"><?php echo $result['s_department'];?></td>
                <td data-th="班級"><?php echo $result['s_class'];?></td>
                <td data-th="隊名"><?php echo $result['s_teamName'];?></td>
                <td data-th="LineID"><?php echo $result['s_lineId'];?></td>
                <td data-th="報名時間"><?php echo $result['s_date'];?></td>
                <td data-th="操作">
                    <button class="btn btn-danger operationBtn" va="<?php echo $result['s_id'];?>">晉級</button>
                </td>
            </tr>
    <?php }
    ?>

</table>


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
    }
    filterDepartment();
</script>