<?php
include_once "../dao/OrderDao.php";
//从post中获取数据
$roomId=$_POST['roomId'];
$userId=$_POST['userId'];
$begTime=$_POST['begTime'];
$cusName=$_POST['cusName'];
$cusPhone=$_POST['cusPhone'];
$orderDao=new OrderDao();
$res=$orderDao->addOrder($roomId,$userId,$cusName,$cusPhone,$begTime);
if($res)
    echo 200;
else
    echo 400;