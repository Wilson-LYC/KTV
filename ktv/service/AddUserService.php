<?php
include_once '../dao/UserDao.php';
//从post中获取数据
$name=$_POST['name'];
$password=$_POST['password'];
$groupId=$_POST['groupId'];
//新增用户
$userDao=new UserDao();
$res=$userDao->addUser($name,$password,$groupId);
//判断是否成功
if($res){
    echo 200;
}else{
    echo 400;
}