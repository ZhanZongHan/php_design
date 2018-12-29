<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 上午1:59
 */

class Goods
{
    private $goods_id;
    private $goods_name;
    private $goods_stock;
    private $goods_price;
    private $goods_description;
    private $goods_primary_img_url;

    private $goods_class_id;

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

    /**
     * @return string
     */
    public function getGoodsName()
    {
        return $this->goods_name;
    }

    /**
     * @param string $goods_name
     */
    public function setGoodsName($goods_name)
    {
        $this->goods_name = $goods_name;
    }

    /**
     * @return int
     */
    public function getGoodsStock()
    {
        return $this->goods_stock;
    }

    /**
     * @param int $goods_stock
     */
    public function setGoodsStock($goods_stock)
    {
        $this->goods_stock = $goods_stock;
    }

    /**
     * @return float
     */
    public function getGoodsPrice()
    {
        return $this->goods_price;
    }

    /**
     * @param float $goods_price
     */
    public function setGoodsPrice($goods_price)
    {
        $this->goods_price = $goods_price;
    }

    /**
     * @return string
     */
    public function getGoodsDescription()
    {
        return $this->goods_description;
    }

    /**
     * @param string $goods_description
     */
    public function setGoodsDescription($goods_description)
    {
        $this->goods_description = $goods_description;
    }
    /**
     * @return string
     */
    public function getGoodsPrimaryImgUrl()
    {
        return $this->goods_primary_img_url;
    }

    /**
     * @param string $goods_primary_img_url
     */
    public function setGoodsPrimaryImgUrl($goods_primary_img_url)
    {
        $this->goods_primary_img_url = $goods_primary_img_url;
    }
    /**
     * @return int
     */
    public function getGoodsClassId()
    {
        return $this->goods_class_id;
    }

    /**
     * @param int $goods_class_id
     */
    public function setGoodsClassId($goods_class_id)
    {
        $this->goods_class_id = $goods_class_id;
    }

}