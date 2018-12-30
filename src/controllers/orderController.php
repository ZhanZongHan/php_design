<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 下午2:04
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/OrderController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/getDatas.php');
$sessionTool = new SessionTool();
$orderController = new OrderController();
isset($_GET['type']) ? $type = $_GET['type'] : $type = '';
isset($_GET['dst']) ? $dst = $_GET['dst'] : $dst = '';
if ($type == 'show_all_orders') {
    $where = array();
    if (isset($_GET['user_id'])) {
        $where['user_id'] = $_GET['user_id'];
    }
    if  (isset($_GET['order_code'])) {
        $where['order_code'] = $_GET['order_code'];
    }
    $orders = $orderController->findOrders($where);
    $sessionTool->setAttribute('orders', $orders);
    header("Location:../views/".$dst);
}