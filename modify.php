<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>107校內技藝競賽 - 電子競技報名修改</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
        crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">

    <?php
        include_once('db.php');
        $keys = array_keys($_GET);
        foreach($keys as $key){
            $$key = $_GET[$key];
        }
        $sql = 'select s_lineId from signup where s_id = :id';
        $query = $db->prepare($sql);
        $query->bindValue(":id",$id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $key = md5($result['s_lineId']);
        if(!($key == $code)){
            header('location:index.html');
            exit();
        }

        

    ?>
    <script>
        $(function(){
            function getFormData($form) {
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};
                $.map(unindexed_array, function (n, i) {
                    if (Object.keys(indexed_array).indexOf(n['name']) == -1)
                        indexed_array[n['name']] = n['value'];
                    else if (indexed_array[n['name']] instanceof Array)
                        indexed_array[n['name']].push(n['value']);
                    else {
                        indexed_array[n['name']] = [indexed_array[n['name']]];
                        indexed_array[n['name']].push(n['value']);
                    }
                });
                return indexed_array;
            }
            function searchToObject() {
                var pairs = window.location.search.substring(1).split("&"),
                    obj = {},
                    pair,
                    i;
                for ( i in pairs ) {
                    if ( pairs[i] === "" ) continue;
                    pair = pairs[i].split("=");
                    obj[ decodeURIComponent( pair[0] ) ] = decodeURIComponent( pair[1] );
                }
                return obj;
            }
            var result = null;
            $.ajax({
                url:'querySignup.php',
                dataType:'json',
                method:'POST',
                async:false,
                data:{
                    'id':searchToObject().id
                },
                success:function(res){
                    result = res;
                },
                error:function(err){
                    alert('發生錯誤，請聯繫電競社社長');
                    console.log(err);
                }
            });
            $("option[value="+result.s_department+']').prop('selected',true);
            $("[name=_class]").val(result.s_class);
            $("[name=teamName]").val(result.s_teamName);
            $("[name=leaderName]").val(result.s_leaderName);
            $("[name=leaderId]").val(result.s_leaderId);
            $("[name=line_id]").val(result.s_lineId);
            $("[name=phone]").val(result.s_phone);
            $('[name=id]').val(result.s_id);
            
            var length = result.s_member==null?0:result.s_member.length;
            $('#memberCount option[value='+length+']').prop('selected',true);
            $("#memberDiv *").hide().prop('disabled', true);
            $("#memberDiv *:lt(" + length * 4 + ")").show().prop('disabled', false).prop('required',true);
            $("#memberDiv input[required]:even").each(function(index){
                $(this).val(result.s_member[index]);
            });
            $("#memberDiv input[required]:odd").each(function(index){
                $(this).val(result.s_memberId[index]);
            });

            $("#memberCount").change(function () {
                var n = $(this).val();
                $("#memberDiv *").hide().prop('disabled', true).prop('required', false);
                $("#memberDiv *:lt(" + n * 4 + ")").show().prop('disabled', false).prop('required',
                    true);
            });
            $('#signUpForm').on('submit', function () {
                var checkFormat = true;
                $("[name=leaderName],#memberDiv input[required]:even").each(function () {
                    var number = parseInt(this.value);
                    var numberLen = number.toString().length;
                    var len = this.value.length;
                    if (number == NaN || len - numberLen == 0) {
                        alert("確定座號姓名的格式");
                        checkFormat = false;
                        return false;
                    }
                });
                if (!checkFormat)
                    return false;
                var form = getFormData($(this));
                $.ajax({
                    url: 'modifyProcess.php',
                    method: 'POST',
                    data: form,
                    success: function () {
                        alert('修改成功!');
                        location.href='index.html';
                    },
                    error: function (err) {
                        alert('修改沒有成功，請重試或詢問電競社社長');
                        console.log(err);
                    }
                });
                return false;
            });
        })
    </script>
</head>
<body>
    <div class="container">
        <header>107校內技藝競賽 - 電子競技報名修改</header>
        <a class="btn btn-default" href="index.html">回首頁</a>
        <form method="POST" id="signUpForm">
            <div class="modal-body">
                科系
                <select name="department" class="form-control">
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
                年級班級
                <input type="text" class="form-control" name="_class" required> 隊名：
                <input type="text" class="form-control" name="teamName" required> 隊長(座號姓名)：
                <input type="text" class="form-control" name="leaderName" required> 隊長(遊戲暱稱)：
                <input type="text" class="form-control" name="leaderId" required> 隊員數量：
                <select class="form-control" id="memberCount">
                    <option value="0" selected>0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5(含候補)</option>
                </select>
                <div id="memberDiv">
                    <span>隊員一(座號姓名)：</span>
                    <input type="text" class="form-control" name="member[]">
                    <span>隊員一(遊戲暱稱)：</span>
                    <input type="text" class="form-control" name="memberId[]">
                    <span>隊員二(座號姓名)：</span>
                    <input type="text" class="form-control" name="member[]">
                    <span>隊員二(遊戲暱稱)：</span>
                    <input type="text" class="form-control" name="memberId[]">
                    <span>隊員三(座號姓名)：</span>
                    <input type="text" class="form-control" name="member[]">
                    <span>隊員三(遊戲暱稱)：</span>
                    <input type="text" class="form-control" name="memberId[]">
                    <span>隊員四(座號姓名)：</span>
                    <input type="text" class="form-control" name="member[]">
                    <span>隊員四(遊戲暱稱)：</span>
                    <input type="text" class="form-control" name="memberId[]">
                    <span>候補(座號姓名)：</span>
                    <input type="text" class="form-control" name="member[]">
                    <span>候補(遊戲暱稱)：</span>
                    <input type="text" class="form-control" name="memberId[]">
                </div>
                隊長LineID：
                <span style="color:red">(ID將作為修改報名表的密碼，請謹慎輸入)</span>
                <input type="text" class="form-control" name="line_id" required> 隊長聯絡電話：
                <input type="text" class="form-control" name="phone" required>
                <input type="hidden" name="id">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">確定修改</button>
            </div>
        </form>
    </div>
</body>
</html>