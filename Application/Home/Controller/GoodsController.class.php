<?php

namespace Home\Controller;

use Think\Controller;

class GoodsController extends Controller
{
    /**
     * 展示商品的详细信息
     */

    public function detail()
    {
        //进行查询商品的详细信息
        $data = I('get.id');
        $goodsinfo = M('goods')
            //->alias('a')
            ->where(array('id' => $data))
            //->join('__GOODS_PIC__ b ON a.id=b.goods_id')
            ->find();
        $this->assign('goodsinfo', $goodsinfo);
       // dump($goodsinfo);die;
        //进行查询该商品的相册信息
        $goodspic = M('goods_pic')
            ->where(array('goods_id' => $data))
            ->select();
        $this->assign('goodspic', $goodspic);
       // dump($goodspic);die;


        //进行查询该商品的唯一属性
        $weiyi_goods_attr = M('goods_attribute')
            ->alias('a')
            ->join("__ATTRIBUTE__ b ON a.attribute_id = b.id")
            ->where(array('a.goods_id' => $data, 'b.attribute_type' => '唯一'))
            ->field('b.attribute_name,a.attribute_value')
            ->select();
        //dump($weiyi_goods_attr);die;
        $this->assign('weiyi_goods_attr',$weiyi_goods_attr);

        //进行查询商品的多选属性
        $duo_goods_attr = M('goods_attribute')
            ->alias('a')
            ->join("__ATTRIBUTE__ b ON a.attribute_id = b.id")
            ->where(array('a.goods_id' => $data, 'b.attribute_type' => '可选'))
            ->field('b.attribute_name,a.attribute_value')
            ->select();
        foreach ($duo_goods_attr as  $k=>$v){
            foreach($v as $k1=>$v1){
                if ($k1=='attribute_value'){
                    $v1=explode(',', $v1);
                    //dump( $v1);
                    $duo_goods_attr[$k]['attribute_value']=$v1;
                    //echo "<br>";
                    //$v[$k]['attribute_value']=$v1;
                   //dump($v[$k]);
                }

            }

        }

       // dump($duo_goods_attr);die;
        $this->assign('duo_goods_attr',$duo_goods_attr);
        $this->display();

    }


    /**
     * 展示商品列表
     */

    public function goodslist()
    {
        $goodsinfo = D('goods')->select();
        $this->assign('goodsinfo', $goodsinfo);
        $this->display();
    }


}