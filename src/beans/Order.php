<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午7:20
 */

class Order
{
    private $order_id;
    private $order_code;
    private $total_price;
    private $user_addr;
    private $user_phone;
    private $postcode;
    private $order_state;
    private $user_id;

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
     * @return string
     */
    public function getOrderCode()
    {
        return $this->order_code;
    }

    /**
     * @param string $order_code
     */
    public function setOrderCode($order_code)
    {
        $this->order_code = $order_code;
    }

    /**
     * @return float
     */
    public function getTotalPrice()
    {
        return $this->total_price;
    }

    /**
     * @param float $total_price
     */
    public function setTotalPrice($total_price)
    {
        $this->total_price = $total_price;
    }

    /**
     * @return string
     */
    public function getUserAddr()
    {
        return $this->user_addr;
    }

    /**
     * @param string $user_addr
     */
    public function setUserAddr($user_addr)
    {
        $this->user_addr = $user_addr;
    }

    /**
     * @return string
     */
    public function getUserPhone()
    {
        return $this->user_phone;
    }

    /**
     * @param string $user_phone
     */
    public function setUserPhone($user_phone)
    {
        $this->user_phone = $user_phone;
    }

    /**
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     * @return string
     */
    public function getOrderState()
    {
        return $this->order_state;
    }

    /**
     * @param string $order_state
     */
    public function setOrderState($order_state)
    {
        $this->order_state = $order_state;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

}