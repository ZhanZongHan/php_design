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
    $orders_array = array();
    for ($i=0; $i<count($orders);$i++) {
        $orders_array[$i] = array();
        $orders_array[$i]['order_id'] = $orders[$i]->getOrderId();
        $orders_array[$i]['order_code'] = $orders[$i]->getOrderCode();
        $orders_array[$i]['total_price'] = $orders[$i]->getTotalPrice();
        $orders_array[$i]['user_addr'] = $orders[$i]->getUserAddr();
        $orders_array[$i]['user_phone'] = $orders[$i]->getUserPhone();
        $orders_array[$i]['order_state'] = $orders[$i]->getOrderState();
        $orders_array[$i]['user_id'] = $orders[$i]->getUserId();
        $orders_array[$i]['order_time'] = $orders[$i]->getOrderTime();
    }
//    var_dump($orders_array);
//    $sessionTool->setAttribute("search_orders", $orders);
    echo json_encode($orders_array);
} else if ($type == "find_order_and_item") {
    $dst = $_GET['dst'];
    $order_id = $_GET['order_id'];
    $search_order = get_orders_by_order_id($order_id)[0];
    $sessionTool->setAttribute('search_order', $search_order);
    header("Location:../views/$dst");
}else if (isset($_POST['modify_order_state'])) {
    $order_id = $_POST['order_id'];
    $order_state = $_POST['order_state'];
    $orderController->modify_order_state($order_id, $order_state);
} else if (isset($_POST['find_orders_by_user_id'])) {
    $user_id = $_POST['user_id'];
    $orders = array();
    $orders = $orderController->findOrders(array('user_id' => $user_id), 0);
    $orders_array = array();
    for ($i=0; $i<count($orders);$i++) {
        $orders_array[$i] = array();
        $orders_array[$i]['order_id'] = $orders[$i]->getOrderId();
        $orders_array[$i]['order_code'] = $orders[$i]->getOrderCode();
        $orders_array[$i]['total_price'] = $orders[$i]->getTotalPrice();
        $orders_array[$i]['user_addr'] = $orders[$i]->getUserAddr();
        $orders_array[$i]['user_phone'] = $orders[$i]->getUserPhone();
        $orders_array[$i]['order_state'] = $orders[$i]->getOrderState();
        $orders_array[$i]['user_id'] = $orders[$i]->getUserId();
        $orders_array[$i]['order_time'] = $orders[$i]->getOrderTime();
    }
//    var_dump($orders_array);
    echo json_encode($orders_array);
}