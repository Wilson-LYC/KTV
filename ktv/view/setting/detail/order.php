<?php
require_once "../setting_config.php";
require_once "../../../dao/OrderDao.php";
//判断是否登录
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("Location: /ktv/view/login.php");
}
//判断是否有权限
if(!$_SESSION['user']['permission']['setting']){
    echo "<script>alert('无权限')</script>";
    echo '<script>window.location.href="/ktv/index.php"</script>';
}
//判断get中是否有id
if(!isset($_GET['id'])){
    header("Location:".LIST_PATH."order.php");
}
//获取id
$id = $_GET['id'];
$orderDao = new OrderDao();
$order = $orderDao->getOrderById($id);
//判断是否有此订单
if(count($order) == 0){
    header("Location:".LIST_PATH."order.php");
}
$order=$order[0];
$buys=$orderDao->getOrderBuyById($id);
?>
<html>
<head>
    <title>设置</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/ktv/view/css/setting.css">
    <link rel="stylesheet" href="/ktv/view/css/setting-detail.css">
    <link rel="stylesheet" href="/ktv/view/css/header.css">
    <script src="/ktv/view/js/jquery-3.7.0.min.js"></script>
    <script src="/ktv/view/js/setting-detail.js"></script>
    <script src="/ktv/view/js/header.js"></script>
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
                <a href="/ktv/view/work/index.php"><li>服务前台</li></a>
                <a href="/ktv/view/setting/index.php"><li id="nav-ul-select">管理后台</li></a>
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
<!--菜单栏-->
<div id="menu" class="menu">
    <div class="menu-item">
        <ul>
            <a href="<?php echo SETTING_PATH."index.php"?>"><li>首页</li></a>
            <a href="<?php echo LIST_PATH."roomtype.php"?>"><li>房型管理</li></a>
            <a href="<?php echo LIST_PATH."room.php"?>"><li>房间管理</li></a>
            <a href="<?php echo LIST_PATH."commodity.php"?>"><li>商品管理</li></a>
            <a href="<?php echo LIST_PATH."category.php"?>"><li>商品品类管理</li></a>
            <a href="<?php echo LIST_PATH."order.php"?>"><li id="menu-item-select">订单管理</li></a>
            <a href="<?php echo LIST_PATH."user.php"?>"><li>用户管理</li></a>
        </ul>
    </div>
</div>
<!--内容-->
<div class="content-container">
    <div class="content">
        <div class="detail">
            <div class="detail-nav">
                <a href="<?php echo LIST_PATH."order.php"?>">
                    <button>
                        返回
                    </button>
                </a>
            </div>
            <div class="detail-order">
                <div id="order-title">
                    订单详情
                </div>
                <table id="order-info">
                    <tr>
                        <td class="info-title">订单编号</td>
                        <td class="info-text"><?php echo $order['id']?></td>
                        <td class="info-title">负责人</td>
                        <td class="info-text"><?php echo $order['userName']?></td>
                    </tr>
                    <tr>
                        <td class="info-title">房间</td>
                        <td class="info-text"><?php echo $order['roomName']?></td>
                        <td class="info-title">房型</td>
                        <td class="info-text"><?php echo $order['roomTName']?></td>
                    </tr>
                    <tr>
                        <td class="info-title">开房时间</td>
                        <td class="info-text"><?php echo $order['begTime']?></td>
                        <td class="info-title">退房时间</td>
                        <td class="info-text"><?php
                            if($order['endTime'] == null){
                                echo "未退房";
                            }
                            else{
                                echo $order['endTime'];
                            }
                            ?></td>
                    </tr>
                    <tr>
                        <td class="info-title">时长</td>
                        <td class="info-text"><?php echo number_format($order['duration'],1,".","")?></td>
                        <td class="info-title">房间单价</td>
                        <td class="info-text"><?php echo $order['roomPrice']?></td>
                    </tr>
                    <tr>
                        <td class="info-title">房费</td>
                        <td colspan="3" class="info-text"><?php echo $order['sumRoomPrice']?></td>
                    </tr>
                </table>
                <div id="order-title2">
                    商品消费
                </div>
                <table id="order-buy">
                    <tr class="buy-title">
                        <td>ID</td>
                        <td>商品</td>
                        <td>单价</td>
                        <td>数量</td>
                        <td>总计</td>
                    </tr>
                    <?php
                    $sum = 0;
                    foreach ($buys as $buy){
                    ?>
                    <tr>
                        <td><?php echo $buy['id']?></td>
                        <td><?php echo $buy['commName']?></td>
                        <td><?php echo $buy['price']?></td>
                        <td><?php echo $buy['num']?></td>
                        <td><?php
                            $sum=$sum+$buy['price']*$buy['num'];
                            echo $buy['price']*$buy['num'];
                            ?></td>
                    </tr>
                    <?php
                    }?>
                    <tr>
                        <td class="info-title" style="width: 100px">合计</td>
                        <td colspan="4"><?php echo number_format($order['sumCommPrice'],2,".","")?></td>
                    </tr>
                </table>
                <div id="order-title2">
                    账单
                </div>
                <table id="order-buy">
                    <tr class="buy-title">
                        <td>房费</td>
                        <td>商品消费</td>
                        <td>应付</td>
<!--                        <td>折扣</td>-->
                        <td>实付</td>
                    </tr>
                    <tr>
                        <td><?php echo number_format($order['sumRoomPrice'],2,".","")?></td>
                        <td><?php echo number_format($order['sumCommPrice'],2,".","")?></td>
                        <td><?php echo number_format($order['sumPrice'],2,".","")?></td>
<!--                        <td>--><?php //echo number_format($order['sumCommPrice'],2,".","")?><!--</td>-->
                        <td><?php echo number_format($order['actualPay'],2,".","")?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>