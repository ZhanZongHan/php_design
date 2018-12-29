<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 下午2:04
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/OrderController.php');
$sessionTool = new SessionTool();
$orderController = new OrderController();
$type = $_GET['type'];
if ($type == 'show') {
    $where = array();
    if (isset($_GET['user_id'])) {
        $where['user_id'] = $_GET['user_id'];
    }
    if  (isset($_GET['order_code'])) {
        $where['order_code'] = $_GET['order_code'];
    }
    $orders = $orderController->findOrders($where);
    $sessionTool->setAttribute('orders', $orders);
    header("Location:../views/admin/order.php");
}