<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午11:17
 */
include_once ($_COOKIE['ABSPATH'].'/src/db/OrderDao.php');
class OrderController
{
    private $orderDao = null;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->orderDao = new OrderDao();
    }


    public function findOrders($where) {
        return $this->orderDao->findOrders($where);
    }
}