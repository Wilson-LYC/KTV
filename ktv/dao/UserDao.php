<?php
include_once 'MySQLConnect.php';
class UserDao{
    /**
     * 新增用户
     * @param $name [用户名]
     * @param $password [密码]
     * @param $groupId [用户组id]
     * @return bool [是否新增成功]
     */
    function addUser($name,$password,$groupId){
        $mySql=new MySQLConnect();
        $query = "insert into users(name,password,group_id) values(?,?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("ssi", $name,$password,$groupId);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res>0;
    }
    /**
     * 通过用户名获取密码
     * @param $name [用户名]
     * @return array [数组]
     */
    function getUserByName2($name){
        $mySql = new MySQLConnect();
        $query = "select * from v_user_detail where name=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->bind_result($id,$name,$password,$groupId,$groupName,$permission);
        $res=array();
        while($stmt->fetch()){
            $permission=json_decode($permission,true);
            $user=array('id'=>$id,
                'name'=>$name,
                'password'=>$password,
                'groupId'=>$groupId,
                'groupName'=>$groupName,
                'permission'=>$permission);
            array_push($res,$user);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 通过用户名获取用户列表
     * @param $name [用户名]
     * @return array [数组]
     */
    function getUserByName($name)
    {
        $mySql = new MySQLConnect();
        $query = "select * from v_user_list where name=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $stmt->bind_result($id, $name, $groupId, $groupName, $permission);
        $res = array();
        while ($stmt->fetch()) {
            $permission=json_decode($permission,true);
            $user = array('id' => $id,
                'name' => $name,
                'groupId' => $groupId,
                'groupName' => $groupName,
                'permission' => $permission);
            array_push($res, $user);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 获取所有用户
     * @return array [数组]
     */
    function getAllUser(){
        $mySql = new MySQLConnect();
        $query = "select * from v_user_list";
        $stmt = $mySql->link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id,$name,$groupId,$groupName,$permission);
        $res=array();
        while($stmt->fetch()){
            $permission=json_decode($permission,true);
            $user=array('id'=>$id,
                'name'=>$name,
                'groupId'=>$groupId,
                'groupName'=>$groupName,
                'permission'=>$permission);
            array_push($res,$user);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 通过id获取用户
     * @param $id [用户id]
     * @return array [数组]
     */
    function getUserById($id){
        $mySql = new MySQLConnect();
        $query = "select * from v_user_detail where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id,$name,$password,$groupId,$groupName,$permission);
        $res=array();
        while($stmt->fetch()){
            $permission=json_decode($permission,true);
            $user=array('id'=>$id,
                'name'=>$name,
                'password'=>$password,
                'groupId'=>$groupId,
                'groupName'=>$groupName,
                'permission'=>$permission);
            array_push($res,$user);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 通过id和用户名模糊查找用户
     * @param $id [用户id]
     * @param $name [用户名]
     * @return array [数组]
     */
    function getUserByKey($id,$name,$groupId){
        $mySql = new MySQLConnect();
        $query = "select * from v_user_list where id like ? and name like ? and group_id like ?";
        $stmt = $mySql->link->prepare($query);
        $name="%".$name."%";
        $id=$id==null?"%":strval($id);
        if($groupId==null || $groupId==0)
            $groupId="%";
        else
            $groupId=strval($groupId);
        $stmt->bind_param("sss", $id,$name,$groupId);
        $stmt->execute();
        $stmt->bind_result($id,$name,$groupId,$groupName,$permission);
        $res=array();
        while($stmt->fetch()){
            $permission=json_decode($permission,true);
            $user=array('id'=>$id,
                'name'=>$name,
                'groupId'=>$groupId,
                'groupName'=>$groupName,
                'permission'=>$permission);
            array_push($res,$user);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 通过id删除用户
     * @param $id [用户id]
     * @return bool [是否删除成功]
     */
    function deleteUser($id){
        $mySql = new MySQLConnect();
        $query = "delete from users where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $id);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res>0;
    }

    /**
     * 通过id更新用户
     * @param $id [用户id]
     * @param $name [用户名]
     * @param $password [密码]
     * @param $groupId [用户组id]
     * @return bool [是否更新成功]
     */
    function updateUser($id,$name,$password,$groupId){
        $mySql = new MySQLConnect();
        $query = "update users set name=?,password=?,group_id=? where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("ssii", $name,$password,$groupId,$id);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res>0;
    }

    /**
     * 通过用户组id获取用户数量
     * @param $groupId [用户组id]
     * @return mixed [用户数量]
     */
    function getCountByGroupId($groupId){
        $mySql = new MySQLConnect();
        $query = "select count(*) from v_user_list where group_id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $groupId);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        $mySql->link->close();
        return $count;
    }
}