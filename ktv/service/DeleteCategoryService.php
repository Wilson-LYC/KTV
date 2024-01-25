<?php
include_once '../dao/CategoryDao.php';
//从post中获取数据
$id=$_POST['id'];
$categoryDao=new CategoryDao();
$res=$categoryDao->deleteCategory($id);
if($res){
    echo 200;
}else{
    echo 400;
}