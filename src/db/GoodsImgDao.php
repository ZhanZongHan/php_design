<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 上午9:54
 */
include_once($_COOKIE['ABSPATH'].'/src/db/DataBase.php');
include_once($_COOKIE['ABSPATH'].'/src/beans/GoodsImg.php');
class GoodsImgDao
{
    private $db = null;

    /**
     * GoodsImgDao constructor.
     */
    public function __construct()
    {
        $this->db = new DataBase();
    }


    // 根据goods_id来获取商品的组图
    public function findAllGoodsClasses($where) {
        $sql = "select * from `goods_class`";
        if (count($where) > 0) {
            $key = array_keys($where)[0];
            $sql = $sql." where ".$key."='".$where[$key]."'";
        }
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $goods_imgs = array();
        while ($row = $rs->fetch_array()) {
            $goods_img = new GoodsImg();
            $goods_img->setGoodsImgId($row['goods_img_id']);
            $goods_img->setGoodsImgUrl($row['goods_img_url']);
            $goods_img->setGoodsId($row['goods_id']);
            array_push($goods_imgs, $goods_img);
        }
        return $goods_imgs;

    }
}