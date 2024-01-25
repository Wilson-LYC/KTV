<?php
include_once '../dao/CommodityDao.php';
//从post中获取数据
$id=$_POST['id'];
$commodityDao=new CommodityDao();
$res=$commodityDao->deleteCommodity($id);
if($res){
    echo 200;
}else{
    echo 400;
}