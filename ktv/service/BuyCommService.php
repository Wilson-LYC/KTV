<?php
include_once "../dao/OrderDao.php";
$orderId=$_POST['orderId'];
$commId=$_POST['commId'];
$num=$_POST['num'];
$orderDao = new OrderDao();
$res=$orderDao->buyComm($orderId,$commId,$num);
if($res){
    echo "200";
}
else{
    echo "400";
}