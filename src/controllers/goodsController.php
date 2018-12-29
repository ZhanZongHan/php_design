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
isset($_GET['type']) ? $type = $_GET['type'] : $type = '';
if ($type == 'show') {
    // 按条件显示商品
    $where = array();
    if (isset($_GET['goods_class_id'])) {
        $where['goods_class_id'] = $_GET['goods_class_id'];
    }
    $goodses = $goodsController->findGoodses($where);
    $sessionTool->setAttribute('goodses', $goodses);
    header("Location:../views/admin/goods.php");
} else if ($type == 'delete') {
    // 删除商品
    $goods_id = $_GET['goods_id'];
    $goodsController->deleteGoods($goods_id);
    header("Location:../controllers/goodsController.php?type=show");
} else if ($type == 'showGoodsClasses') {
    // 显示商品类
    $where = array();
    $goods_classes = $goodsController->findGoodsClasses($where);
    $sessionTool->setAttribute('goodsClasses', $goods_classes);
    header("Location:../views/admin/goods_add.php");
} else if (isset($_POST['goods_add_submit'])) {
    // 添加商品
    $goods_attr = array();
    $goods_attr['goods_name'] = $_POST['goods_name'];
    $goods_attr['goods_class_id'] = $_POST['goods_class_id'];
    $goods_attr['goods_price'] = $_POST['goods_price'];
    $goods_attr['goods_stock'] = $_POST['goods_stock'];
    $goods_attr['goods_description'] = $_POST['goods_description'];

    $imgs = $_FILES['goods_imgs'];
    // 取第一张图片做主图
    $goods_attr['goods_primary_img_url'] = $_COOKIE['GOODS_IMG_PART_PATH'] . $imgs['name'][0];
    $goods_id = $goodsController->addGoods($goods_attr);

    // 上传主图
    if (!file_exists('../../uploads/goods_img/' . $imgs['name'][0])) {
        move_uploaded_file($imgs["tmp_name"][0], '../../uploads/goods_img/' . $imgs['name'][0]);
    }

    // 添加除第一张外的图片到goods_img_url中
    $len = count($imgs['name']);
    $goods_img_attr = array();
    for ($i = 1; $i < $len; $i++) {
        $goods_img_attr['goods_img_url'] = $_COOKIE['GOODS_IMG_PART_PATH'] . $imgs['name'][$i];
        $goods_img_attr['goods_id'] = $goods_id;
        if (!file_exists('../../uploads/goods_img/' . $imgs['name'][$i])) {
            move_uploaded_file($imgs["tmp_name"][$i], '../../uploads/goods_img/' . $imgs['name'][$i]);
        }
        $goodsController->addGoodsImg($goods_img_attr);
    }


    header("Location:../controllers/goodsController.php?type=show");
}
