<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 上午9:53
 */

class GoodsImg
{
    private $goods_img_id;
    private $goods_img_url;
    private $goods_id;

    /**
     * @return int
     */
    public function getGoodsImgId()
    {
        return $this->goods_img_id;
    }

    /**
     * @param int $goods_img_id
     */
    public function setGoodsImgId($goods_img_id)
    {
        $this->goods_img_id = $goods_img_id;
    }

    /**
     * @return string
     */
    public function getGoodsImgUrl()
    {
        return $this->goods_img_url;
    }

    /**
     * @param string $goods_img_url
     */
    public function setGoodsImgUrl($goods_img_url)
    {
        $this->goods_img_url = $goods_img_url;
    }

    /**
     * @return int
     */
    public function getGoodsId()
    {
        return $this->goods_id;
    }

    /**
     * @param int $goods_id
     */
    public function setGoodsId($goods_id)
    {
        $this->goods_id = $goods_id;
    }

}