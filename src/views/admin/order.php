<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午7:08
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/OrderController.php');
$sessionTool = new SessionTool();
/*if (!$sessionTool->admin_session_validate())
    header("Location:../login/admin_login.php");*/
$orders = $sessionTool->getAttribute('orders');
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
            <a class="navbar-brand" href="admin_index.php">后台管理</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li><a href="admin_index.php"><i class="fa fa-dashboard"></i> 首页</a></li>
                <li class="active"><a href="../../controllers/orderController.php?type=show_all_orders&dst=admin/order.php"><i
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
                        <li><a href="../login/admin_login.php"><i class="fa fa-power-off"></i> 退出登录</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
    <div id="page-wrapper">
        <div class="row">
            <div>
                <h1>订单管理
                    <small> 订单的跟进查看</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="admin_index.php"><i class="icon-dashboard"></i> 首页</a></li>
                    <li class="active"><i class="icon-file-alt"></i> 添加商品</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <form action="#" method="get">
                <div class="form-group">
                    <label>查询方式：</label>
                    <select name="search_way" id="search_way">
                        <option value="order_id">订单id</option>
                        <option value="order_code" selected="selected">订单编码</option>
                    </select>

                    <div class="form-group input-group">
                        <input type="text" class="form-control" name="search_input" required="required">
                        <span class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>订单id</th>
                    <th>订单编码</th>
                    <th>下单时间</th>
                    <th>订单状态</th>
                    <th>订单用户id</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $order) { ?>
                    <tr>
                        <td>
                            <a href="order_item.php?order_id=<?php echo $order->getOrderId() ?>"><?php echo $order->getOrderId() ?></a>
                        </td>
                        <td><?php echo $order->getOrderCode() ?></td>
                        <td><?php echo $order->getOrderTime() ?></td>
                        <td><?php echo $order->getOrderState() ?></td>
                        <td><?php echo $order->getUserId() ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <ul class="pager">
                <li><a href="#">&larr;上一页</a></li>
                <li><a href="#">下一页&rarr;</a></li>
            </ul>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
</body>
</html>