<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午7:53
 */
include_once($_COOKIE['ABSPATH'].'/src/db/DataBase.php');
include_once($_COOKIE['ABSPATH'].'/src/beans/Order.php');

class OrderDao
{
    private $db = null;

    /**
     * OrderDao constructor.
     */
    public function __construct()
    {
        $this->db = new DataBase();
    }

    // 根据查询条件返回订单列表
    public function findOrders($where)
    {
        $sql = "select * from `order`";
        if (count($where) > 0) {
            $key = array_keys($where)[0];
            switch ($key) {
                case 'order_id':
                    $sql = $sql." where ".$key."=".$where[$key];
                    break;
                case 'order_code':
                    $sql = $sql." where ".$key."='".$where[$key]."'";
                    break;
                default:break;
            }
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
            $order->setOrderTime($row['order_time']);
            array_push($orders, $order);
        }
        return $orders;
    }
}