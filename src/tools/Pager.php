<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-28
 * Time: 下午8:17
 */

abstract class Pager
{
    protected $cur_page;  // 当前页数，默认首页
    protected $total_page; // 总页数

    abstract protected function getCounts($where);    // 从数据库里获得总数，仅在构造方法里执行一次

    public function getNextPage()
    {
        if ($this->cur_page + 1 > $this->total_page) {
            return false;
        } else {
            return true;
        }
    }

    public function getPrevPage()
    {
        if ($this->cur_page - 1 < 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getHomePage()
    {
        $this->cur_page = 1;
        return $this->cur_page;
    }

    public function getTailPage()
    {
        $this->cur_page = $this->total_page;
        return $this->cur_page;
    }

    /**
     * @return mixed
     */
    public function getCurPage()
    {
        return $this->cur_page;
    }

    /**
     * @return mixed
     */
    public function getTotalPage()
    {
        return $this->total_page;
    }
}