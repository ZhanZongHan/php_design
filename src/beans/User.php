<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 19-1-1
 * Time: 下午6:38
 */

class User
{
    private $user_id;
    private $username;
    private $password;
    private $telephone;
    private $address;
    private $email;
    private $head_icon;
    private $register_time;
    private $latest_login_time;

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

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getHeadIcon()
    {
        return $this->head_icon;
    }

    /**
     * @param string $head_icon
     */
    public function setHeadIcon($head_icon)
    {
        $this->head_icon = $head_icon;
    }

    /**
     * @return string
     */
    public function getRegisterTime()
    {
        return $this->register_time;
    }

    /**
     * @param string $register_time
     */
    public function setRegisterTime($register_time)
    {
        $this->register_time = $register_time;
    }

    /**
     * @return string
     */
    public function getLatestLoginTime()
    {
        return $this->latest_login_time;
    }

    /**
     * @param string $latest_login_time
     */
    public function setLatestLoginTime($latest_login_time)
    {
        $this->latest_login_time = $latest_login_time;
    }


}