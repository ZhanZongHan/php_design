<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 19-1-1
 * Time: 下午6:48
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/tools/GoodsPager.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/GoodsController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/getDatas.php');
$sesssionTool = new SessionTool();
isset($_GET['cur_page']) ? $cur_page = $_GET['cur_page'] : $cur_page = 1;
$pager = new GoodsPager($cur_page);
if ($sesssionTool->isExist('goodses')) {
    $goodses = $sesssionTool->getAttribute('goodses');
} else {
    $goodses = get_goodses();
}
if ($sesssionTool->isExist('goods_classes')) {
    $goods_classes = $sesssionTool->getAttribute('goods_classes');
} else {
    $goods_classes = get_goods_classes();
}