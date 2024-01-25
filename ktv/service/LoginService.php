<?php
//判断是否通过post方式访问页面
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location:/ktv/view/login.php");
}
//从post中获取用户名和密码
$username = $_POST['name'];
$password = $_POST['password'];
//引入UserDao
include '../dao/UserDao.php';
$userDao = new UserDao();
//调用login方法
$res = $userDao->getUserByName2($username);
//判断是否登录成功
if ($password == $res[0]['password']) {
    //登录成功，将用户信息存入session
    session_start();
    $_SESSION['user'] = $res[0];
    $_SESSION['login']=true;
    echo 200;
} else {
    echo 400;//登录失败
}
