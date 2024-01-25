<?php
class MySQLConnect
{
    public $link;

    public function __construct()
    {
        $this->link = new mysqli();
        /*数据库信息在此配置*/
        @$this->link->connect("localhost", "root", "root");
        $this->link->connect_errno and die('数据库服务器连接失败！');
        @$this->link->select_db("ktv");
        $this->link->errno and die('打开数据库失败！');
    }

}


