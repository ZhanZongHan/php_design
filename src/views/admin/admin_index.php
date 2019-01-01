<?php
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/AdminController.php');
$sesssionTool = new SessionTool();
if (!$sesssionTool->isExist('ADMIN_LOGIN_SUCCESS'))
    $sesssionTool->setAttribute('ADMIN_LOGIN_SUCCESS', false);
$admin = "";
if ($sesssionTool->isExist("admin"))
    $admin = $sesssionTool->getAttribute("admin");
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
    <!-- Pager Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
</head>
<script src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
                <li class="active"><a href="admin_index.php"><i class="fa fa-dashboard"></i> 首页</a></li>
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
                <?php if (!$admin) { ?>
                    <li class="dropdown user-dropdown">
                    <a href="../login/admin_login.php" class="dropdown-toggle">
                        <i class="fa fa-power-off"></i> 登录
                    </a></li>
                <?php } else { ?>
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">欢迎您 ： <i class="fa fa-user"></i> <?php echo $admin->getAdminName() ?>
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="../../controllers/adminController.php?type=logout&dst=login/admin_login.php"><i class="fa fa-power-off"></i> 退出登录</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        登录提示
                    </div>
                    <div class="modal-body">
                        您还没有登录，请登录后再进行操作，否则您的操作将受限制!!!
                    </div>
                    <div class="modal-footer">
                        <a href="../login/admin_login.php" class="btn btn-primary">
                            前往登录
                        </a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
<?php if (!$sesssionTool->admin_session_validate()) { ?>
    <script>
        $('#myModal').modal();
    </script>
<?php } ?>

<!-- Pager Specific Plugins -->
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
<script src="js/morris/chart-data-morris.js"></script>
<script src="js/tablesorter/jquery.tablesorter.js"></script>
<script src="js/tablesorter/tables.js"></script>
<!--[if lte IE 8]>
<script src="js/excanvas.min.js"></script><![endif]-->
<script src="js/flot/jquery.flot.js"></script>
<script src="js/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/flot/jquery.flot.resize.js"></script>
<script src="js/flot/jquery.flot.pie.js"></script>
<script src="js/flot/chart-data-flot.js"></script>
</body>
</html>
