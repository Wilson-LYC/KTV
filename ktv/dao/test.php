<?php
include_once 'UserDao.php';
include_once 'GroupDao.php';
include_once 'RoomTypeDao.php';
include_once 'RoomDao.php';
include_once 'CategoryDao.php';
include_once 'CommodityDao.php';
include_once 'OrderDao.php';
$userDao=new UserDao();
$groupDao=new GroupDao();
$roomTypeDao=new RoomTypeDao();
$roomDao=new RoomDao();
$categoryDao=new CategoryDao();
$commodityDao=new CommodityDao();
$orderDao=new OrderDao();
//var_dump($orderDao->getOrderByKey(null,null,null,null,null));
var_dump($userDao->getUserById(27)[0]['permission']['setting']);
//var_dump(date("Y-m-d H:i:s"));