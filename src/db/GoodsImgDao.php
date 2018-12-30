<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 上午9:54
 */
include_once($_COOKIE['ABSPATH'] . '/src/db/DataBase.php');
include_once($_COOKIE['ABSPATH'] . '/src/beans/GoodsImg.php');

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

    /**
     * @param array $where
     * @return array
     */
    public function findGoodsImgs($where)
    {
        $sql = "select * from `goods_img`";
        if (count($where) > 0) {
            $key = array_keys($where)[0];
            $sql = $sql . " where " . $key . "=" . $where[$key] . "";
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

    /**
     * @param array $goods_img_attr
     * @return int 返回新添加的goods_img_id
     */
    public function addGoodsImg($goods_img_attr)
    {
        $sql = sprintf("insert into `goods_img` (goods_img_url, goods_id) values ('%s',%d)",
            $goods_img_attr['goods_img_url'], $goods_img_attr['goods_id']);
        $this->db->query($sql);
        return $this->db->getInsertId();
    }
}