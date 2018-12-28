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
        session_start();
    }

    public function admin_session_validate()
    {
        return $_SESSION['ADMIN_LOGIN_SUCCESS'];
    }

    public function user_session_validate()
    {
        return $_SESSION['USER_LOGIN_SUCCESS'];
    }

    public function admin_login()
    {
        $_SESSION['ADMIN_LOGIN_SUCCESS'] = true;
    }

    public function admin_logout()
    {
        $_SESSION['ADMIN_LOGIN_SUCCESS'] = false;
    }

    public function user_login()
    {
        $_SESSION['USER_LOGIN_SUCCESS'] = true;
    }

    public function user_logout()
    {
        $_SESSION['USER_LOGIN_SUCCESS'] = false;
    }
}