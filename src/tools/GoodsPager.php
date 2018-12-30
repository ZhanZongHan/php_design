<?php
/**
 * Created by PhpStorm.
 * User: zzh
 * Date: 18-12-31
 * Time: 上午1:08
 */
include_once($_COOKIE['ABSPATH'] . '/src/controllers/GoodsController.php');
include_once($_COOKIE['ABSPATH'] . '/src/tools/Pager.php');

class GoodsPager extends Pager
{
    private static $counts;    //总数据数
    public static $page_size = 2;     //每页显示的数据数量

    public function __construct($cur_page)
    {
        self::$counts = $this->getCounts();
        $this->total_page = ceil(self::$counts / self::$page_size);
        $this->cur_page = $cur_page;
    }

    public function getCounts()
    {
        return (new GoodsController())->getCounts();
    }
}