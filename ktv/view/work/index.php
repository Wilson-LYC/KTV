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
$roomTID=$_GET['roomTID'];
$state=$_GET['state'];
?>
<html>
<head>
    <title>设置</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/ktv/view/css/header.css">
    <link rel="stylesheet" href="/ktv/view/css/work-index.css">
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
    <!--筛选栏-->
    <div class="search">
        <div class="search-filed">
            <form>
                <!--输入框-->
                <div class="search-filed-item">
                    <div class="search-filed-item-title">
                        <p>房间</p>
                    </div>
                    <div class="search-filed-item-input">
                        <input type="text" id="room" name="room" placeholder="房间名称" value="<?php echo isset($_GET['room'])?$_GET['room']:"";?>">
                    </div>
                </div>
                <div class="search-filed-item">
                    <div class="search-filed-item-title">
                        <p>人数</p>
                    </div>
                    <div class="search-filed-item-input">
                        <input type="text" id="capacity" name="capacity" placeholder="容纳人数" value="<?php echo isset($_GET['capacity'])?$_GET['capacity']:"";?>">
                    </div>
                </div>
                <div class="search-filed-item">
                    <div class="search-filed-item-title">
                        <p>房型</p>
                    </div>
                    <div class="search-filed-item-input">
                        <?php
                        include_once "../../dao/RoomTypeDao.php";
                        $roomTypeDao = new RoomTypeDao();
                        $roomTypes = $roomTypeDao->getAllRoomType();
                        ?>
                        <select id="typeId" name="typeId">
                            <option value="0">全部</option>
                            <?php
                            foreach ($roomTypes as $roomType){
                            ?>
                            <option value="<?php echo $roomType['id']?>" <?php if ($_GET['typeId']==$roomType['id']) echo 'selected'?>><?php echo $roomType['name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="search-filed-item">
                    <div class="search-filed-item-title">
                        <p>楼层</p>
                    </div>
                    <div class="search-filed-item-input">
                        <select id="floor" name="floor">
                            <option value="0">全部</option>
                            <?php
                            include_once "../../dao/RoomDao.php";
                            $roomDao = new RoomDao();
                            $floors = $roomDao->getAllFloor();
                            foreach($floors as $floor){
                                ?>
                                <option value="<?php echo $floor['floor']?>" <?php if ($_GET['floor']==$floor['floor']) echo 'selected'?>><?php echo $floor['floor']?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="search-filed-item">
                    <div class="search-filed-item-title">
                        <p>状态</p>
                    </div>
                    <div class="search-filed-item-input">
                        <select id="state" name="state">
                            <option value="0" <?php if ($_GET['state']==0) echo 'selected'?>>全部</option>
                            <option value="1" <?php if ($_GET['state']==1) echo 'selected'?>>空闲</option>
                            <option value="2" <?php if ($_GET['state']==2) echo 'selected'?>>使用中</option>
                        </select>
                    </div>
                </div>
                <!--按钮-->
                <div class="search-button">
                    <input type="submit" id="search-submit" class="bt-normal" value="查询">
                    <input type="button" id="search-reset" class="bt-cancel" value="重置" onclick=resetSearch()>
                </div>
            </form>
        </div>
    </div>
    <!--内容-->
    <div class="content">
        <div class="room-list">
            <?php
            include_once "../../dao/RoomDao.php";
            $roomDao = new RoomDao();
            $rooms = $roomDao->getRoomByKey($_GET['id'],$_GET['room'],$_GET['typeId'],$_GET['capacity'],$_GET['floor'],$_GET['state']);
            foreach ($rooms as $room){
            ?>
            <div class="room-item">
                <div class="room-item-title">
                        <p><?php echo $room['name']?></p>
                </div>
                <div class="room-item-table">
                    <table>
                        <tr>
                            <td class="room-item-table-title">房型</td>
                            <td class="room-item-table-text"><?php echo $room['type_name']?></td>
                        </tr>
                        <tr>
                            <td class="room-item-table-title">状态</td>
                            <td class="room-item-table-text" style="font-weight:bold;color:<?php echo $room['state']==1?"#00B42A":"#F53F3F"?>"><?php echo $room['state']==1?"空闲":"使用中"?></td>
                        </tr>
                    </table>
                </div>
                <div class="room-item-button">
                    <?php
                        if($room['state']==1){
                            echo '<button class="bt-normal" id="bt-orderBegin" onclick=checkinForm('.$room['id'].')>开房</button>';
                        }
                        else{
                            echo '<button class="bt-normal" id="bt-orderM" onclick=detailForm('.$room['id'].')>详情</button>
                            <button class="bt-red" id="bt-orderEnd" onclick=checkoutForm('.$room['id'].')>退房/结账</button>';
                        }
                    ?>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>