<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午7:53
 */
include_once($_COOKIE['ABSPATH'].'/src/db/DataBase.php');

class OrderDao
{
    private $db;
    private $where = '';

    /**
     * OrderDao constructor.
     */
    public function __construct()
    {
        $this->db = new DataBase();
    }

    // 返回要查找的Order对象数据
    public function findOneOrder($order_id)
    {
        $sql = "select * from `order` where order_id = " . $order_id;
        $this->db->query($sql);
        $rs = $this->db->getRs();
        if ($rs && $this->db->getNumRows() > 0)
            return $rs->fetch_array();
        else
            return null;
    }

    // 返回所有订单
    public function findAllOrders($where)
    {
        $sql = "select * from `order`";
        if (count($where) > 0) {
            $key = array_keys($where)[0];
            $sql = $sql." where ".$key."=".$where[$key];
            print_r($where);
            echo $sql;
        }
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $orders = array();
        while ($row = $rs->fetch_array()) {
            $order = new Order();
            $order->setOrderId($row['order_id']);
            $order->setOrderCode($row['order_code']);
            $order->setOrderState($row['order_state']);
            $order->setPostcode($row['postcode']);
            $order->setTotalPrice($row['total_price']);
            $order->setUserAddr($row['user_addr']);
            $order->setUserId($row['user_id']);
            $order->setUserPhone($row['user_phone']);
            array_push($orders, $order);
        }
        return $orders;
    }

}