<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-30
 * Time: 下午2:00
 */
include_once($_COOKIE['ABSPATH'] . '/src/controllers/GoodsController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/OrderController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/AdminController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/UserController.php');
$goodsController = new GoodsController();
$orderController = new OrderController();
$adminController = new AdminController();
$userController = new UserController();
function get_goodses($cur_page=1)
{
    global $goodsController;
    return $goodsController->findGoodses(array(), $cur_page);
}

function get_goodses_by_goods_id($goods_id, $cur_page=1)
{
    global $goodsController;
    $where['goods_id'] = $goods_id;
    return $goodsController->findGoodses($where, $cur_page);
}

function get_goodses_by_goods_name($goods_name)
{
    global $goodsController;
    $where['goods_name'] = $goods_name;
    return $goodsController->findGoodses($where);
}

function get_goodses_by_goods_class_id($goods_class_id, $cur_page)
{
    global $goodsController;
    $where['goods_class_id'] = $goods_class_id;
    return $goodsController->findGoodses($where, $cur_page);
}

function get_goods_classes()
{
    global $goodsController;
    return $goodsController->findGoodsClasses(array());
}

function get_goods_classes_by_goods_class_id($goods_class_id)
{
    global $goodsController;
    $where['goods_class_id'] = $goods_class_id;
    return $goodsController->findGoodsClasses($where);
}

function get_goods_imgs()
{
    global $goodsController;
    return $goodsController->findGoodsImgs(array());
}

function get_goods_imgs_by_goods_id($goods_id)
{
    global $goodsController;
    $where['goods_id'] = $goods_id;
    return $goodsController->findGoodsImgs($where);
}

function get_orders()
{
}

function get_order_items()
{
}

function get_admins()
{
    global $adminController;
    return $adminController->findAdmins(array());
}

function get_admins_by_admin_name($admin_name)
{
    global $adminController;
    $admin_attr['admin_name'] = $admin_name;
    return $adminController->findAdmins($admin_attr);
}

function get_admins_by_adname_and_psword($admin_name, $password)
{
    global $adminController;
    $admin_attr['admin_name'] = $admin_name;
    $admin_attr['password'] = $password;
    return $adminController->findAdmins($admin_attr);
}

function get_users_by_usname_and_psword($username, $password)
{
    global $userController;
    $user_attr['username'] = $username;
    $user_attr['password'] = $password;
    return $userController->findUsers($user_attr);
}

function get_users() {
    global $userController;
    return $userController->findUsers(array());
}