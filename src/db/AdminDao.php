<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-31
 * Time: 上午11:39
 */
include_once($_COOKIE['ABSPATH'] . '/src/db/DataBase.php');
include_once($_COOKIE['ABSPATH'] . '/src/beans/Admin.php');

class AdminDao
{
    private $db = null;

    public function __construct()
    {
        $this->db = new DataBase();
    }

    /**
     * @param array $where
     * @return array
     */
    public function findAdmins($where)
    {
        $sql = "select * from `admin`";
        $i = 0;
        foreach ($where as $key => $val) {
            if ($i == 0)
                $sql = $sql . " where";
            else
                $sql = $sql . " and";
            switch ($key) {
                case 'admin_id':
                    $sql = $sql . " ".$key . "=" . $where[$key];
                    break;
                case 'admin_name' || 'password':
                    $sql = $sql . " " . $key . "='" . $where[$key] . "'";
                    break;
                default:
                    break;
            }
            $i++;
        }
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $admins = array();
        while ($row = $rs->fetch_array()) {
            $admin = new Admin();
            $admin->setAdminId($row['admin_id']);
            $admin->setAdminName($row['admin_name']);
            $admin->setEmail($row['email']);
            $admin->setPassword($row['password']);
            $admin->setRegisterTime($row['register_time']);
            $admin->setLatestLoginTime($row['latest_login_time']);
            //更新登录时间
            $this->updateLoginTime($admin->getAdminId());
            array_push($admins, $admin);
        }
        return $admins;
    }

    /**
     * @param array $admin_attr
     * @return int 返回新注册管理员的id
     */
    public function register($admin_attr)
    {
        $sql = sprintf("insert into `admin` (admin_name, password, email, ) 
              values ('%s','%s','%s')", $admin_attr['admin_name'], $admin_attr['password'], $admin_attr['email']);
        $this->db->query($sql);
        return $this->db->getInsertId();
    }

    /**
     * @param int $admin_id
     * @return bool 返回是否更新成功
     */
    public function updateLoginTime($admin_id)
    {
        $timestamp = date("Y-m-d H:i:s");
        $sql = "update `admin` set latest_login_time = '$timestamp' where admin_id = $admin_id";
        $this->db->query($sql);
        return $this->db->getRs();
    }

    /**
     * @param array $admin_attr
     * @return int
     */
    public function modifyAdmin($admin_attr)
    {
        $sql = sprintf("update `admin` set admin_name='%s', password='%s', email='%s'
          where admin_id = %d", $admin_attr['admin_name'], $admin_attr['password'], $admin_attr['email'],
            $admin_attr['admin_id']);
        $this->db->query($sql);
        return $admin_attr['goods_id'];
    }
}