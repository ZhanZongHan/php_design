<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 下午1:10
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/OrderController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/getDatas.php');
$sessionTool = new SessionTool();
if (!$sessionTool->admin_session_validate())
    header("Location:../admin/admin_index.php");
$search_order = get_orders_by_order_id($_GET['order_id'])[0];
$admin = "";
if ($sessionTool->isExist("admin"))
    $admin = $sessionTool->getAttribute("admin");
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
                <li class="active"><a
                            href="../../controllers/orderController.php?type=show_all_orders&dst=admin/order.php"><i
                                class="fa fa-desktop"></i> 订单管理</a>
                </li>
                <li><a
                            href="../../controllers/userController.php?type=show_all_users&dst=admin/user.php"><i
                                class="fa fa-file"></i> 用户管理</a></li>
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
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">欢迎您 ： <i
                                    class="fa fa-user"></i> <?php echo $admin->getAdminName() ?>
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a href="../../controllers/adminController.php?type=logout&dst=login/admin_login.php"><i
                                            class="fa fa-power-off"></i> 退出账户</a>
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
                <h1>订单查看
                    <small> 订单的详细信息</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="../../controllers/orderController.php?type=show_all_orders&dst=admin/order.php"><i
                                    class="icon-dashboard"></i> 订单管理</a></li>
                    <li class="active"><i class="icon-file-alt"></i> 订单查看</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="dropdown col-sm-6 col-md-4">
                <form action="" class="form-horizontal">
                    <div class="form-group">
                        <label>订单id:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="text" id="order_id"
                                                                                       name="order_id" readonly>
                    </div>
                    <div class="form-group">
                        <label>订单编码:&nbsp;&nbsp;</label><input type="text" id="order_code" name="order_code" readonly>
                    </div>
                    <div class="form-group">
                        <label>总额:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <input type="text" id="total_price" name="total_price" readonly>
                    </div>
                    <div class="form-group">
                        <label>下单时间:&nbsp;&nbsp;</label><input type="text" id="order_time" name="order_time" readonly>
                    </div>
                    <div class="form-group">
                        <label>用户地址:&nbsp;&nbsp;</label><input type="text" id="user_addr" name="user_addr" readonly>
                    </div>
                    <div class="form-group">
                        <label>用户电话:&nbsp;&nbsp;</label><input type="text" id="user_phone" name="user_phone" readonly>
                    </div>
                    <div class="form-group">
                        <label>订单状态:&nbsp;&nbsp;</label><input type="text" id="order_state" name="order_state" readonly>
                        <select name="order_states" id="order_states">
                            <option value="未发货">未发货</option>
                            <option value="已发货">已发货</option>
                            <option value="配送中">配送中</option>
                            <option value="已收货">已收货</option>
                        </select>
                    </div>
                </form>
                <!-- 模态框 -->
                <div class="modal fade" id="confirm_modify">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>操作提示</h4>
                            </div>
                            <!-- 模态框主体 -->
                            <div class="modal-body">
                                <h5>是否确认修改订单状态</h5>
                            </div>
                            <!-- 模态框底部 -->
                            <div class="modal-footer">
                                <button type="button" id="confirm" class="btn btn-primary" data-dismiss="modal">确认修改</button>
                                <button type="button" id="dismiss" class="btn btn-secondary" data-dismiss="modal">取消</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $('#order_id').val('<?php echo $search_order->getOrderId() ?>');
            $('#order_code').val('<?php echo $search_order->getOrderCode() ?>');
            $('#total_price').val('<?php echo $search_order->getTotalPrice() ?>');
            $('#order_time').val('<?php echo $search_order->getOrderTime() ?>');
            $('#user_addr').val('<?php echo $search_order->getUserAddr() ?>');
            $('#user_phone').val('<?php echo $search_order->getUserPhone() ?>');
            //          $('#goods_id').val(search_order.goods_id);
            $('#order_state').val('<?php echo $search_order->getOrderState() ?>');
            $("#order_states").find("option[value = '" + $('#order_state').val() + "']").attr("selected", "selected");
        });
        $(function () {
            $('#order_states').bind("change", function () {
                $('#confirm_modify').modal('toggle');
            });
            $('#dismiss').click(function () {
                 $('#order_states').val($('#order_state').val());
            });
            $('#confirm').click(function () {
                var xmlhttp = new XMLHttpRequest();
                var order_state = $('#order_states option:selected').val();
                xmlhttp.open("POST", "../../controllers/orderController.php");
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("modify_order_state=1&order_state=" + order_state + "&order_id=<?php echo $search_order->getOrderId() ?>");
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        $('#order_state').val(order_state);
                        window.location.href = "order_item.php?order_id=" + $('#order_id').val();
                    }
                }
            });
        });
    </script>
    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
</body>
</html>
