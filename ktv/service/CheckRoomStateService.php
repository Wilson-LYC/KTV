<?php
include_once "../dao/RoomDao.php";
$roomId=$_GET["roomId"];
$roomDao=new RoomDao();
$room=$roomDao->getRoomById($roomId);
if($room['state']==2){
    echo 400;
}else{
    echo 200;
}
