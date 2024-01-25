<?php
include_once '../dao/RoomTypeDao.php';
//从post中获取数据
$id=$_POST['id'];
$name=$_POST['name'];
$price=$_POST['price'];
$capacity=$_POST['capacity'];
$annotate=$_POST['annotate'];
//更新房型
$roomTypeDao=new RoomTypeDao();
$res=$roomTypeDao->updateRoomType($id,$name,$price,$capacity,$annotate);
//判断是否成功
if($res){
    echo 200;
}else{
    echo 400;
}

