<?php
include_once '../dao/CommodityDao.php';
//从post中获取数据
$id=$_POST['id'];
$name=$_POST['name'];
$annotate=$_POST['annotate'];
$unit=$_POST['unit'];
$price=$_POST['price'];
$inventory=$_POST['inventory'];
$cateId=$_POST['cateId'];
//更新商品
$commodityDao=new CommodityDao();
$res=$commodityDao->updateCommodity($id,$name,$cateId,$price,$unit,$annotate,$inventory);
//判断是否成功
if($res){
    echo 200;
}else{
    echo 400;
}