<?php
include_once 'MySQLConnect.php';
class GroupDao
{
    /**
     * 获取所有用户组
     * @return array [数组]
     */
    function getAllGroup(){
        $mySql = new MySQLConnect();
        $query = "select * from `group`";
        $stmt = $mySql->link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id,$name,$permission,$note,$createTime,$updateTime);
        $res=array();
        while($stmt->fetch()){
            $group=array('id'=>$id,
                'name'=>$name,
                'permission'=>$permission,
                'note'=>$note,
                'createTime'=>$createTime,
                'updateTime'=>$updateTime);
            array_push($res,$group);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 通过用户组编号获取用户组
     * @param $id [用户组编号]
     * @return array [数组]
     */
    function getGroupById($id){
        $mySql = new MySQLConnect();
        $query = "select * from `group` where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id,$name,$permission,$note,$createTime,$updateTime);
        $res=array();
        while($stmt->fetch()){
            $group=array('id'=>$id,
                'name'=>$name,
                'permission'=>$permission,
                'note'=>$note,
                'createTime'=>$createTime,
                'updateTime'=>$updateTime);
            array_push($res,$group);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
}