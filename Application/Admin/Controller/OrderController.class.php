<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/6
 * Time: 20:52
 */

namespace Admin\Controller;


class OrderController extends BaseController
{

    /**
     * 展示订单的所有信息
     */

    public function order_list()
    {
        $titles = ['name' => '订单管理', 'sub' => '订单展示'];
        $this->assign('titles', $titles);

        $orderinfo = M('order')
                    ->alias('a')
                    ->join('__ADDRESS__ b ON a.user_id=b.user_id  AND  a.cgn_id=b.cgn_id')
                    ->field('a.*,b.cgn')
                    ->select();
        //$a=M('order')->getLastSql();
       // dump($a);
        //dump($orderinfo);die;
        $this->assign('orderinfo', $orderinfo);
        $this->display();
    }

    /**
     * 展示订单的详情页
     */

    public function order_detail(){
        $titles = ['name' => '订单管理', 'sub' => '订单详情'];
        $this->assign('titles', $titles);
        $order_id=I('get.order_id');
        //$order_id=2;

        $orderinfo = M('order')->alias('a')
            ->join('__ADDRESS__ b ON a.user_id=b.user_id  AND  a.cgn_id=b.cgn_id')
            ->field('a.*,b.cgn')
            ->find($order_id);
        $a=M('order')->getLastSql();
       // dump($a);die;
        $this->assign('orderinfo', $orderinfo);
       // dump($orderinfo);die;
        //将商品关联起来的的商品进行展示
        $ordergoods=M('OrderGoods')->alias('a')->where(array('order_id'=>$order_id))
                    ->join('__GOODS__  b  ON a.goods_id=b.id')
                    ->field('a.*,b.goods_name')
                    ->select();

        //$a=M('OrderGoods')->getLastSql();
        //dump($a);
        //dump($ordergoods);die;

        $this->assign('ordergoods', $ordergoods);


        $this->display();

    }

    /**
     * 将订单信息进行输出到excel表格里
     */

    public function putexcel(){
        header("Content-type:application/octet-stream");
        header("Accept-Ranges:bytes");
        header("Content-type:application/vnd.ms-excel");
        header("Content-Disposition:attachment;filename=dingdan_".time().".xls");//设置文件名
        header("Pragma: no-cache");
        header("Expires: 0");
        //导出xls 开始
        $title = array('订单号','总金额','是否付款','是否发货','下单时间');//表头
        if (!empty($title)){
            foreach ($title as $k => $v) {
                $title[$k]=iconv("UTF-8", "GB2312",$v);
            }
            $title= implode("\t", $title);
            echo "$title\n";
        }

        //从数据库查询到的二维数组
        $data = M('order')->field('order_number,order_price,order_pay,is_send,add_time')->select();
        //$data = array(array(1,2,3,4,5),array('a','b','c','e','f'));//取出数据
        if (!empty($data)){
            foreach($data as $key=>$val){
                foreach ($val as $ck => $cv) {
                    //将utf8的编码进行转化为GB2312的编码
                    $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
                    //将时间戳转化为普通的时间,
                    if($ck=='add_time'){
                        $data[$key][$ck]=date('Y-m-d H:i:s', $data[$key][$ck]);
                    }
                }
                $data[$key]=implode("\t", $data[$key]);

            }
            echo implode("\n",$data);
            die;
        }

    }















}