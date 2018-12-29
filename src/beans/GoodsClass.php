<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-29
 * Time: 上午2:04
 */

class GoodsClass
{
    private $goods_class_id;
    private $goods_class_name;

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

    /**
     * @return string
     */
    public function getGoodsClassName()
    {
        return $this->goods_class_name;
    }

    /**
     * @param string $goods_class_name
     */
    public function setGoodsClassName($goods_class_name)
    {
        $this->goods_class_name = $goods_class_name;
    }
}