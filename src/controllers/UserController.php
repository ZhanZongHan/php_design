<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 19-1-1
 * Time: 下午11:24
 */
include_once($_COOKIE['ABSPATH'] . '/src/db/UserDao.php');

class UserController
{
    private $userDao = null;

    public function __construct()
    {
        $this->userDao = new UserDao();
    }

    /**
     * @param array $user_attr
     * @return array
     */
    public function findUsers($user_attr)
    {
        return $this->userDao->findUsers($user_attr);
    }

    /**
     * @param array $user_attr
     * @return int
     */
    public function register($user_attr)
    {
        return $this->userDao->register($user_attr);
    }

    /**
     * @param array $user_attr
     * @return int
     */
    public function modifyUser($user_attr)
    {
        return $this->userDao->modifyUser($user_attr);
    }

    /**
     * @param string $username
     * @return int
     */
    public function isExistUsername($username)
    {
        return $this->userDao->isExistUsername($username);
    }
}