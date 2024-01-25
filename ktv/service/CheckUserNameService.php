<?php
include_once '../dao/UserDao.php';
//从post中获取数据
$name=$_POST['name'];
//判断用户名是否存在，是输出400，否输出200
$userDao=new UserDao();
$res=$userDao->getUserByName($name);
if(count($res)>0){
    echo 400;
}else{
    echo 200;
}


