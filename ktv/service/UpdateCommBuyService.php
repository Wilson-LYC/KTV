<?php
include_once "../dao/OrderDao.php";
$orderId=$_POST['orderId'];
$commId=$_POST['commId'];
$updateNum=$_POST['updateNum'];
$orderDao = new OrderDao();
$res=$order=$orderDao->updateBuyComm($orderId,$commId,$updateNum);
if($res){
    echo "200";
}else{
    echo "400";
}
