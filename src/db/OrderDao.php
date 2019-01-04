<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午7:53
 */
include_once($_COOKIE['ABSPATH'] . '/src/db/DataBase.php');
include_once($_COOKIE['ABSPATH'] . '/src/beans/Order.php');
include_once($_COOKIE['ABSPATH'] . '/src/tools/OrderPager.php');

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

    /**
     * @param array $where
     * @param int $cur_page
     * @return array 根据查询条件返回订单列表
     */
    public function findOrders($where, $cur_page=1)
    {
        $sql = "select * from `order`";
        if (count($where) > 0) {
            $key = array_keys($where)[0];
            switch ($key) {
                case 'order_id' || 'user_id':
                    $sql = $sql . " where " . $key . "=" . $where[$key];
                    break;
                case 'order_code':
                    $sql = $sql . " where " . $key . "='" . $where[$key] . "'";
                    break;
                default:
                    break;
            }
        }
        if ($cur_page)
            $sql = $sql." limit " . (($cur_page - 1) * OrderPager::$page_size) . ", " . OrderPager::$page_size;
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $orders = array();
        while ($row = $rs->fetch_array()) {
            $order = new Order();
            $order->setOrderId($row['order_id']);
            $order->setOrderCode($row['order_code']);
            $order->setOrderState($row['order_state']);
            $order->setTotalPrice($row['total_price']);
            $order->setUserAddr($row['user_addr']);
            $order->setUserId($row['user_id']);
            $order->setUserPhone($row['user_phone']);
            $order->setOrderTime($row['order_time']);
            array_push($orders, $order);
        }
        return $orders;
    }

    /**
     * @param array $order_attr
     * @return int
     */
    public function addOrder($order_attr)
    {
        $sql = sprintf("insert into `order` (order_code, total_price, user_addr, 
          user_phone, user_id) values ('%s', %f, '%s', '%s', %d)",
            $order_attr['order_code'], $order_attr['total_price'], $order_attr['user_addr'],
            $order_attr['user_phone'], $order_attr['user_id']);
        $this->db->query($sql);
        return $this->db->getInsertId();
    }

    /**
     * @param int $goods_id
     * @param int $goods_stock
     * @return bool
     */
    public function modifyGoodsStock($goods_id, $goods_stock)
    {
        $sql = "update `goods` set goods_stock=goods_stock-$goods_stock where goods_id=$goods_id";
        $this->db->query($sql);
        return $this->db->getRs();
    }

    /**
     * @return int
     */
    public function getCounts()
    {
        $sql = "select count(*) as counts from `order`";
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $row = $rs->fetch_array();
        return $row['counts'];
    }
}