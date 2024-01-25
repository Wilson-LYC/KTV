<?php
//判断是否登录
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("Location: /ktv/view/login.php");
}
//判断是否有权限
if(!$_SESSION['user']['permission']['work']){
    echo "<script>alert('无权限')</script>";
    echo '<script>window.location.href="/ktv/index.php"</script>';
}
//get中无数据则跳转
if(!isset($_GET['id'])){
    header("Location: /ktv/view/work/index.php");
}
//从get中获取id
$id=$_GET['id'];
?>
<html>
<head>
    <title>设置</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/ktv/view/css/header.css">
    <link rel="stylesheet" href="/ktv/view/css/work-checkin.css">
    <script src="/ktv/view/js/jquery-3.7.0.min.js"></script>
    <script src="/ktv/view/js/header.js"></script>
    <script src="/ktv/view/js/work.js"></script>
</head>
<body>
<!--导航栏-->
<div class="navbar">
    <!--左侧-->
    <div class="nav-left">
        <!--logo+标题-->
        <div class="nav-title">
            <div class="nav-title-logo">
                <img src="/ktv/public/img/logo.png">
            </div>
            <div class="nav-title-text">
                <p>KTV包房管理系统</p>
            </div>
        </div>
        <!--导航栏按钮-->
        <div class="nav-ul">
            <ul>
                <a href="/ktv/view/work/index.php"><li id="nav-ul-select">服务前台</li></a>
                <a href="/ktv/view/setting/index.php"><li>管理后台</li></a>
            </ul>
        </div>
    </div>
    <div class="nav-right">
        <!--用户名-->
        <div class="nav-user">
            <div class="nav-user-name">
                <a href="#" onclick="logout()"><?php echo $_SESSION['user']['name']?></a>
            </div>
        </div>
    </div>
</div>
<!--内容-->
<div class="content">
    <div class="top-button">
        <a href="/ktv/view/work/index.php"><button class="bt-normal">返回</button></a>
    </div>
    <div class="title">
        入住登记
    </div>
    <?php
    include_once "../../dao/RoomDao.php";
    $roomDao = new RoomDao();
    $room = $roomDao->getRoomById($id);
    if(count($room)<=0)
        echo "<script>alert('房间不存在');location.href='/ktv/view/work/index.php'</script>";
    else
        $room = $room[0];
    ?>
    <form id="form" onsubmit=checkinSubmit()>
        <table class="filed">
            <tr>
                <td class="table-title">房间</td>
                <td class="table-text">
                    <input type="text" name="roomName" id="roomName" value="<?php echo $room['name']?>" disabled>
                    <input type="hidden" name="roomId" id="roomId" value="<?php echo $room['id']?>" disabled>
                </td>
                <td class="table-title">房型</td>
                <td class="table-text"><input type="text" name="roomTName" id="roomTName" value="<?php echo $room['type_name']?>" disabled></td>
            </tr>
            <tr>
                <td class="table-title">负责人</td>
                <td class="table-text">
                    <input type="text" name="userName" id="userName" value="<?php echo $_SESSION['user']['name']?>" disabled>
                    <input type="hidden" name="userId" id="userId" value="<?php echo $_SESSION['user']['id']?>" disabled>
                </td>
                <td class="table-title">开房时间</td>
                <td class="table-text"><input type="text" name="begTime" id="begTime" value="<?php echo date("Y-m-d H:i:s")?>" disabled></td>
            </tr>
            <tr>
                <td class="table-title">顾客姓名</td>
                <td class="table-text">
                    <input type="text" name="cusName" id="cusName" value="" required>
                </td>
                <td class="table-title">联系方式</td>
                <td class="table-text">
                    <input type="text" name="cusPhone" id="cusPhone" value="" required>
                </td>
            </tr>
        </table>
        <div class="form-button">
            <input type="submit" value="确定" class="bt-normal" style="margin-right: 20px">
            <a href="/ktv/view/work/index.php"><input type="button" value="取消" class="bt-cancel"></a>
        </div>
    </form>
</div>
</body>
</html>