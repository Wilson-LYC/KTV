<?php
include_once 'MySQLConnect.php';
class CommodityDao
{
    /**
     * 从v_commodity_list获取所有商品
     * @return array [数组]
     */
    function getAllCommodity()
    {
        $mySql = new MySQLConnect();
        $query = "select * from v_commodity_list";
        $stmt = $mySql->link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $name,$cateId,$cateName,$price,$unit,$inventory,$annotate,$sale);
        $res = array();
        while ($stmt->fetch()) {
            $commodity = array('id' => $id,
                'name' => $name,
                'cateId' => $cateId,
                'cateName' => $cateName,
                'price' => $price,
                'unit' => $unit,
                'inventory' => $inventory,
                'annotate' => $annotate,
                'sale' => $sale);
            array_push($res, $commodity);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 通过id、名称和类别ID模糊获取商品
     * @param $id [商品id]
     * @param $name [商品名称]
     * @param $cateId [商品类别id]
     * @return array [商品]
     */
    function getCommodityByKey($id,$name,$cateId){
        $mySql = new MySQLConnect();
        $query = "select * from v_commodity_list where id like ? and name like ? and cate_id like ?";
        $stmt = $mySql->link->prepare($query);
        $id=$id==null?"%":strval($id);
        $name = "%".$name."%";
        if($cateId==null || $cateId==0)
            $cateId = "%";
        $stmt->bind_param("sss", $id,$name,$cateId);
        $stmt->execute();
        $stmt->bind_result($id, $name,$cateId,$cateName,$price,$unit,$inventory,$annotate,$sale);
        $res = array();
        while ($stmt->fetch()) {
            $commodity = array('id' => $id,
                'name' => $name,
                'cateId' => $cateId,
                'cateName' => $cateName,
                'price' => $price,
                'unit' => $unit,
                'inventory' => $inventory,
                'annotate' => $annotate,
                'sale' => $sale);
            array_push($res, $commodity);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 通过id获取商品
     * @param $id [商品id]
     * @return array [商品]
     */
    function getCommodityById($id)
    {
        $mySql = new MySQLConnect();
        $query = "select * from v_commodity_list where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $cateId, $cateName, $price, $unit, $inventory, $annotate, $sale);
        $res = array();
        while ($stmt->fetch()) {
            $commodity = array('id' => $id,
                'name' => $name,
                'cateId' => $cateId,
                'cateName' => $cateName,
                'price' => $price,
                'unit' => $unit,
                'inventory' => $inventory,
                'annotate' => $annotate,
                'sale' => $sale);
            array_push($res, $commodity);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 新增商品
     * @param $name [商品名称]
     * @param $cateId [商品类别id]
     * @param $price [商品价格]
     * @param $unit [商品单位]
     * @param $annotate [商品注释]
     * @return bool [是否成功]
     */
    function addCommodity($name, $cateId,$price,$unit,$annotate,$inventory){
        $mySql = new MySQLConnect();
        $query = "insert into commodity(name,cate_id,price,unit,annotate,inventory) values(?,?,?,?,?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("sidssi", $name, $cateId,$price,$unit,$annotate,$inventory);
        $res = $stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 更新商品
     * @param $id [商品id]
     * @param $name [商品名称]
     * @param $cateId [商品类别id]
     * @param $price [商品价格]
     * @param $unit [商品单位]
     * @param $annotate [商品注释]
     * @param $inventory [商品库存]
     * @return bool [是否成功]
     */
    function updateCommodity($id,$name, $cateId,$price,$unit,$annotate,$inventory)
    {
        $mySql = new MySQLConnect();
        $query = "update commodity set name=?,cate_id=?,price=?,unit=?,annotate=?,inventory=? where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("sidssii", $name, $cateId, $price, $unit, $annotate, $inventory, $id);
        $res = $stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }

    /**
     * 获取有货的商品
     * @return array [商品]
     */
    function getCommodityHaveInventory(){
        $mySql = new MySQLConnect();
        $query = "select * from v_commodity_list where inventory>0";
        $stmt = $mySql->link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $name,$cateId,$cateName,$price,$unit,$inventory,$annotate,$sale);
        $res = array();
        while ($stmt->fetch()) {
            $commodity = array('id' => $id,
                'name' => $name,
                'cateId' => $cateId,
                'cateName' => $cateName,
                'price' => $price,
                'unit' => $unit,
                'inventory' => $inventory,
                'annotate' => $annotate,
                'sale' => $sale);
            array_push($res, $commodity);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 删除商品
     * @param $id [商品id]
     */
    function deleteCommodity($id){
        $mySql = new MySQLConnect();
        $query = "Call p_delete_comm(?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("s", $id);
        $res=$stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
}