<?php
include_once "MySQLConnect.php";
class OrderDao
{
    /**
     * 获取所有订单的简述
     * @return array
     */
    function getAllOrder(){
        $mySql = new MySQLConnect();
        $query = "select * from v_order_briefly";
        $stmt = $mySql->link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id,$userId,$userName,$roomId,$roomName,$roomTId,$roomTName,$roomPrice,$begTime,$endTime,$duration,$sumRoomPrice,$sumCommPrice,$sumPrice,$actualPay);
        $res = array();
        while ($stmt->fetch()) {
            $order = array('id' => $id,
                'userId' => $userId,
                'userName' => $userName,
                'roomId' => $roomId,
                'roomName' => $roomName,
                'roomTId' => $roomTId,
                'roomTName' => $roomTName,
                'roomPrice' => $roomPrice,
                'begTime' => $begTime,
                'endTime' => $endTime,
                'duration' => $duration,
                'sumRoomPrice' => $sumRoomPrice,
                'sumCommPrice' => $sumCommPrice,
                'sumPrice' => $sumPrice,
                'actualPay' => $actualPay);
            array_push($res, $order);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 模糊查询订单
     * @param $id [订单id]
     * @param $userId [用户id]
     * @param $roomId [房间id]
     * @param $roomState [房间状态]
     * @param $orderState [订单状态]
     */
    function getOrderByKey($id,$userId,$roomId,$roomState,$orderState){
        $mySql = new MySQLConnect();
        $query = "select * from v_order_briefly where `订单编号` like ? and `房间编号` like ? and `负责人编号` like ?";
        if($roomState==1)
            $query.=" and `退房时间` is null";
        else if($roomState==2)
            $query.=" and `退房时间` is not null";
        if($orderState==1)
            $query.=" and `实付` = 0";
        else if($orderState==2)
            $query.=" and `实付` >0 ";
        else if($orderState==0)
            $query.=" and `实付` >=0 ";
        $stmt = $mySql->link->prepare($query);
        $id=$id==null?"%":strval($id);
        $roomId=$roomId==0?"%":strval($roomId);
        $userId=$userId==0?"%":strval($userId);
        if($roomState==0 || $roomState==1)
            $roomState="null";
        $stmt->bind_param("sss", $id,$roomId,$userId);
        $stmt->execute();
        $stmt->bind_result($id,$userId,$userName,$roomId,$roomName,$roomTId,$roomTName,$roomPrice,$begTime,$endTime,$duration,$sumRoomPrice,$sumCommPrice,$sumPrice,$actualPay);
        $res = array();
        while ($stmt->fetch()) {
            $order = array('id' => $id,
                'userId' => $userId,
                'userName' => $userName,
                'roomId' => $roomId,
                'roomName' => $roomName,
                'roomTId' => $roomTId,
                'roomTName' => $roomTName,
                'roomPrice' => $roomPrice,
                'begTime' => $begTime,
                'endTime' => $endTime,
                'duration' => $duration,
                'sumRoomPrice' => $sumRoomPrice,
                'sumCommPrice' => $sumCommPrice,
                'sumPrice' => $sumPrice,
                'actualPay' => $actualPay);
            array_push($res, $order);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 获取订单的消费详情
     * @param $id [订单id]
     * @return array
     */
    function getOrderBuyById($id){
        $mySql = new MySQLConnect();
        $query = "select * from v_order_buy_list where `订单编号` = ?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id,$commId,$commName,$num,$price);
        $res = array();
        while ($stmt->fetch()) {
            $order = array('id' => $id,
                'commId' => $commId,
                'commName' => $commName,
                'num' => $num,
                'price' => $price);
            array_push($res, $order);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 获取商品具体购买数量
     * @param $id [订单id]
     * @param $commId [商品id]
     * @return array
     */
    function getOrderBuyByIdDetail($id,$commId){
        $mySql = new MySQLConnect();
        $query = "select * from v_order_buy_list where `订单编号` = ? and `商品编号`=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("ii", $id,$commId);
        $stmt->execute();
        $stmt->bind_result($id,$commId,$commName,$num,$price);
        $res = array();
        while ($stmt->fetch()) {
            $order = array('id' => $id,
                'commId' => $commId,
                'commName' => $commName,
                'num' => $num,
                'price' => $price);
            array_push($res, $order);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 通过id获取订单的详细信息
     * @param $id [订单id]
     * @return array
     */
    function getOrderById($id){
        $mySql = new MySQLConnect();
        $query = "select * from v_order_briefly where `订单编号` = ?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($id,$userId,$userName,$roomId,$roomName,$roomTId,$roomTName,$roomPrice,$begTime,$endTime,$duration,$sumRoomPrice,$sumCommPrice,$sumPrice,$actualPay);
        $res = array();
        while ($stmt->fetch()) {
            $order = array('id' => $id,
                'userId' => $userId,
                'userName' => $userName,
                'roomId' => $roomId,
                'roomName' => $roomName,
                'roomTId' => $roomTId,
                'roomTName' => $roomTName,
                'roomPrice' => $roomPrice,
                'begTime' => $begTime,
                'endTime' => $endTime,
                'duration' => $duration,
                'sumRoomPrice' => $sumRoomPrice,
                'sumCommPrice' => $sumCommPrice,
                'sumPrice' => $sumPrice,
                'actualPay' => $actualPay);
            array_push($res, $order);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 删除订单
     * @param $id [订单id]
     */
    function deleteOrder($id){
        $mySql = new MySQLConnect();
        $query = "Call p_delete_order(?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("s", $id);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 新增订单
     * @param $roomId [房间id]
     * @param $userId [用户id]
     * @param $cusName [顾客姓名]
     * @param $cusPhone [顾客电话]
     * @param $begTime [入住时间]
     */
    function addOrder($roomId,$userId,$cusName,$cusPhone,$begTime){
        $mySql = new MySQLConnect();
        $query = "Call p_room_begin(?,?,?,?,?,@res)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("sssss", $roomId,$userId,$cusName,$cusPhone,$begTime);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 通过roomId获取退房时间为空的订单
     * @param $roomId [房间id]
     * @return array
     */
    function getOrderByRoomIdWEndTimeNull($roomId){
        $mySql = new MySQLConnect();
        $query = "select * from v_order_detail where `房间编号` = ? and `退房时间` is null";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("s", $roomId);
        $stmt->execute();
        $stmt->bind_result($id,$userId,$userName,$roomId,$roomName,$roomTId,$roomTName,$roomPrice,$begTime,$endTime,$duration,$sumRoomPrice,$sumCommPrice,$sumPrice,$actualPay,$cusName,$cusPhone);
        $res = array();
        while ($stmt->fetch()) {
            $order = array('id' => $id,
                'userId' => $userId,
                'userName' => $userName,
                'roomId' => $roomId,
                'roomName' => $roomName,
                'roomTId' => $roomTId,
                'roomTName' => $roomTName,
                'roomPrice' => $roomPrice,
                'begTime' => $begTime,
                'endTime' => $endTime,
                'duration' => $duration,
                'sumRoomPrice' => $sumRoomPrice,
                'sumCommPrice' => $sumCommPrice,
                'sumPrice' => $sumPrice,
                'actualPay' => $actualPay,
                'cusName' => $cusName,
                'cusPhone' => $cusPhone);
            array_push($res, $order);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 购买商品
     * @param $orderId [订单id]
     * @param $commId [商品id]
     * @param $num [数量]
     */
    function buyComm($orderId,$commId,$num){
        $mySql = new MySQLConnect();
        $query = "Call p_order_buy(?,?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("sss", $orderId,$commId,$num);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 更新购买数量
     * @param $orderId [订单id]
     * @param $commId [商品id]
     * @param $num [数量]
     */
    function updateBuyComm($orderId,$commId,$num){
        $mySql = new MySQLConnect();
        $query = "Call p_update_buynum(?,?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("sss", $orderId,$commId,$num);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 结账
     * @param $orderId [订单id]
     * @param $endTime [退房时间]
     * @param $totalPay [总费用]
     * @param $discount [折扣]
     * @param $actualPay [实际支付]
     * @param $annotate [备注]
     */
    function checkOut($orderId,$endTime,$totalPay,$discount,$actualPay,$annotate){
        $mySql = new MySQLConnect();
        $query = "Call p_checkout(?,?,?,?,?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("ssssss", $orderId,$endTime,$totalPay,$discount,$actualPay,$annotate);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
}