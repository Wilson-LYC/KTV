<?php
require_once "../setting_config.php";
include_once "../../../dao/UserDao.php";
include_once "../../../dao/GroupDao.php";
//判断是否登录
if(!isset($_SESSION['login']) || $_SESSION['login'] != true){
    header("Location: /ktv/view/login.php");
}
//判断是否有权限
if(!$_SESSION['user']['permission']['setting']){
    echo "<script>alert('无权限')</script>";
    echo '<script>window.location.href="/ktv/index.php"</script>';
}
//判断flag是否为1
if(!isset($_GET['flag']) || $_GET['flag'] != 1){
    header("Location: /ktv/view/setting/list/commodity.php");
}
?>
<html>
<head>
    <title>设置</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/ktv/view/css/setting.css">
    <link rel="stylesheet" href="/ktv/view/css/setting-detail.css">
    <link rel="stylesheet" href="/ktv/view/css/header.css">
    <script src="/ktv/view/js/jquery-3.7.0.min.js"></script>
    <script src="/ktv/view/js/setting-add.js"></script>
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
            <a href="<?php echo LIST_PATH."commodity.php"?>"><li id="menu-item-select">商品管理</li></a>
            <a href="<?php echo LIST_PATH."category.php"?>"><li>商品品类管理</li></a>
            <a href="<?php echo LIST_PATH."order.php"?>"><li>订单管理</li></a>
            <a href="<?php echo LIST_PATH."user.php"?>"><li>用户管理</li></a>
        </ul>
    </div>
</div>
<!--内容-->
<div class="content-container">
    <div class="content">
        <div class="detail">
            <div class="detail-nav">
                <a href="<?php echo LIST_PATH."/commodity.php"?>">
                    <button>
                        返回
                    </button>
                </a>
            </div>
            <form onsubmit=addCommodity()>
                <!--输入框-->
                <div class="detail-item">
                    <div class="detail-item-title">
                        <p>品名</p>
                    </div>
                    <div class="detail-item-field">
                        <input type="text" id="name" name="name" placeholder="商品名称" value="" required>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-title">
                        <p>价格</p>
                    </div>
                    <div class="detail-item-field">
                        <input type="text" id="price" name="price" placeholder="价格" value="" required>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-title">
                        <p>单位</p>
                    </div>
                    <div class="detail-item-field">
                        <input type="text" id="unit" name="unit" placeholder="单位" value="" required>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-title">
                        <p>库存</p>
                    </div>
                    <div class="detail-item-field">
                        <input type="text" id="inventory" name="inventory" placeholder="初始库存" value="0" required>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-title">
                        <p>品类</p>
                    </div>
                    <div class="detail-item-field">
                        <select name="cateId" id="cateId">
                            <?php
                            include_once "../../../dao/CategoryDao.php";
                            $categoryDao = new CategoryDao();
                            $categorys = $categoryDao->getAllCategory();
                            foreach($categorys as $category){
                            ?>
                            <option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="detail-item">
                    <div class="detail-item-title">
                        <p>备注</p>
                    </div>
                    <div class="detail-item-field">
                        <input type="text" id="annotate" name="annotate" placeholder="备注" value="">
                    </div>
                </div>
                <!--按钮栏目-->
                <div class="detail-button">
                    <input type="submit" class="submit-button" value="新增" id="add-submit">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>