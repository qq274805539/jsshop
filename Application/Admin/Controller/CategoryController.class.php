<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 11:11
 */

namespace Admin\Controller;


class CategoryController extends BaseController
{
    //分类添加
    public function category_add()
    {
        $titles = ['name' => '分类管理', 'sub' => '分类添加'];
        $this->assign('titles', $titles);
        if (IS_POST) {
            //dump($_POST);
            //die;
            $category = D('category');
            //$data = $_POST;
            if ($category->create()) {
                if ($category->add()) {
                    $this->success('分类添加成功', 'category_list');
                }
            } else {
                $category->getError();
                $this->display("category_add");
                die;
            }

        } else {
            $cate_info = D('category')->getData();
            $this->assign('cate_info', $cate_info);
            $this->display("category_add");
            die;
        }

    }

    //分类展示
    public function category_list()
    {
        $titles = ['name' => '分类管理', 'sub' => '分类列表'];
        $this->assign('titles', $titles);
        $category = D('Category');
//        dump($category instanceof \Admin\Model\CategoryModel);
        $cate_info = $category->getData();
        $this->assign('cate_info', $cate_info);
        $this->display("category_list");

    }

    //分类修改
    public function category_edit()
    {
        $titles = ['name' => '分类管理', 'sub' => '分类修改'];
        $this->assign('titles', $titles);
        if (IS_GET) {
            $category = M('category');
            $id = $_GET['cate_id'];
            $category_info = $category->find($id);
            $cate_info =$category->select();
            $this->assign('cate_info', $cate_info);
            $this->assign('category_info', $category_info);

            $this->display("category_edit");
            die;
        }
        if (IS_POST) {
            //dump($_FILES);
            $category = M('category');
            //$data = $_POST;
            if ($category->create()) {
                if ($category->save()) {
                    $this->success('修改成功', 'category_list');
                    die;
                }
            } else {
                $category->getError();
                $this->display("category_edit");
                die;
            }

        } else {

            $this->display("category_edit");
            die;
        }

    }

    //分类删除
    public function category_del()
    {
        $goods = D('goods');
        $id = I('get.id');
        $goodsinfo = $goods->delete($id);
        if ($goodsinfo) {
            return status == 0;
        } else {
            return status == 1;
        }

    }


}