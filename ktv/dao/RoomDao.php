<?php
include_once 'MySQLConnect.php';
class RoomDao
{
    /**
     * 新增房间
     * @param $name [房间名]
     * @param $rtype_id [房型id]
     * @param $floor [楼层]
     * @param $annotation [备注]
     * @return bool
     */
    function addRoom($name, $type_id, $floor, $annotate){
        $mySql = new MySQLConnect();
        $query = "insert into room(name,type_id,floor,annotate) values(?,?,?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("siss", $name,$type_id,$floor,$annotate);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 从v_room_list视图中获取所有房间
     * @return array
     */
    function getAllRoom()
    {
        $mySql = new MySQLConnect();
        $query = "select * from v_room_list";
        $stmt = $mySql->link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $name, $type_id, $type_name, $price, $capacity,$floor,$state);
        $res = array();
        while ($stmt->fetch()) {
            $res[] = array(
                'id' => $id,
                'name' => $name,
                'type_id' => $type_id,
                'type_name' => $type_name,
                'price' => $price,
                'capacity' => $capacity,
                'floor' => $floor,
                'state' => $state
            );
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 获取所有楼层
     * @return array
     */
    function getAllFloor(){
        $mySql = new MySQLConnect();
        $query = "select distinct floor from room order by floor";
        $stmt = $mySql->link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($floor);
        $res = array();
        while ($stmt->fetch()) {
            $res[] = array(
                'floor' => $floor
            );
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 通过id、房名、房型编号、人数、楼层查询房间
     * @param $id
     * @param $name
     * @param $rtype_id
     * @param $galleryful
     * @param $floor
     * @return array
     */
    function getRoomByKey($id,$name,$typeId,$capacity,$floor,$state){
        $mySql = new MySQLConnect();
        $query = "select * from v_room_list where id like ? and name like ? and type_id like ? and capacity >=? and floor like ? and state like ? order by id";
        $stmt = $mySql->link->prepare($query);
        $id=$id==null?"%":strval($id);
        $name="%".$name."%";
        $typeId=$typeId==0?"%":$typeId;
        $capacity=$capacity==null?"0":$capacity;
        $floor=$floor==0?"%":strval($floor);
        if($state==0 || $state==null)
            $state="%";
        $stmt->bind_param("sssiss",$id,$name,$typeId,$capacity,$floor,$state);
        $stmt->execute();
        $stmt->bind_result($id, $name, $type_id, $type_name, $price, $capacity,$floor,$state);
        $res = array();
        while ($stmt->fetch()) {
            $res[] = array(
                'id' => $id,
                'name' => $name,
                'type_id' => $type_id,
                'type_name' => $type_name,
                'price' => $price,
                'capacity' => $capacity,
                'floor' => $floor,
                'state' => $state
            );
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 通过id获取房间
     * @param $id
     * @return array
     */
    function getRoomById($id){
        $mySql = new MySQLConnect();
        $query = "select * from v_room_detail where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $type_id, $type_name, $price, $capacity,$floor,$annotate,$state);
        $res = array();
        while ($stmt->fetch()) {
            $res[] = array(
                'id' => $id,
                'name' => $name,
                'type_id' => $type_id,
                'type_name' => $type_name,
                'price' => $price,
                'capacity' => $capacity,
                'floor' => $floor,
                'annotate'=>$annotate,
                'state' => $state
            );
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 更新房间
     * @param $id
     * @param $name
     * @param $rtype_id
     * @param $floor
     * @param $annotation
     * @return bool
     */
    function updateRoom($id,$name,$typeId,$floor,$annotate)
    {
        $mySql = new MySQLConnect();
        $query = "update room set name=?,type_id=?,floor=?,annotate=? where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("sissi", $name, $typeId, $floor, $annotate, $id);
        $res = $stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 删除房间
     * @param $id
     * @return bool
     */
    function deleteRoom($id){
        $mySql = new MySQLConnect();
        $query = "delete from room where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i",$id);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
}