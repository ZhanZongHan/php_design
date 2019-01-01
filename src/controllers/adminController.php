<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-31
 * Time: 下午12:55
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/getDatas.php');
$sessionTool = new SessionTool();
isset($_GET['type']) ? $type = $_GET['type'] : $type = '';
isset($_GET['dst']) ? $dst = $_GET['dst'] : $dst = '';
if (isset($_POST['login_submit'])) {
    $admin_name = $_POST['username'];
    $password = $_POST['password'];
    $admins = get_admins_by_adname_and_psword($admin_name, $password);
    $dst = $_POST['dst'];
    if (count($admins) > 0) {
        if ($_POST['remember_password']=='true') {
            setcookie("username", $admin_name, time()+60*60*24);
            setcookie("password", $password, time()+60*60*24);
        }
        $admin = $admins[0];
        $sessionTool->admin_login();
        $sessionTool->setAttribute("admin", $admin);
        //header("Location:../views/$dst");
        echo 1;
    } else
        //header("Location:../views/login/admin_login.php");
        echo -1;
} else if ($type=='logout') {
    $sessionTool->admin_logout();
    $sessionTool->unsetAttribute('admin');
    header("Location:../views/$dst");
}