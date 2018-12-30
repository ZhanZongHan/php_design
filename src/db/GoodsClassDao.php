<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 上午8:48
 */
include_once($_COOKIE['ABSPATH'].'/src/db/DataBase.php');
include_once($_COOKIE['ABSPATH'].'/src/beans/GoodsClass.php');
class GoodsClassDao
{
    private $db = null;

    /**
     * GoodsClassDao constructor.
     */
    public function __construct()
    {
        $this->db = new DataBase();
    }

    public function findGoodsClasses($where) {
        $sql = "select * from `goods_class`";
        if (count($where) > 0) {
            $key = array_keys($where)[0];
            $sql = $sql." where ".$key."='".$where[$key]."'";
        }
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $goods_classes = array();
        while ($row = $rs->fetch_array()) {
            $goods_class = new GoodsClass();
            $goods_class->setGoodsClassId($row['goods_class_id']);
            $goods_class->setGoodsClassName($row['goods_class_name']);
            array_push($goods_classes, $goods_class);
        }
        return $goods_classes;
    }
}