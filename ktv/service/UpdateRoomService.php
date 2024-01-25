<?php
include_once '../dao/RoomDao.php';
//从post中获取数据
$id=$_POST['id'];
$name=$_POST['name'];
$typeId=$_POST['typeId'];
$floor=$_POST['floor'];
$annotate=$_POST['annotate'];
//更新房间
$roomDao=new RoomDao();
$res=$roomDao->updateRoom($id,$name,$typeId,$floor,$annotate);
//判断是否成功
if($res){
    echo 200;
}else{
    echo 400;
}

