<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 19-1-4
 * Time: 上午12:24
 */

class OrderItem
{
    private $order_item_id;
    private $buy_num;
    private $order_id;
    private $goods_id;

    /**
     * @return int
     */
    public function getOrderItemId()
    {
        return $this->order_item_id;
    }

    /**
     * @param int $order_item_id
     */
    public function setOrderItemId($order_item_id)
    {
        $this->order_item_id = $order_item_id;
    }

    /**
     * @return int
     */
    public function getBuyNum()
    {
        return $this->buy_num;
    }

    /**
     * @param int $buy_num
     */
    public function setBuyNum($buy_num)
    {
        $this->buy_num = $buy_num;
    }

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param int $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
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