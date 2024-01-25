<?php
include_once '../dao/RoomDao.php';
//从post中获取数据
$name=$_POST['name'];
$floor=$_POST['floor'];
$typeId=$_POST['typeId'];
$annotate=$_POST['annotate'];
//新增房间
$roomDao=new RoomDao();
$res=$roomDao->addRoom($name,$typeId,$floor,$annotate);
//$annotate
if($res){
    echo 200;
}else{
    echo 400;
}



