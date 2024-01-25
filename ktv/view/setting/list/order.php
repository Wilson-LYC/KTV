<?php
require_once "../setting_config.php";
//判断是否登录
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("Location: /ktv/view/login.php");
}
//判断是否有权限
if(!$_SESSION['user']['permission']['setting']){
    echo "<script>alert('无权限')</script>";
    echo '<script>window.location.href="/ktv/index.php"</script>';
}
?>
<html>
<head>
    <title>设置</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/ktv/view/css/setting.css">
    <link rel="stylesheet" href="/ktv/view/css/header.css">
    <link rel="stylesheet" href="/ktv/view/css/setting-list.css">
    <script src="/ktv/view/js/jquery-3.7.0.min.js"></script>
    <script src="/ktv/view/js/setting-list.js"></script>
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
            <!--搜索-->
            <div class="search">
                <form action="order.php" method="get">
                    <!--搜索框-->
                    <div class="search-filed">
                        <!--搜索项-->
                        <div class="filed">
                            <div class="filed-title">
                                <p>ID</p>
                            </div>
                            <div class="filed-input">
                                <input type="text" id="id" name="id" placeholder="ID" value="<?php echo isset($_GET['id'])?$_GET['id']:"";?>">
                            </div>
                        </div>
                        <div class="filed">
                            <div class="filed-title">
                                <p>房间</p>
                            </div>
                            <div class="filed-input">
                                <select name="roomId" id="roomId">
                                    <option value="0">全部</option>
                                    <?php
                                        include_once "../../../dao/RoomDao.php";
                                        $roomDao = new RoomDao();
                                        $rooms=$roomDao->getAllRoom();
                                        foreach ($rooms as $room){
                                    ?>
                                    <option value="<?php echo $room['id']?>" <?php echo $_GET['roomId']==$room['id']?"selected":""?>><?php echo $room['name']?></option>
                                    <?php
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        <div class="filed">
                            <div class="filed-title">
                                <p>房间状态</p>
                            </div>
                            <div class="filed-input">
                                <select name="roomState" id="roomState">
                                    <option value="0">全部</option>
                                    <option value="1" <?php echo $_GET['roomState']==1?"selected":""?>>未退房</option>
                                    <option value="2" <?php echo $_GET['roomState']==2?"selected":""?>>已退房</option>
                                </select>
                            </div>
                        </div>
                        <div class="filed">
                            <div class="filed-title">
                                <p>订单状态</p>
                            </div>
                            <div class="filed-input">
                                <select name="orderState" id="orderState">
                                    <option value="0">全部</option>
                                    <option value="1" <?php echo $_GET['orderState']==1?"selected":""?>>未支付</option>
                                    <option value="2" <?php echo $_GET['orderState']==2?"selected":""?>>已支付</option>
                                </select>
                            </div>
                        </div>
                        <div class="filed">
                            <div class="filed-title">
                                <p>负责人</p>
                            </div>
                            <div class="filed-input">
                                <select name="userId" id="userId">
                                    <option value="0">全部</option>
                                    <?php
                                    include_once "../../../dao/UserDao.php";
                                    $userDao = new UserDao();
                                    $users=$userDao->getAllUser();
                                    foreach ($users as $user){
                                        ?>
                                        <option value="<?php echo $user['id']?>" <?php echo $_GET['userId']==$user['id']?"selected":""?>><?php echo $user['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--搜索按钮-->
                    <div class="search-button">
                        <input type="submit" id="search-submit" value="查询">
                        <input type="button" id="search-reset" value="重置" onclick=resetListOrderSearch()>
                    </div>
                </form>
            </div>
            <!--表格-->
            <div class="result">
<!--                <div class="result-bt">-->
<!--                    <a href="--><?php //echo ADD_PATH."commodity.php?flag=1"?><!--">-->
<!--                        <button class="bt-normal">新增</button>-->
<!--                    </a>-->
<!--                </div>-->
                <table>
                    <?php
                        include_once "../../../dao/OrderDao.php";
                        $orderDao = new OrderDao();
                        $items = $orderDao->getOrderByKey($_GET['id'],$_GET['userId'],$_GET['roomId'],$_GET['roomState'],$_GET['orderState']);
                    ?>
                    <tr id="table-title">
                        <td>ID</td>
                        <td>房间</td>
                        <td>开房时间</td>
                        <td>退房时间</td>
                        <td>消费</td>
                        <td>支付状态</td>
                        <td>负责人</td>
                        <td>操作</td>
                    </tr>
                    <?php
                    foreach ($items as $item){
                    ?>
                    <tr id="table-item">
                        <td><?php echo $item['id']?></td>
                        <td><?php echo $item['roomName']?></td>
                        <td><?php echo $item['begTime']?></td>
                        <td><?php echo $item['endTime']==null?"未退房":$item['endTime']?></td>
                        <td><?php echo number_format($item['sumPrice'], 2, '.', '');?></td>
                        <td><?php
                            if(($item['actualPay']==0||$item['actualPay']==null)&&$item['sumPrice']!=0)
                                echo "未支付";
                            else
                                echo $item['actualPay'];
                            ?></td>
                        <td><?php echo $item['userName']?></td>
                        <td>
                            <button class="bt-normal" onclick=openOrderDetail(<?php echo $item['id']?>)>详情</button>
                            <button class="bt-delete" onclick=deleteOrder(<?php echo $item['id']?>,<?php echo $item['endTime']==null?0:1?>)>删除</button>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </table>
                <div id="table-error">
                    <?php
                    if(count($items)==0)
                        echo "没有找到符合条件的记录";
                    else
                        echo "共查询到".count($items)."条记录";
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>