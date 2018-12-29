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
    public function findOrders($where) {
        $orderDao = new OrderDao();
        return $orderDao->findOrders($where);
    }
}