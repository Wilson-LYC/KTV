<?php
require_once "view/setting/setting_config.php";
//判断是否登录
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("Location: /ktv/view/login.php");
}
?>
<html>
<head>
    <title>KTV包房管理系统</title>
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
    <div class="content-container" style="left: 0;width: 100%">
        <div class="content">
            <div class="welcome">
                <p>欢迎使用KTV包房管理系统</p>
            </div>
            <div class="guide">
                <a href="/ktv/view/work/index.php">
                    <div class="guide-item">
                        <div class="guide-item-img">
                            <img src="/ktv/public/img/消费.png">
                        </div>
                        服务前台
                    </div>
                </a>
                <a href="/ktv/view/setting/index.php">
                    <div class="guide-item">
                        <div class="guide-item-img">
                            <img src="/ktv/public/img/系统管理员管理.png">
                        </div>
                        管理后台
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>
</html>