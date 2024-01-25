<?php
require_once "../setting_config.php";
include_once "../../../dao/UserDao.php";
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
                <a href="<?php echo LIST_PATH."order.php"?>"><li>订单管理</li></a>
                <a href="<?php echo LIST_PATH."user.php"?>"><li id="menu-item-select">用户管理</li></a>
            </ul>
        </div>
    </div>
    <!--内容-->
    <div class="content-container">
        <div class="content">
            <!--搜索-->
            <div class="search">
                <form action="user.php" method="get">
                    <!--搜索框-->
                    <div class="search-filed">
                        <!--搜索项-->
                        <div class="filed">
                            <div class="filed-title">
                                <p>序号</p>
                            </div>
                            <div class="filed-input">
                                <input type="text" id="id" name="id" placeholder="用户ID" value="<?php echo isset($_GET['id'])?$_GET['id']:"";?>">
                            </div>
                        </div>
                        <div class="filed">
                            <div class="filed-title">
                                <p>用户名</p>
                            </div>
                            <div class="filed-input">
                                <input type="text" id="name" name="name" placeholder="用户名" value="<?php echo isset($_GET['name'])?$_GET['name']:"";?>">
                            </div>
                        </div>
                        <div class="filed">
                            <div class="filed-title">
                                <p>用户组</p>
                            </div>
                            <div class="filed-input">
                                <?php
                                include_once "../../../dao/GroupDao.php";
                                $groupDao = new GroupDao();
                                $groups=$groupDao->getAllGroup();
                                ?>
                                <select name="groupId" id="groupId">
                                    <option value="0">全部</option>
                                    <?php
                                    foreach ($groups as $group){
                                    ?>
                                    <option value="<?php echo $group['id']?>" <?php if ($_GET['groupId']==$group['id']) echo 'selected'?>><?php echo $group['name']?></option>
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
                        <input type="button" id="search-reset" value="重置" onclick=resetListUserSearch()>
                    </div>
                </form>
            </div>
            <!--表格-->
            <div class="result">
                <div class="result-bt">
                    <a href="<?php echo ADD_PATH."user.php?flag=1"?>">
                        <button class="bt-normal">新增</button>
                    </a>
                </div>
                <table>
                    <?php
                    $userDao = new UserDao();
                    $items=$userDao->getUserByKey($_GET['id'],$_GET['name'],$_GET['groupId']);
                    ?>
                    <tr id="table-title">
                        <td>ID</td>
                        <td>用户名</td>
                        <td>用户组</td>
                        <td>操作</td>
                    </tr>
                    <?php
                    foreach ($items as $item){
                    ?>
                    <tr id="table-item">
                        <td><?php echo $item['id']?></td>
                        <td><?php echo $item['name']?></td>
                        <td><?php echo $item['groupName']?></td>
                        <td>
                            <button class="bt-normal" onclick=openUserDetail(<?php echo $item['id']?>)>查看</button>
                            <button class="bt-normal" onclick=openUserDetail(<?php echo $item['id']?>)>修改</button>
                            <button class="bt-delete" onclick=deleteUser(<?php echo $item['id']?>)>删除</button>
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