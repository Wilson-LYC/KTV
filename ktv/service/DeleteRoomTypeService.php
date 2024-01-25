<?php
include_once '../dao/RoomTypeDao.php';
//从post中获取数据
$id=$_POST['id'];
//删除房型，成功返回200，失败返回400
$roomTypeDao=new RoomTypeDao();
$res=$roomTypeDao->deleteRoomType($id);
if($res){
    echo 200;
}else{
    echo 400;
}