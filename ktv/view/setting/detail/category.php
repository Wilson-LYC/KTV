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
//判断get中是否有id
if(!isset($_GET['id'])){
    header("Location:".LIST_PATH."category.php");
}
//获取id
$id = $_GET['id'];
//获取商品品类
include_once "../../../dao/CategoryDao.php";
$categoryDao = new CategoryDao();
$category = $categoryDao->getCategoryById($id);
//判断是否获取成功
if(count($category) <= 0){
    header("Location:".LIST_PATH."category.php");
}
$category=$category[0];
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
            <a href="<?php echo LIST_PATH."category.php"?>"><li id="menu-item-select">商品品类管理</li></a>
            <a href="<?php echo LIST_PATH."order.php"?>"><li>订单管理</li></a>
            <a href="<?php echo LIST_PATH."user.php"?>"><li >用户管理</li></a>
        </ul>
    </div>
</div>
<!--内容-->
<div class="content-container">
    <div class="content">
        <div class="detail">
            <div class="detail-nav">
                <a href="<?php echo LIST_PATH."category.php"?>">
                    <button>
                        返回
                    </button>
                </a>
            </div>
            <form onsubmit=updateCategory()>
                <!--输入框-->
                <div class="detail-item">
                    <div class="detail-item-title">
                        <p>品类ID</p>
                    </div>
                    <div class="detail-item-field">
                        <input type="text" id="id" name="id" placeholder="商品品类编号" value="<?php echo $category['id']?>" disabled>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-title">
                        <p>商品品类</p>
                    </div>
                    <div class="detail-item-field">
                        <input type="text" id="name" name="name" placeholder="商品品类名称" value="<?php echo $category['name']?>" required>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-title">
                        <p>备注</p>
                    </div>
                    <div class="detail-item-field">
                        <input type="text" id="annotate" name="annotate" placeholder="备注" value="<?php echo $category['annotate']?>">
                    </div>
                </div>
                <!--按钮栏-->
                <div class="detail-button">
                    <input type="submit" class="submit-button" value="提交修改">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>