<?php
require_once "setting_config.php";
include_once "../../dao/UserDao.php";
include_once "../../dao/GroupDao.php";
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
    <link rel="stylesheet" href="/ktv/view/css/setting-index.css">
    <script src="/ktv/view/js/jquery-3.7.0.min.js"></script>
    <script src="/ktv/view/js/setting.js"></script>
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
                <a href="<?php echo LIST_PATH."index.php"?>"><li id="menu-item-select">首页</li></a>
                <a href="<?php echo LIST_PATH."roomtype.php"?>"><li>房型管理</li></a>
                <a href="<?php echo LIST_PATH."room.php"?>"><li>房间管理</li></a>
                <a href="<?php echo LIST_PATH."commodity.php"?>"><li>商品管理</li></a>
                <a href="<?php echo LIST_PATH."category.php"?>"><li>商品品类管理</li></a>
                <a href="<?php echo LIST_PATH."order.php"?>"><li>订单管理</li></a>
                <a href="<?php echo LIST_PATH."user.php"?>"><li>用户管理</li></a>
            </ul>
        </div>
    </div>
    <!--内容-->
    <div class="content-container">
        <div class="content">
            <div class="welcome">
                <p>欢迎使用KTV包房管理系统</p>
            </div>
            <div class="guide">
                <a href="<?php echo LIST_PATH."roomtype.php"?>">
                    <div class="guide-item">
                        <div class="guide-item-img">
                            <img src="/ktv/public/img/房间类型.png">
                        </div>
                        房型管理
                    </div>
                </a>
                <a href="<?php echo LIST_PATH."room.php"?>">
                    <div class="guide-item">
                        <div class="guide-item-img">
                            <img src="/ktv/public/img/麦克风,K歌,KTV,话筒.png">
                        </div>
                        房间管理
                    </div>
                </a>
                <a href="<?php echo LIST_PATH."commodity.php"?>">
                    <div class="guide-item">
                        <div class="guide-item-img">
                            <img src="/ktv/public/img/商品.png">
                        </div>
                        商品管理
                    </div>
                </a>
                <a href="<?php echo LIST_PATH."category.php"?>">
                    <div class="guide-item">
                        <div class="guide-item-img">
                            <img src="/ktv/public/img/商品类别.png">
                        </div>
                        商品品类管理
                    </div>
                </a>
                <a href="<?php echo LIST_PATH."order.php"?>">
                    <div class="guide-item">
                        <div class="guide-item-img">
                            <img src="/ktv/public/img/订单.png">
                        </div>
                        订单管理
                    </div>
                </a>
                <a href="<?php echo LIST_PATH."user.php"?>">
                    <div class="guide-item">
                        <div class="guide-item-img">
                            <img src="/ktv/public/img/用户管理.png">
                        </div>
                        用户管理
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>