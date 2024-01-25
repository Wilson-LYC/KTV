<?php
include_once "../dao/OrderDao.php";
$orderId=$_POST['orderId'];
$endT=$_POST['endT'];
$totalPay=$_POST['totalPay'];
$discount=$_POST['discount'];
$actualPay=$_POST['actualPay'];
$annotate=$_POST['annotate'];
$orderDao=new OrderDao();
$res=$orderDao->checkout($orderId,$endT,$totalPay,$discount,$actualPay,$annotate);
if($res)
    echo 200;
else
    echo 400;