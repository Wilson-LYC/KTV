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
$orderId=$_GET['orderId'];
$commId=$_GET['commId'];
$roomId=$_GET['roomId'];
if($orderId==null || $roomId==null || $commId==null)
    header("Location: /ktv/view/work/index.php");
?>
<html>
<head>
    <title>设置</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/ktv/view/css/header.css">
    <link rel="stylesheet" href="/ktv/view/css/buy.css">
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
    <div class="buy">
        <form onsubmit=CommDetailSubmit()>
            <!--输入框-->
            <div class="buy-item">
                <div class="buy-item-title">
                    <p>订单编号</p>
                </div>
                <div class="buy-item-input">
                    <input type="text" id="orderId" name="orderId" placeholder="订单编号" value="<?php echo $orderId?>" disabled>
                </div>
            </div>
            <div class="buy-item">
                <div class="buy-item-title">
                    <p>房间</p>
                </div>
                <div class="buy-item-input">
                    <?php
                    include_once "../../dao/RoomDao.php";
                    $roomDao = new RoomDao();
                    $room=$roomDao->getRoomById($roomId)[0];
                    ?>
                    <input type="text" id="roomName" name="roomName" placeholder="房间" value="<?php echo $room['name']?>" disabled>
                    <input type="hidden" id="roomId" name="roomId" placeholder="房间编号" value="<?php echo $room['id']?>" disabled>
                </div>
            </div>
            <div class="buy-item">
                <div class="buy-item-title">
                    <p>商品</p>
                </div>
                <div class="buy-item-input">
                    <?php
                    include_once "../../dao/CommodityDao.php";
                    $commodityDao = new CommodityDao();
                    $commodity=$commodityDao->getCommodityById($commId)[0];
                    ?>
                    <input type="text" id="commName" name="commName" placeholder="商品名称" value="<?php echo $commodity['name']?>" disabled>
                    <input type="hidden" id="commId" name="commId" placeholder="商品编号" value="<?php echo $commodity['id']?>" disabled>
                </div>
            </div>
            <div class="buy-item">
                <div class="buy-item-title">
                    <p>库存</p>
                </div>
                <div class="buy-item-input">
                    <input type="number" id="inventory" name="inventory" placeholder="库存" value="<?php echo $commodity['inventory']?>" disabled required>
                </div>
            </div>
            <div class="buy-item">
                <div class="buy-item-title">
                    <p>数量</p>
                </div>
                <div class="buy-item-input">
                    <?php
                    include_once "../../dao/OrderDao.php";
                    $orderDao = new OrderDao();
                    $buy=$orderDao->getOrderBuyByIdDetail($orderId,$commId)[0];
                    ?>
                    <input type="number" id="num" name="num" placeholder="数量" value="<?php echo $buy['num']?>" min="0" max="<?php echo $commodity['inventory']?>" required>
                    <input type="hidden" id="oldNum" name="oldNum" value="<?php echo $buy['num']?>" required>

                </div>
            </div>
            <!--按钮栏-->
            <div class="buy-button">
                <input type="submit" class="bt-normal" value="确定">
                <a href="/ktv/view/work/detail.php?id=<?php echo $roomId?>"><input type="button" class="bt-cancel" value="取消"></a>
            </div>
        </form>
    </div>
</div>
</body>
</html>