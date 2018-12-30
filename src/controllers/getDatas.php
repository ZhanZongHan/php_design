<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-30
 * Time: 下午2:00
 */
include_once($_COOKIE['ABSPATH'] . '/src/controllers/GoodsController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/OrderController.php');
$goodsController = new GoodsController();
function get_goodses()
{
    global $goodsController;
    return $goodsController->findGoodses(array());
}

function get_goodses_by_goods_id($goods_id)
{
    global $goodsController;
    $where['goods_id'] = $goods_id;
    return $goodsController->findGoodses($where);
}

function get_goodses_by_goods_name($goods_name)
{
    global $goodsController;
    $where['goods_name'] = $goods_name;
    return $goodsController->findGoodses($where);
}

function get_goodses_by_goods_class_id($goods_class_id)
{
    global $goodsController;
    $where['goods_class_id'] = $goods_class_id;
    return $goodsController->findGoodses($where);
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
