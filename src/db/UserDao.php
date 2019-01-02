<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 19-1-1
 * Time: 下午10:41
 */
include_once($_COOKIE['ABSPATH'] . '/src/db/DataBase.php');
include_once($_COOKIE['ABSPATH'] . '/src/beans/User.php');

class UserDao
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
    public function findUsers($where)
    {
        $sql = "select * from `user`";
        $i = 0;
        foreach ($where as $key => $val) {
            if ($i == 0)
                $sql = $sql . " where";
            else
                $sql = $sql . " and";
            switch ($key) {
                case 'user_id':
                    $sql = $sql . " " . $key . "=" . $where[$key];
                    break;
                case 'username' || 'password':
                    $sql = $sql . " " . $key . "='" . $where[$key] . "'";
                    break;
                default:
                    break;
            }
            $i++;
        }
        $this->db->query($sql);
        $rs = $this->db->getRs();
        $users = array();
        while ($row = $rs->fetch_array()) {
            $user = new User();
            $user->setUserId($row['user_id']);
            $user->setUsername($row['username']);
            $user->setEmail($row['email']);
            $user->setPassword($row['password']);
            $user->setAddress($row['address']);
            $user->setHeadIcon($row['head_icon']);
            $user->setTelephone($row['telephone']);
            $user->setRegisterTime($row['register_time']);
            $user->setLatestLoginTime($row['latest_login_time']);
            //更新登录时间
            $this->updateLoginTime($user->getUserId());
            array_push($users, $user);
        }
        return $users;
    }

    /**
     * @param array $user_attr
     * @return int 返回新注册用户的id
     */
    public function register($user_attr)
    {
        $sql = sprintf("insert into `user` (username, password, email, telephone,
              address, head_icon) values('%s','%s', '%s', '%s', '%s', '%s')",
            $user_attr['username'], $user_attr['password'], $user_attr['email'],
            $user_attr['telephone'], $user_attr['address'], $user_attr['head_icon']);
        $this->db->query($sql);
        return $this->db->getInsertId();
    }

    /**
     * @param int $user_id
     * @return bool 返回是否更新成功
     */
    public function updateLoginTime($user_id)
    {
        $timestamp = date("Y-m-d H:i:s");
        $sql = "update `user` set latest_login_time = '$timestamp' where admin_id = $user_id";
        $this->db->query($sql);
        return $this->db->getRs();
    }

    /**
     * @param array $user_attr
     * @return int
     */
    public function modifyUser($user_attr)
    {
        $sql = sprintf("update `user` set username='%s', password='%s', email='%s', telephone='%s',
              address='%s', head_icon='%s' where user_id = %d", $user_attr['user'], $user_attr['password'], $user_attr['email'],
            $user_attr['telephone'], $user_attr['address'], $user_attr['head_icon'], $user_attr['admin_id']);
        $this->db->query($sql);
        return $user_attr['admin_id'];
    }

    /**
     * @param string $username
     * @return int
     */
    function isExistUsername($username)
    {
        $sql = "select user_id from `user` where username='$username'";
        $this->db->query($sql);
        $rs = $this->db->getRs();
        if($row = $rs->fetch_array()) {
            return $row['user_id'];
        }
        return 0;
    }
}