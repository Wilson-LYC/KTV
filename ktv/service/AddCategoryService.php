<?php
include_once '../dao/CategoryDao.php';
//从post中获取数据
$name=$_POST['name'];
$annotate=$_POST['annotate'];
//新增商品种类
$categoryDao=new CategoryDao();
$res=$categoryDao->addCategory($name,$annotate);
//判断是否成功
if($res){
    echo 200;
}else{
    echo 400;
}