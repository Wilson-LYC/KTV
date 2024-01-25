<?php
include_once '../dao/OrderDao.php';
//从post中获取数据
$id=$_POST['id'];
$orderDao=new OrderDao();
$res=$orderDao->deleteOrder($id);
if($res){
    echo 200;
}else{
    echo 400;
}