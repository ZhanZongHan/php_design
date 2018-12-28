<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午7:39
 */

class DataBase
{
    private $host = '127.0.0.1';
    private $port = '3306';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8';
    private $dbname = 'php_design_db';
    private $conn;
    private $rs;

    public function __construct()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        $this->conn->set_charset($this->charset);
    }

    public function getRs()
    {
        return $this->rs;
    }

    public function setRs($rs)
    {
        $this->rs = $rs;
    }

    // 执行sql语句
    public function query($sql)
    {
        $this->setRs($this->conn->query($sql));
    }

    // 返回结果集中行的数量
    public function getNumRows()
    {
        return $this->rs->num_rows;
    }

    public function close()
    {
        $this->close();
    }
}