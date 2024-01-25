<?php
include_once '../dao/CommodityDao.php';
//从post中获取数据
$name=$_POST['name'];
$price=$_POST['price'];
$unit=$_POST['unit'];
$cateId=$_POST['cateId'];
$annotate=$_POST['annotate'];
$inventory=$_POST['inventory'];
//新增商品
$commodityDao=new CommodityDao();
$res=$commodityDao->addCommodity($name,$cateId,$price,$unit,$annotate,$inventory);
//判断是否成功
if($res){
    echo 200;
}else{
    echo 400;
}