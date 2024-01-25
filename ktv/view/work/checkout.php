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
include_once "../../dao/OrderDao.php";
$orderDao = new OrderDao();
$order = $orderDao->getOrderByRoomIdWEndTimeNull($id);
if (count($order) <= 0)
    echo "<script>alert('房间未开房');location.href='/ktv/view/work/index.php'</script>";
else
    $order = $order[0];
?>
<html>
<head>
    <title>设置</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/ktv/view/css/header.css">
    <link rel="stylesheet" href="/ktv/view/css/work-checkout.css">
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
    <div class="c-left">
        <div class="top-button">
            <a href="/ktv/view/work/detail.php?id=<?php echo $id?>"><button class="bt-normal">返回</button></a>
        </div>
        <div class="title">
            订单详情
        </div>
        <div class="info">
            <table>
                <tr>
                    <td class="info-table-title">订单编号</td>
                    <td class="info-table-text"><?php echo $order['id']?></td>
                    <td class="info-table-title">负责人</td>
                    <td class="info-table-text"><?php echo $order['userName']?></td>
                </tr>
                <tr>
                    <td class="info-table-title">房间</td>
                    <td class="info-table-text"><?php echo $order['roomName']?></td>
                    <td class="info-table-title">房型</td>
                    <td class="info-table-text"><?php echo $order['roomTName']?></td>
                </tr>
                <tr>
                    <?php
                    $beg=$order['begTime'];
                    $end=date("Y-m-d H:i:s");
                    $keep=round((strtotime($end)-strtotime($beg))/3600,1);
                    ?>
                    <td class="info-table-title">开房时间</td>
                    <td class="info-table-text" colspan><?php echo $order['begTime']?></td>
                    <td class="info-table-title">退房时间</td>
                    <td class="info-table-text" colspan><?php echo $end?></td>
                </tr>
                <tr>
                    <td class="info-table-title">时长</td>
                    <td class="info-table-text" colspan="3"><?php echo $keep.' 小时'?></td>
                </tr>
                <tr>
                    <td class="info-table-title">顾客姓名</td>
                    <td class="info-table-text"><?php echo $order['cusName']?></td>
                    <td class="info-table-title">联系方式</td>
                    <td class="info-table-text"><?php echo $order['cusPhone']?></td>
                </tr>
                <tr>
                    <td class="info-table-title">房费</td>
                    <td class="info-table-text"><?php echo number_format($keep*$order['roomPrice'],2,".","")?></td>
                    <td class="info-table-title">消费</td>
                    <td class="info-table-text"><?php echo $order['sumCommPrice']?></td>
                </tr>
                <tr>
                    <?php
                    $t=$keep*$order['roomPrice']+$order['sumCommPrice'];
                    ?>
                    <td class="info-table-title">总计</td>
                    <td class="info-table-text" colspan="3"><?php echo number_format($t,2,".","")?></td>
                </tr>
            </table>
        </div>
        <div class="title">
            消费明细
        </div>
        <div class="buy">
            <?php
            include_once "../../dao/OrderDao.php";
            $orderDao = new OrderDao();
            $buys=$orderDao->getOrderBuyById($order['id']);
            ?>
            <table>
                <tr class="buy-title">
                    <td>ID</td>
                    <td>商品</td>
                    <td>单价</td>
                    <td>数量</td>
                    <td>总计</td>
                </tr>
                <?php
                foreach ($buys as $buy){
                    ?>
                    <tr class="buy-comm">
                        <td><?php echo $buy['commId']?></td>
                        <td><?php echo $buy['commName']?></td>
                        <td><?php echo $buy['price']?></td>
                        <td><?php echo $buy['num']?></td>
                        <td><?php echo number_format($buy['price']*$buy['num'],2,".","")?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
    <div class="c-right">
        <div class="checkout-form">
            <form onsubmit=checkoutSubmit()>
                <div class="o-item">
                    <div class="o-item-title">
                        <p style="color:#00B42A;">总计:</p>
                    </div>
                    <div class="o-item-input">
                        <input type="text" id="totalPay" name="totalPay" value="<?php echo number_format($t,2,".","")?>" disabled style="color:#00B42A;">
                    </div>
                </div>
                <div class="o-item">
                    <div class="o-item-title">
                        <p style="color:#F7BA1E;">折扣:</p>
                    </div>
                    <div class="o-item-input">
                        <input type="number" id="discount" name="discount" value="1" style="color:#F7BA1E;" min="0" max="1" required onchange=jsMo()>
                    </div>
                </div>
                <div class="o-item">
                    <div class="o-item-title">
                        <p style="color:#F53F3F;">应付:</p>
                    </div>
                    <div class="o-item-input">
                        <input type="text" id="needPay" name="needPay" value="<?php echo number_format($t,2,".","")?>" style="color:#F53F3F;"disabled>
                    </div>
                </div>
                <div class="o-item">
                    <div class="o-item-title">
                        <p style="color:#165DFF;">实付:</p>
                    </div>
                    <div class="o-item-input">
                        <input type="text" id="actualPay" name="actualPay" value="<?php echo number_format($t,2,".","")?>" style="color:#165DFF;"required>
                    </div>
                </div>
                <div class="o-item">
                    <div class="o-item-title">
                        <p style="color:#86909c;line-height: 170px">备注:</p>
                    </div>
                    <div class="o-item-input">
                        <textarea id="annotate" name="annotate"></textarea>
                    </div>
                </div>
                <div class="o-button">
                    <input type="hidden" value="<?php echo $end?>" id="endT" name="endT">
                    <input type="hidden" value="<?php echo $order['id']?>" id="orderId" name="orderId">
                    <input type="submit" class="bt-red" id="checko" value="结账">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="over-add">

</div>
</body>
</html>