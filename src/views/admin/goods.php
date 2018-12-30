<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 上午9:49
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="order by dede58.com"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>后台管理</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

</head>
<body>

<div id="wrapper">

    <!-- Sidebar -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admin_index.html">后台管理</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li><a href="admin_index.html"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li>
                    <a href="../../controllers/orderController.php?type=show_all_orders&dst=admin/order.php&cur_page=<?php echo $cur_page ?>"><i
                                class="fa fa-desktop"></i> 订单管理</a>
                </li>
                <li><a href="#"><i class="fa fa-file"></i> 用户管理</a></li>
                <li><a href="#"><i class="fa fa-table"></i> 报表统计</a></li>
                <li class="active"><a href="goods.php"><i class="fa fa-caret-square-o-down"></i>
                        商品管理</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right navbar-user">
                <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b
                                class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
                        <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="../login/login.html"><i class="fa fa-power-off"></i> 退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1>商品管理
                    <small> 商品的增删查改</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="admin_index.html"><i class="icon-dashboard"></i> 首页</a></li>
                    <li class="active"><i class="icon-file-alt"></i> 商品管理</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="dropdown col-sm-6 col-md-3">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    商品显示类别
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php">所有</a>
                    </li>
                    <?php for ($i = 0;
                               $i < count($goods_classes);
                               $i++) { ?>
                        <li>
                            <a href="../../controllers/goodsController.php?type=show_goodses_by_goods_class_id&dst=admin/goods.php&goods_class_id=<?php echo $goods_classes[$i]->getGoodsClassId() ?>"><?php echo $goods_classes[$i]->getGoodsClassName() ?></a>
                        </li>
                    <?php } ?>
                </ul>
                <a href="goods_add.php">
                    <button type="button" class="btn btn-link">添加商品</button>
                </a>
            </div>
        </div>
        <br>
        <div class="row">
            <?php foreach ($goodses
                           as $goods) { ?>
                <div class="col-sm-6 col-md-3">
                    <a href="../../controllers/goodsController.php?type=show_goods_imgs_by_goods_id&dst=admin/goods_item.php&goods_id=<?php echo $goods->getGoodsId() ?>"
                    ">
                    <img width="260px" height="180px" class="img-circle"
                         src="<?php echo $goods->getGoodsPrimaryImgUrl() ?>"
                         alt="<?php echo $goods->getGoodsName() ?>">
                    </a>
                    <center>
                        <label type="button" class="btn btn-default btn-sm" style="text-shadow: black 5px 3px 3px;">
                            <span class="glyphicon glyphicon-bookmark"></span> <?php echo $goods->getGoodsName() ?>
                        </label>
                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#<?php echo $goods->getGoodsId() ?>">删除
                        </button>
                    </center>
                    <!-- 模态框 -->
                    <div class="modal fade" id="<?php echo $goods->getGoodsId() ?>">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <!-- 模态框头部 -->
                                <div class="modal-header">
                                    <h4 class="modal-title">是否确认删除</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- 模态框主体 -->
                                <div class="modal-body">

                                </div>
                                <!-- 模态框底部 -->
                                <div class="modal-footer">
                                    <a href="../../controllers/goodsController.php?type=delete_goods&dst=admin/goods.php&goods_id=<?php echo $goods->getGoodsId() ?>">
                                        <button type="button" class="btn btn-danger">确认删除</button>
                                    </a></center>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <ul class="pager">
            <?php if ($pager->getCurPage() == 1) { ?>
                <li>
                    <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php&cur_page=<?php echo $pager->getHomePage() ?>">首
                        页</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php&cur_page=<?php echo $pager->getNextPage() ?>">下一页&rarr;</a>
                </li>

            <?php } else if ($pager->getCurPage() == $pager->getTotalPage()) { ?>
                <li>
                    <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php&cur_page=<?php echo $pager->getPrevPage() ?>">&larr;上一页</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php&cur_page=<?php echo $pager->getTailPage() ?>">尾
                        页&rarr;</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php&cur_page=<?php echo $pager->getHomePage() ?>">首
                        页</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php&cur_page=<?php echo $pager->getPrevPage() ?>">&larr;上一页</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php&cur_page=<?php echo $pager->getNextPage() ?>">下一页&rarr;</a>
                </li>
                <li>
                    <a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php&cur_page=<?php echo $pager->getTailPage() ?>">尾
                        页&rarr;</a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <!-- JavaScript -->
    <script src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
</body>
</html>
