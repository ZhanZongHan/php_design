<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 下午2:01
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/GoodsController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/getDatas.php');
$sesssionTool = new SessionTool();
$goodses = $sesssionTool->getAttribute('goodses');
$goods_id = $_GET['goods_id'];
foreach ($goodses as $goods) {
    if ($goods->getGoodsId() == $goods_id) {
        $goods_item = $goods;
        break;
    }
}
if ($sesssionTool->isExist('goods_imgs')) {
    $goods_imgs = $sesssionTool->getAttribute('goods_imgs');
} else {
    $goods_imgs = get_goods_imgs();
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
    <!-- JavaScript -->
    <script src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                <li class="active"><a href="admin_index.html"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li><a href="../../controllers/orderController.php?type=show_all_orders&dst=admin/order.php"><i
                                class="fa fa-desktop"></i> 订单管理</a>
                </li>
                <li><a href="#"><i class="fa fa-file"></i> 用户管理</a></li>
                <li><a href="#"><i class="fa fa-table"></i> 报表统计</a></li>
                <li><a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php"><i
                                class="fa fa-caret-square-o-down"></i>
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
            <div>
                <ol class="breadcrumb">
                    <li><a href="../../controllers/goodsController.php?type=show_all_goodses&dst=admin/goods.php"><i
                                    class="icon-dashboard"></i>
                            商品管理</a></li>
                    <li class="active"><i class="icon-file-alt"></i> <?php echo $goods_item->getGoodsName() ?></li>
                </ol>
            </div>
        </div><!-- /.row -->
        <div class="row">
            <form action="../../controllers/goodsController.php" class="form-horizontal" role="form"
                  method="post" enctype="multipart/form-data">
                <div class="col-lg-4">
                    <div id="demo" class="carousel slide" style="width: 300px; height: 250px">
                        <!-- 指示符 -->
                        <ul class="carousel-indicators">
                            <li data-target="#demo" data-slide-to="0" class="active"></li>
                            <li data-target="#demo" data-slide-to="1"></li>
                            <li data-target="#demo" data-slide-to="2"></li>
                            <li data-target="#demo" data-slide-to="3"></li>
                        </ul>

                        <!-- 轮播图片 -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-thumbnail" style="width: 300px;height: 250px;"
                                     src="<?php echo $goods_item->getGoodsPrimaryImgUrl() ?>"></div>
                            <?php for ($i = 0;
                                       $i < count($goods_imgs);
                                       $i++) { ?>

                                <div class="item">
                                    <img class="img-thumbnail" style="width: 300px;height: 250px;"
                                         src="<?php echo $goods_imgs[$i]->getGoodsImgUrl() ?>"></div>

                            <?php } ?>

                            <!-- 左右切换按钮 -->
                            <a class="left carousel-control" href="#demo" role="button" data-slide="prev">
                                <span class="icon-prev" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#demo" role="button" data-slide="next">
                                <span class="icon-next" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="goods_description">商品描述</label>
                        <textarea class="form-control" rows="3" id="goods_description"
                                  name="goods_description"><?php echo $goods_item->getGoodsDescription() ?></textarea>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="form-group">
                        <label for="goods_id">商品id</label>
                        <input type="text" class="form-control" id="goods_id" name="goods_id"
                               disabled="disabled" value="<?php echo $goods_item->getGoodsId() ?>">
                    </div>

                    <div class="form-group">
                        <label for="goods_name">商品名</label>
                        <input type="text" class="form-control" id="goods_name" name="goods_name"
                               value="<?php echo $goods_item->getGoodsName() ?>">
                    </div>

                    <div class="form-group">
                        <label for="goods_class">商品类别</label>
                        <select class="form-control" name='goods_class_id' id='goods_class'>
                            <?php for ($i = 0;
                                       $i < count($goods_classes);
                                       $i++) {
                                if ($goods_item->getGoodsClassId() == $goods_classes[$i]->getGoodsClassId()) { ?>
                                    <option value='<?php echo $goods_classes[$i]->getGoodsClassId() ?>'
                                            selected="selected"><?php echo $goods_classes[$i]->getGoodsClassName() ?></option>
                                <?php } else { ?>
                                    <option value='<?php echo $goods_classes[$i]->getGoodsClassId() ?>'><?php echo $goods_classes[$i]->getGoodsClassName() ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="goods_price">商品单价</label>
                        <div class="input-group">
                            <span class="input-group-addon">$</span>
                            <input type="text" class="form-control" id="goods_price" name="goods_price"
                                   value="<?php echo $goods_item->getGoodsPrice() ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="good_stock">商品库存</label>
                        <input type="text" class="form-control" id="goods_stock" name="goods_stock"
                               value="<?php echo $goods_item->getGoodsStock() ?>">
                    </div>

                    <!--       <div class="form-group">
                               <label>商品图片(注：必须添加4张图片，且第一张作为主图显示)</label>
                               <input type="file" name="goods_imgs[]">
                               <input type="file" name="goods_imgs[]">
                               <input type="file" name="goods_imgs[]">
                               <input type="file" name="goods_imgs[]">
                           </div>-->

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        修改
                    </button>
                    <button type="reset" class="btn btn-default">重置</button>
                    <!-- 模态框 -->
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h4 class="modal-title">是否确认修改</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- 模态框主体 -->
                                <div class="modal-body">

                                </div>
                                <!-- 模态框底部 -->
                                <div class="modal-footer">
                                    <button name="goods_modify_submit" type="submit" class="btn btn-primary">确认修改
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="admin/goods.php" name="dst">
                </div>
            </form>
        </div>
    </div>

</body>
</html>
