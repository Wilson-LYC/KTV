<?php
include_once '../dao/RoomTypeDao.php';
//从post中获取数据
$id=$_POST['id'];
$name=$_POST['name'];
$price=$_POST['price'];
$capacity=$_POST['capacity'];
$annotation=$_POST['annotation'];
//新增房型
$roomTypeDao=new RoomTypeDao();
$res=$roomTypeDao->addRoomType($name,$price,$capacity,$annotation);
//判断是否成功
if($res){
    echo 200;
}else{
    echo 400;
}



