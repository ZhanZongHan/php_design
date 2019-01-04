<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午7:08
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/tools/UserPager.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/UserController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/getDatas.php');
$sessionTool = new SessionTool();
$userController = new UserController();
if (!$sessionTool->admin_session_validate())
    header("Location:../admin/admin_index.php");
isset($_GET['cur_page']) ? $cur_page = $_GET['cur_page'] : $cur_page = 1;
$pager = new UserPager($cur_page);
$from = 'show_all_users';
if ($sessionTool->isExist('users')) {
    $users = $sessionTool->getAttribute('users');
} else {
    $users = get_orders($cur_page);
}
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
                <li><a
                            href="../../controllers/orderController.php?type=show_all_orders&dst=admin/order.php"><i
                                class="fa fa-desktop"></i> 订单管理</a>
                </li>
                <li class="active"><a
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
            <div>
                <h1>用户管理
                    <small> 用户的跟进查看</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="admin_index.php"><i class="icon-dashboard"></i> 首页</a></li>
                    <li class="active"><i class="icon-file-alt"></i> 用户管理</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div>
                <div class="form-group">
                    <label>查询方式：</label>
                    <select name="search_way" id="search_way">
                        <option value="order_id" selected>订单id</option>
                        <option value="order_code">订单编码</option>
                        <option value="user_id">用户id</option>
                    </select>

                    <div class="form-group input-group">
                        <input type="text" class="form-control" id="search_input" required="required">
                        <span class="input-group-btn">
                  <button class="btn btn-default" type="button" id="order_search_button"><i
                              class="fa fa-search"></i></button>
                </span>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>用户id</th>
                    <th>用户名</th>
                    <th>电话号码</th>
                    <th>用户地址</th>
                    <th>用户邮箱</th>
                    <th>注册时间</th>
                    <th>最近登录时间</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?php echo $user->getUserId() ?></td>
                        <td><?php echo $user->getUsername() ?></td>
                        <td><?php echo $user->getTelephone() ?></td>
                        <td><?php echo $user->getAddress() ?></td>
                        <td><?php echo $user->getEmail() ?></td>
                        <td><?php echo $user->getRegisterTime() ?></td>
                        <td><?php echo $user->getLatestLoginTime() ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

            <ul class="pager">
                共<span class="pagination pagination-sm"><?php echo $pager->getTotalPage() ?></span>页
                <?php if ($pager->getCurPage() == 1) { ?>
                    <li>
                        <a href="../../controllers/userController.php?type=<?php echo $from ?>&dst=admin/user.php&cur_page=<?php if ($pager->getNextPage()) echo $cur_page + 1; else echo $pager->getTotalPage();
                        ?>">下一页</a>
                    </li>
                    <li>
                        <a href="../../controllers/userController.php?type=<?php echo $from ?>&dst=admin/user.php&cur_page=<?php echo $pager->getTotalPage();
                        ?>">尾
                            页</a>
                    </li>
                <?php } else if ($pager->getCurPage() == $pager->getTotalPage()) { ?>
                    <li>
                        <a href="../../controllers/userController.php?type=<?php echo $from ?>&dst=admin/user.php&cur_page=<?php echo 1;
                        ?>">首
                            页</a>
                    </li>
                    <li>
                        <a href="../../controllers/userController.php?type=<?php echo $from ?>&dst=admin/user.php&cur_page=<?php if ($pager->getPrevPage()) echo $cur_page - 1; else echo 1;
                        ?>">上一页</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a href="../../controllers/userController.php?type=<?php echo $from ?>&dst=admin/user.php&cur_page=<?php echo 1;
                        ?>">首
                            页</a>
                    </li>
                    <li>
                        <a href="../../controllers/userController.php?type=<?php echo $from ?>&dst=admin/user.php&cur_page=<?php if ($pager->getPrevPage()) echo $cur_page - 1; else echo 1;
                        ?>">上一页</a>
                    </li>
                    <li>
                        <a href="../../controllers/userController.php?type=<?php echo $from ?>&dst=admin/user.php&cur_page=<?php if ($pager->getNextPage()) echo $cur_page + 1; else echo $pager->getTotalPage();
                        ?>">下一页</a>
                    </li>
                    <li>
                        <a href="../../controllers/userController.php?type=<?php echo $from ?>&dst=admin/user.php&cur_page=<?php echo $pager->getTotalPage();
                        ?>">尾
                            页</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="http://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
        $(function () {
            $('#order_search_button').click(function () {
                $('#order_tbody').html('');
                var type = $('#search_way').val();
                var value = $('#search_input').val();
                if (value.length == 0) {
                    alert("输入不能为空！");
                    return;
                }
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.open("POST", "../../controllers/orderController.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("find_orders_type=find_orders_by_" + type + "&value=" + value);

                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        var search_orders = JSON.parse(xmlhttp.responseText);
                        sessionStorage.search_orders = search_orders;
                        $.each(search_orders, function () {
                            $('#order_tbody').append(
                                '<tr>' +
                                '<td>' +
                                '    <a href="../../controllers/orderController.php?type=find_order_and_item&dst=admin/order_item.php&order_id=' + this.order_id + '">' + this.order_id + '</a>' +
                                '</td>' +
                                '<td>' + this.order_code + '</td>' +
                                '<td>' + this.order_time + '</td>' +
                                '<td>' + this.order_state + '</td>' +
                                '<td>' + this.user_id + '</td>' +
                                '</tr>'
                            );
                        });
                        $('#order_search').modal('toggle');
                    }
                }
            });


        })
    </script>
    <!-- Page Specific Plugins -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
</body>
</html>