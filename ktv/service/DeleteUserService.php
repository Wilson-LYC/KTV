<?php
include_once '../dao/UserDao.php';
//从post中获取数据
$id=$_POST['id'];
//删除用户，成功返回200，失败返回400
$userDao=new UserDao();
$res=$userDao->deleteUser($id);
if($res){
    echo 200;
}else{
    echo 400;
}


