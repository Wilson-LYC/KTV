<?php
include_once 'MySQLConnect.php';
class RoomTypeDao
{
    /**
     * 查询所有房型
     * @return array [数组]
     */
    function getAllRoomType(){
        $mySql = new MySQLConnect();
        $query = "select * from v_roomtype_list";
        $stmt = $mySql->link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id,$name,$price,$capacity,$num);
        $res=array();
        while($stmt->fetch()){
            $roomType=array('id'=>$id,
                'name'=>$name,
                'price'=>$price,
                'capacity'=>$capacity,
                'num'=>$num);
            array_push($res,$roomType);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 通过房型编号获取房型详细信息
     * @param $id [房型编号]
     * @return array [数组]
     */
    function getRoomTypeById($id){
        $mySql = new MySQLConnect();
        $query = "select * from v_roomtype_detail where id=?";//sql语句，使用?作为占位符
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $id);//往?中注入数据，前面的i代表整形，除了i还可以写d(浮点型)、s(字符串)
        $stmt->execute();
        $stmt->bind_result($id,$name,$price,$capacity,$annotate,$num);//绑定结果
        $res=array();
        while($stmt->fetch()){
            $roomType=array('id'=>$id,
                'name'=>$name,
                'price'=>$price,
                'capacity'=>$capacity,
                'annotate'=>$annotate,
                'num'=>$num);//将结果值存入结构体中
            array_push($res,$roomType);//将结构体存入数组中
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 更新房型
     * @param $id [房型编号]
     * @param $name [房型名称]
     * @param $price [房型价格]
     * @param $galleryful [房型容纳人数]
     * @param $annotate [房型注释]
     * @return bool [是否成功]
     */
    function updateRoomType($id,$name,$price,$capacity,$annotate){
        $mySql = new MySQLConnect();
        $query = "update room_type set name=?,price=?,capacity=?,annotate=? where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("sdisi", $name,$price,$capacity,$annotate,$id);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 添加房型
     * @param $name [房型名称]
     * @param $price [房型价格]
     * @param $capacity [房型容纳人数]
     * @param $annotate [房型注释]
     * @return bool [是否成功]
     */
    function addRoomType($name,$price,$capacity,$annotate){
        $mySql = new MySQLConnect();
        $query = "insert into room_type(name,price,capacity,annotate) values(?,?,?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("sdss", $name,$price,$capacity,$annotate);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 删除房型
     * @param $id [房型编号]
     * @return bool [是否成功]
     */
    function deleteRoomType($id){
        $mySql = new MySQLConnect();
        $query = "delete from room_type where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $id);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 通过id、用户名和容纳人数模糊查找房型
     * @param $id [房型编号]
     * @param $name [房型名称]
     * @param $galleryful [房型容纳人数]
     * @return array [数组]
     */
    function getRoomtypeByKey($id,$name,$capacity){
        $mySql = new MySQLConnect();
        $query = "select * from v_roomtype_list where id like ? and name like ? and capacity >= ?";
        $stmt = $mySql->link->prepare($query);
        $id=$id==null?"%":strval($id);
        $name="%".$name."%";
        if($capacity==null || $capacity==0)
            $capacity=0;
        else
            $capacity=intval($capacity);
        $stmt->bind_param("ssi", $id,$name,$capacity);
        $stmt->execute();
        $stmt->bind_result($id,$name,$price,$capacity,$num);
        $res=array();
        while($stmt->fetch()){
            $roomType=array('id'=>$id,
                'name'=>$name,
                'price'=>$price,
                'capacity'=>$capacity,
                'num'=>$num);
            array_push($res,$roomType);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
}