<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午11:54
 */
define('ABSPATH', dirname(__FILE__));
define('GOODS_IMG_PART_PATH', '../../../uploads/goods_img/');
setrawcookie('ABSPATH', ABSPATH, time()+60*60*24, "/");
setrawcookie('GOODS_IMG_PART_PATH', GOODS_IMG_PART_PATH, time()+60*60*24*7, "/");
header("Location:src/views/admin/admin_index.php");