<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 下午1:45
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/GoodsController.php');
$sessionTool = new SessionTool();
$goodsController = new GoodsController();
$type = $_GET['type'];
if ($type == 'show') {
    $where = array();
    $goodses = $goodsController->findGoodses($where);
    $sessionTool->setAttribute('goodses', $goodses);
    header("Location:../views/admin/goods.php");
} else if ($type == 'delete') {
    $goods_id = $_GET['goods_id'];
    $goodsController->deleteGoods($goods_id);
    header("Location:" . $_COOKIE['ABSPATH'] . "/src/controllers/GoodsController.php?type=show");
}