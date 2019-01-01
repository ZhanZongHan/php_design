<?php
$username = '';
$password = '';
if (isset($_COOKIE['username']) and isset($_COOKIE['password'])) {
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel='stylesheet' type='text/css'/>

    <script src="js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="main">
    <div class="login">
        <h1>商城后台管理系统</h1>
        <div class="inset">
            <!--start-main-->
            <div>
                <h2>管理员登录</h2>
                <span><label>用户名</label></span>
                <span><input type="text" id="username" class="textbox"></span>
            </div>
            <div>
                <span><label>密码</label></span>
                <span><input type="password" id="password" class="password alert alert-danger"></span>
            </div>
            <div class="sign">
                <input type="button" value="登录" class="submit" onclick="login()"/>
                &nbsp;
                <span>
					<input name="remember_password" type="checkbox" style="margin-bottom: -1.5px;">
				</span>
                <span style="color:#000000">
					记住密码&emsp;&emsp;&emsp;&emsp;
				</span>
            </div>
            <input type="hidden" id="dst" name="dst" value="admin/admin_index.php">
        </div>
    </div>
    <!--//end-main-->
</div>
<script>
    function login() {
        var xmlhttp;
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var dst = document.getElementById("dst").value;
        var remember_password = document.getElementsByName("remember_password")[0];
        if (username.length == 0 || password.length == 0) {
            alert("请输入用户名和密码！");
            return;
        }
        xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == "1") {
                    window.location.href = "../" + dst;
                } else {
                    alert("用户名或密码输入有误，请重新输入！");
                    $('#username').addClass('alert alert-danger');
                    $('#password').addClass('alert alert-danger');
                }
            }
        };
        xmlhttp.open("POST", "../../controllers/adminController.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("username=" + username + "&password=" + password + "&dst=" + dst + "&login_submit=1&remember_password=" + remember_password.checked);
    }
</script>
</body>
</html>