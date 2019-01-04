<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 19-1-2
 * Time: 下午2:27
 */
include_once($_COOKIE['ABSPATH'] . '/src/tools/SessionTool.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/UserController.php');
include_once($_COOKIE['ABSPATH'] . '/src/controllers/getDatas.php');
$sessionTool = new SessionTool();
$userController = new UserController();
isset($_GET['type']) ? $type = $_GET['type'] : $type = '';
isset($_GET['dst']) ? $dst = $_GET['dst'] : $dst = '';
if (isset($_POST['login_submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users = get_users_by_usname_and_psword($username, $password);
    //   $dst = $users['dst'];
    if (count($users) > 0) {
        if ($_POST['remember_password'] == 'true') {
            setcookie("username", $username, time() + 60 * 60 * 24, "/");
            setcookie("password", $password, time() + 60 * 60 * 24, "/");
        } else {
            setcookie("username", $username, time() - 60 * 60 * 24, "/");
            setcookie("password", $password, time() - 60 * 60 * 24, "/");
        }
        $user = $users[0];
        $sessionTool->user_login();
        $sessionTool->setAttribute("user", $user);
        //header("Location:../views/$dst");
        echo 1;
    } else
        //header("Location:../views/login/admin_login.php");
        echo -1;
} else if ($type == 'logout') {
    $sessionTool->user_logout();
    $sessionTool->unsetAttribute('user');
    header("Location:../views/$dst");
} else if (isset($_POST['username_validate'])) {
    $username = $_POST['username'];
    echo $userController->isExistUsername($username);
} else if (isset($_POST['register'])) {
    $user_attr['username'] = $_POST['username'];
    $user_attr['password'] = $_POST['password'];
    $user_attr['telephone'] = $_POST['telephone'];
    $user_attr['email'] = $_POST['email'];
    $user_attr['head_icon'] = $_POST['head_icon'];
    $user_attr['address'] = $_POST['address'];

    echo $userController->register($user_attr);
} else if ($type == "show_all_users") {
    isset($_GET['cur_page']) ? $cur_page = $_GET['cur_page'] : $cur_page = 1;
    $users = get_users($cur_page);
    $sessionTool->setAttribute('users', $users);
    header("Location:../views/$dst?cur_page=$cur_page");
} else if ($type == "delete_user"){
    $user_id = $_GET['user_id'];
    $userController->deleteUser($user_id);
    header("Location:../views/$dst");
} else if (isset($_POST['modify'])) {
    $user_attr['user_id'] = $_POST['user_id'];
    $user_attr['telephone'] = $_POST['telephone'];
    $user_attr['email'] = $_POST['email'];
    $user_attr['head_icon'] = $_POST['head_icon'];
    $user_attr['address'] = $_POST['address'];
    echo $userController->modifyUser($user_attr);
}