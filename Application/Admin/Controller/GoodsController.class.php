<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 11:11
 */

namespace Admin\Controller;


class GoodsController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->assign('sel_name','商品管理');
    }

    //商品的添加
    public function Goods_add()
    {
        $cate_info = M('category')->select();
        $this->assign('cate_info', $cate_info);
        $type_info = M('type')->select();
        $this->assign('type_info', $type_info);
        $titles = ['name' => '商品管理', 'sub' => '商品添加'];
        $this->assign('titles', $titles);

        if (!empty($_POST)) {
            //dump($_FILES);
           // dump($_POST);die;
            $goods = D('goods');
            //$data = $_POST;
            //dump($_POST);die;
            if ($goods->create()) {
                if ($goods->add()) {
                    $this->success('商品添加成功', 'goods_list');
                }
            } else {
                $goods->getError();
                $this->display("goods_add");
                die;
            }

        } else {

            $this->display("goods_add");
            die;
        }

    }

    //商品的展示
    public function Goods_list()
    {

        $goods_info = D('Goods')->goods_data();

        //dump($goods_info);
        //die;
        $this->assign('goods_info', $goods_info);
        $titles = ['name' => '商品管理', 'sub' => '商品列表'];
        $this->assign('titles', $titles);
        $this->display("goods_list");

    }

    //商品的删除
    public function Goods_del()
    {
        $id = I('get.id');
        $goods = D('goods');
        $goodsinfo = $goods->delete($id);
        //删除数据之前会调用钩子函数进行删除之前商品存储的图片
        if ($goodsinfo) {
            return status == 0;
        } else {
            return status == 1;
        }

    }

    //商品的修改
    public function Goods_edit()
    {   /*dump($_POST);
        echo "<hr>";
        dump($_GET);
        die;*/
        $titles = ['name' => '商品管理', 'sub' => '商品修改'];
        $this->assign('titles', $titles);
        $cate_info = M('category')->select();
        //dump($goods_info);
        $this->assign('cate_info', $cate_info);
        if (empty($_POST)) {
            $id = $_GET['id'];
            $goodsinfo = D('goods')->edit_goods_data($id);
            $type_info = D('type')->select();
            $cate_info = D('goods')->category_data();
            //dump( $cate_info);
            //dump($goodsinfo);
            //die;
            $this->assign('cate_info', $cate_info);
            $this->assign('goodsinfo', $goodsinfo);
            $this->assign('type_info', $type_info);
            $this->display("goods_edit");

            die;
        } else {
            //dump($_FILES);
            //die;
            $goods = D('goods');
            //进行判断之前的图片是否存在
            $goods->create();
            $res = $goods->save();
            if ($res >= 0) {
                $this->success('修改商品成功', U('goods_list'));
                die;
            } else {
                $goods->getError();
                $this->display("goods_edit");
                die;
            }

        }

    }

    //双击图片进行删除图片
    public function goods_ajax_del_pic()
    {
        $goods_id = I('post.id');
        $goods_pic = I('post.pic_path');
        //删除数据之前需要把原始图片也进行删除
        D('goods')->ajax_delete($goods_id, $goods_pic);
        //删除数据库里面的数据
        $del_info = M('goods_pic')->where(array('id' => $goods_id, 'goods_pic' => $goods_pic))->delete();
        //返回删除结果
        if ($del_info) {
            echo json_encode(array('static' => 1));
            die;
        } else {
            echo json_encode(array('static' => 0));
        }

    }


}