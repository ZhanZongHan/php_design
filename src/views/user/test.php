<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 19-1-3
 * Time: 下午1:35
 */

//$products = json_decode(file_get_contents("php://input"), true);
//$products = file_get_contents("php://input");
//$data = json_decode($products, true);
$d = '[{
	"id": 8,
	"name": "猪肉脯",
	"summary": "这是一款非常否好吃的猪肉脯",
	"price": 16,
	"quantity": 1,
	"image": "../../../uploads/goods_img/314c2b6736d53177f67116cc3d538fcd.jpg"
}, {
	"id": 9,
	"name": "营养快线",
	"summary": "能够给人带来营养的营养快线",
	"price": 5,
	"quantity": 1,
	"image": "../../../uploads/goods_img/db3fdf1acd123d5f8eb05a987ddd7987.jpg"
}]';
$data = json_decode($d, true);
var_dump($data);
echo "<br>";
var_dump(json_decode(json_decode(file_get_contents("php://input")), true));
//var_dump($products);
/*foreach ($products as $product) {
   /* $p = array($product);
    foreach ($p as $item) {
        print_r($item);
        echo "<br>";
    }
    print_r($product);
    echo "<br>";
}*/
?>
