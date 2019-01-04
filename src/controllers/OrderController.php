<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午11:17
 */
include_once ($_COOKIE['ABSPATH'].'/src/db/OrderDao.php');
include_once ($_COOKIE['ABSPATH'].'/src/db/OrderItemDao.php');
class OrderController
{
    private $orderDao = null;
    private $orderItemDao = null;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->orderDao = new OrderDao();
        $this->orderItemDao = new OrderItemDao();
    }

    /**
     * @param array $where
     * @param int $cur_page
     * @return array
     */
    public function findOrders($where, $cur_page=1) {
        return $this->orderDao->findOrders($where, $cur_page);
    }

    /**
     * @param array $order_attr
     * @return int
     */
    public function addOrder($order_attr) {
        return $this->orderDao->addOrder($order_attr);
    }

    /**
     * @param $order_item_attr
     * @return int
     */
    public function addOrderItem($order_item_attr) {
        return $this->orderItemDao->addOrderItem($order_item_attr);
    }

    /**
     * @param int $goods_id
     * @param int $goods_stock
     * @return bool
     */
    public function modifyGoodsStock($goods_id, $goods_stock) {
        return $this->orderDao->modifyGoodsStock($goods_id, $goods_stock);
    }

    /**
     * @return int
     */
    public function getCounts()
    {
        return $this->orderDao->getCounts();
    }
}