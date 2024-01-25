<?php
include_once '../dao/RoomDao.php';
//从post中获取数据
$id=$_POST['id'];
//删除房型，成功返回200，失败返回400
$roomDao=new RoomDao();
$res=$roomDao->deleteRoom($id);
if($res){
    echo 200;
}else{
    echo 400;
}