<?php
include_once '../dao/UserDao.php';
//从post中获取数据
$id=$_POST['id'];
$name=$_POST['name'];
$password=$_POST['password'];
$groupId=$_POST['groupId'];
//更新用户
$userDao=new UserDao();
$res=$userDao->updateUser($id,$name,$password,$groupId);
//判断是否成功
if($res){
    echo 200;
}else{
    echo 400;
}

