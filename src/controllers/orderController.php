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
    isset($_GET['cur_page']) ? $cur_page = $_GET['cur_page'] : $cur_page = 1;
    $orders = get_orders($cur_page);
    $sessionTool->setAttribute('orders', $orders);
    header("Location:../views/$dst?cur_page=$cur_page");
} else if (isset($_POST['add_order_submit'])) {
    $order_attr = array();
    $order_attr['order_code'] = uniqid();   // 生成13位随机编码
    $order_attr['total_price'] = $_POST['total_price'];
    $order_attr['user_addr'] = $_POST['user_addr'];
    $order_attr['user_phone'] = $_POST['user_phone'];
    $order_attr['user_id'] = $_POST['user_id'];
    $order_id = $orderController->addOrder($order_attr);
    // file_get_contents返回的是两重字符串，所以需转换两次才能得到数组
    $condition = file_get_contents("php://input");
    $order_items = json_decode(json_decode(substr($condition, 0, strpos($condition, '&'))), true);
    foreach ($order_items as $order_item) {
        $order_item_attr = array();
        $order_item_attr['buy_num'] = $order_item['quantity'];
        $order_item_attr['goods_id'] = $order_item['id'];
        $order_item_attr['order_id'] = $order_id;
        $orderController->addOrderItem($order_item_attr);
        $orderController->modifyGoodsStock($order_item['id'], $order_item['quantity']);
    }
} else if (isset($_POST['find_orders_type'])) {
    $type = $_POST['find_orders_type'];
    $value = $_POST['value'];
    $orders = array();
    switch ($type) {
        case 'find_orders_by_order_id':
            $orders = $orderController->findOrders(array('order_id' => $value), 0);
            break;
        case 'find_orders_by_order_code':
            $orders = $orderController->findOrders(array('order_code' => $value), 0);
            break;
        case 'find_orders_by_user_id':
            $orders = $orderController->findOrders(array('user_id' => $value), 0);
            break;
    }
  //  var_dump($orders);
    $sessionTool->setAttribute("search_orders", $orders);
    echo 1;
}