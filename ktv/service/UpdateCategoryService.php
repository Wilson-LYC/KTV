<?php
include_once '../dao/CategoryDao.php';
//从post中获取数据
$id=$_POST['id'];
$name=$_POST['name'];
$annotate=$_POST['annotate'];
//更新商品种类
$categoryDao=new CategoryDao();
$res=$categoryDao->updateCategory($id,$name,$annotate);
//判断是否成功
if($res){
    echo 200;
}else{
    echo 400;
}