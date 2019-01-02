<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午10:33
 */

class SessionTool
{
    public function __construct()
    {
        if(!session_id()) session_start();
    }

    /**
     * @return bool 管理员是否登录
     */
    public function admin_session_validate()
    {
        return $_SESSION['ADMIN_LOGIN_SUCCESS'];
    }

    /**
     * @return bool 用户是否登录
     */
    public function user_session_validate()
    {
        return $_SESSION['USER_LOGIN_SUCCESS'];
    }

    /**
     * 管理员登录
     */
    public function admin_login()
    {
        $_SESSION['ADMIN_LOGIN_SUCCESS'] = true;
    }

    /**
     * 管理员注销
     */
    public function admin_logout()
    {
        $_SESSION['ADMIN_LOGIN_SUCCESS'] = false;
    }

    /**
     * 用户登录
     */
    public function user_login()
    {
        $_SESSION['USER_LOGIN_SUCCESS'] = true;
    }

    /**
     * 用户注销
     */
    public function user_logout()
    {
        $_SESSION['USER_LOGIN_SUCCESS'] = false;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setAttribute($name, $value) {
        $_SESSION[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getAttribute($name) {
        return $_SESSION[$name];
    }

    /**
     * @param string $name
     * 在session中删除键值
     */
    public function unsetAttribute($name) {
        unset($_SESSION[$name]);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isExist($name) {
        return isset($_SESSION[$name]);
    }
}