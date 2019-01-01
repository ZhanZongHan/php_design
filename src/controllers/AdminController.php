<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-31
 * Time: 下午12:41
 */
include_once($_COOKIE['ABSPATH'] . '/src/db/AdminDao.php');

class AdminController
{
    private $adminDao = null;

    public function __construct()
    {
        $this->adminDao = new AdminDao();
    }

    /**
     * @param array $admin_attr
     * @return array
     */
    public function findAdmins($admin_attr)
    {
        return $this->adminDao->findAdmins($admin_attr);
    }

    /**
     * @param array $admin_attr
     * @return int
     */
    public function register($admin_attr)
    {
        return $this->adminDao->register($admin_attr);
    }

    public function modifyAdmin($admin_attr)
    {
        return $this->adminDao->modifyAdmin($admin_attr);
    }
}