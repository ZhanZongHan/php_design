<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-31
 * Time: 上午11:53
 */

class Admin
{
    private $admin_id;
    private $admin_name;
    private $password;
    private $email;
    private $register_time;
    private $latest_login_time;

    /**
     * @return int
     */
    public function getAdminId()
    {
        return $this->admin_id;
    }

    /**
     * @param int $admin_id
     */
    public function setAdminId($admin_id)
    {
        $this->admin_id = $admin_id;
    }

    /**
     * @return string
     */
    public function getAdminName()
    {
        return $this->admin_name;
    }

    /**
     * @param string $admin_name
     */
    public function setAdminName($admin_name)
    {
        $this->admin_name = $admin_name;
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