<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 上午9:15
 */
include_once($_COOKIE['ABSPATH'] . '/src/db/DataBase.php');
include_once($_COOKIE['ABSPATH'] . '/src/beans/Goods.php');
include_once($_COOKIE['ABSPATH'] . '/src/tools/GoodsPager.php');

class GoodsDao
{
    private $db = null;

    /**
     * GoodsDao constructor
     */
    public function __construct()
    {
        $this->db = new DataBase();
    }

    /**
     * 根据查询条件返回商品列表
     * @param array $where
     * @return array
     */
    public function findGoodses($where, $cur_page)
    {
        $sql = "select * from `goods` limit " . (($cur_page - 1) * GoodsPager::$page_size) . ", " . GoodsPager::$page_size;
        if (count($where) > 0) {
            $key = array_keys($where)[0];
            switch ($key) {
                case 'goods_id':
                    $sql = $sql . " where " . $key . "=" . $where[$key];
                    break;
                case 'goods_name' || 'goods_class_id':
                    $sql = $sql . " where " . $key . "='" . $where[$key] . "'";
                    break;
                default:
                    break;
            }
        }
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $goodses = array();
        while ($row = $rs->fetch_array()) {
            $goods = new Goods();
            $goods->setGoodsId($row['goods_id']);
            $goods->setGoodsDescription($row['goods_description']);
            $goods->setGoodsName($row['goods_name']);
            $goods->setGoodsClassId($row['goods_class_id']);
            $goods->setGoodsPrice($row['goods_price']);
            $goods->setGoodsStock($row['goods_stock']);
            $goods->setGoodsPrimaryImgUrl($row['goods_primary_img_url']);
            array_push($goodses, $goods);
        }
        return $goodses;
    }

    /**
     * @param array $goods_attr 要添加的商品的属性
     * @return int 返回新添加的goods_id
     */
    public function addGoods($goods_attr)
    {
        $sql = sprintf("insert into `goods` (goods_name, goods_stock, goods_price, 
          goods_description, goods_primary_img_url, goods_class_id) values ('%s',%d,%f,'%s','%s',%d)",
            $goods_attr['goods_name'], $goods_attr['goods_stock'], $goods_attr['goods_price'],
            $goods_attr['goods_description'], $goods_attr['goods_primary_img_url'], $goods_attr['goods_class_id']);
        $this->db->query($sql);
        return $this->db->getInsertId();
    }

    /**
     * @param int $goods_id
     * @return bool
     */
    public function deleteGoods($goods_id)
    {
        $sql = "delete from `goods` where goods_id=" . $goods_id;
        $this->db->query($sql);
        return $this->db->getRs();
    }

    /**
     * @param array $goods_attr 要修改的商品的属性
     * @return int 返回修改的goods_id
     */
    public function modifyGoods($goods_attr)
    {
        $sql = sprintf("update `goods` set goods_name='%s', goods_stock=%d, goods_price=%f, 
          goods_description='%s', goods_class_id=%d", $goods_attr['goods_name'], $goods_attr['goods_stock'], $goods_attr['goods_price'],
            $goods_attr['goods_description'], $goods_attr['goods_class_id']);
        $this->db->query($sql);
        return $goods_attr['goods_id'];
    }

    public function getCounts()
    {
        $sql = "select count(*) as counts from `goods`";
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $row = $rs->fetch_array();
        return $row['counts'];
    }
}