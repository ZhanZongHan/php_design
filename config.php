<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午11:54
 */
define('ABSPATH', dirname(__FILE__));
setrawcookie('ABSPATH', ABSPATH, time()+3600);
header("Location:src/views/admin/admin_index.html");