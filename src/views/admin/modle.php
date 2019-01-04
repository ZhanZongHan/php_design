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
        <div class="row">
            <div class="col-lg-12">
                <h1>Blank Page <small>A Blank Slate</small></h1>
                <ol class="breadcrumb">
                    <li><a href="admin_index.php"><i class="icon-dashboard"></i> Dashboard</a></li>
                    <li class="active"><i class="icon-file-alt"></i> Blank Page</li>
                </ol>
            </div>
        </div><!-- /.row -->
    </div>
</div>
<!-- JavaScript -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>


</body>
</html>