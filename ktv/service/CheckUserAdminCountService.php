<?php
include_once '../dao/UserDao.php';
//查询groupid为1的数量
$userDao=new UserDao();
$res=$userDao->getCountByGroupId(1);
//判断是否大于1，是返回200，否返回400
if($res>1){
    echo 200;
}else{
    echo 400;
}


