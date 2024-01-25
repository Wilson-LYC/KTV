<?php
include_once "../dao/CommodityDao.php";
$commId=$_POST['commId'];
$commodityDao=new CommodityDao();
$commodity=$commodityDao->getCommodityById($commId)[0];
echo $commodity['inventory'];