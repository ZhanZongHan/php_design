<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 上午9:43
 */
include_once ($_COOKIE['ABSPATH'].'/src/db/GoodsDao.php');
include_once ($_COOKIE['ABSPATH'].'/src/db/GoodsClassDao.php');
include_once ($_COOKIE['ABSPATH'].'/src/db/GoodsImgDao.php');
class GoodsController
{
    private $goodsDao = null;
    private $goodsClassDao = null;
    private $goodsImgDao = null;

    /**
     * GoodsController constructor.
     */
    public function __construct()
    {
        $this->goodsDao = new GoodsDao();
        $this->goodsClassDao = new GoodsClassDao();
        $this->goodsImgDao = new GoodsImgDao();
    }


    /**
     * @param array $where
     * @return array
     */
    public function findGoodses($where) {
        return $this->goodsDao->findGoodses($where);
    }

    /**
     * @param array $where
     * @return array
     */
    public function findGoodsClasses($where) {
        return $this->goodsClassDao->findGoodsClasses($where);
    }

    /**
     * @param array $where
     * @return array
     */
    public function findGoodsImgs($where) {
        return $this->goodsImgDao->findGoodsImgs($where);
    }

    /**
     * @param array $goods_attr
     * @return int 返回goods_id
     */
    public function addGoods($goods_attr) {
        return $this->goodsDao->addGoods($goods_attr);
    }

    /**
     * @param array $goods_class_attr
     */
    public function addGoodsClass($goods_class_attr) {

    }

    /**
     * @param array $goods_img_attr
     */
    public function addGoodsImg($goods_img_attr) {
        return $this->goodsImgDao->addGoodsImg($goods_img_attr);
    }

    /**
     * @param int $goods_id
     * @return bool
     */
    public function deleteGoods($goods_id) {
        return $this->goodsDao->deleteGoods($goods_id);
    }

    /**
     * @param int $goods_class_id
     */
    public function deleteGoodsClass($goods_class_id) {
        // 删除分类时，要将这分类下的商品的分类号修改为-1
        // 或者，设计成商品也全部删除
    }

    /**
     * @param int $goods_img_id
     */
    public function deleteGoodsImg($goods_img_id) {
        // 删除分类时，要将这分类下的商品的分类号修改为-1
        // 或者，设计成商品也全部删除
    }

    /**
     * @param int $goods_attr
     */
    public function modifyGoods($goods_attr) {
        return $this->goodsDao->modifyGoods($goods_attr);
    }

    /**
     * @param int $goods_class_attr
     */
    public function modifyGoodsClass($goods_class_attr) {

    }
}