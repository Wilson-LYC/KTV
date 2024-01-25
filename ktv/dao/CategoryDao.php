<?php
include_once 'MySQLConnect.php';
class CategoryDao
{
    /**
     * 从v_category_list获取所有商品种类
     * @return array [数组]
     */
    function getAllCategory()
    {
        $mySql = new MySQLConnect();
        $query = "select * from v_category_list";
        $stmt = $mySql->link->prepare($query);
        $stmt->execute();
        $stmt->bind_result($id, $name,$num, $annotate);
        $res = array();
        while ($stmt->fetch()) {
            $category = array('id' => $id,
                'name' => $name,
                'num' => $num,
                'annotate' => $annotate);
            array_push($res, $category);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 新增商品品类
     * @param $name [商品品类名称]
     * @param $annotate [商品品类注释]
     * @return bool [是否成功]
     */
    function addCategory($name, $annotate){
        $mySql = new MySQLConnect();
        $query = "insert into commodity_category(name,annotate) values(?,?)";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("ss", $name, $annotate);
        $res = $stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 通过id获取商品品类
     * @param $id [商品品类id]
     * @return array [商品品类]
     */
    function getCategoryById($id){
        $mySql = new MySQLConnect();
        $query = "select * from v_category_list where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($id, $name, $num,$annotate);
        $res = array();
        while ($stmt->fetch()) {
            $category = array('id' => $id,
                'name' => $name,
                'num' => $num,
                'annotate' => $annotate);
            array_push($res, $category);
        }
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 更新商品品类
     * @param $id [商品品类id]
     * @param $name [商品品类名称]
     * @param $annotate [商品品类注释]
     * @return bool [是否成功]
     */
    function updateCategory($id, $name, $annotate){
        $mySql = new MySQLConnect();
        $query = "update commodity_category set name=?,annotate=? where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("ssi", $name, $annotate, $id);
        $res = $stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
    /**
     * 删除商品品类
     * @param $id [商品品类id]
     * @return bool [是否成功]
     */
    function deleteCategory($id){
        $mySql = new MySQLConnect();
        $query = "delete from commodity_category where id=?";
        $stmt = $mySql->link->prepare($query);
        $stmt->bind_param("i", $id);
        $res = $stmt->execute();
        $stmt->close();
        $mySql->link->close();
        return $res;
    }
}