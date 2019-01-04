<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 19-1-4
 * Time: 上午12:23
 */
include_once($_COOKIE['ABSPATH'] . '/src/db/DataBase.php');
include_once($_COOKIE['ABSPATH'] . '/src/beans/OrderItem.php');

class OrderItemDao
{
    private $db = null;

    /**
     * GoodsImgDao constructor.
     */
    public function __construct()
    {
        $this->db = new DataBase();
    }

    /**
     * @param array $where
     * @return array
     */
    public function findOrderItems($where)
    {
        $sql = "select * from `order_item`";
        if (count($where) > 0) {
            $key = array_keys($where)[0];
            $sql = $sql . " where " . $key . "=" . $where[$key] . "";
        }
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $order_items = array();
        while ($row = $rs->fetch_array()) {
            $order_item = new OrderItem();
            $order_item->setOrderItemId($row['order_item_id']);
            $order_item->setBuyNum($row['buy_num']);
            $order_item->setOrderId($row['order_id']);
            $order_item->setGoodsId($row['goods_id']);
            array_push($order_items, $order_item);
        }
        return $order_items;
    }

    /**
     * @param array $order_item_attr
     * @return int 返回新添加的order_item_id
     */
    public function addOrderItem($order_item_attr)
    {
        $sql = sprintf("insert into `order_item` (buy_num, order_id, goods_id) values (%d, %d, %d)",
            $order_item_attr['buy_num'], $order_item_attr['order_id'], $order_item_attr['goods_id']);
        $this->db->query($sql);
        return $this->db->getInsertId();
    }
}