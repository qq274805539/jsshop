<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 11:11
 */

namespace Admin\Controller;




class PrivilegeController extends BaseController
{
    //分类添加
    public function Privilege_add()
    {
        $titles = ['name' => '权限管理', 'sub' => '权限添加'];
        $this->assign('titles', $titles);
        if (IS_POST) {
            /* dump($_POST);
             die;*/
            $privilege = D('privilege');

            //$data = $_POST;
            if ($privilege->create()) {
                if ($privilege->add()) {
                    $this->success('权限添加成功', 'privilege_list');
                    die;
                }
            } else {
                $privilege->getError();
                $this->display("privilege_add");
                die;
            }

        } else {
            $pri_info = D('privilege')->getData();
            $this->assign('pri_info', $pri_info);
            $this->display("privilege_add");
            die;
        }

    }

    //分类展示
    public function privilege_list()
    {
        $titles = ['name' => '权限管理', 'sub' => '权限列表'];
        $this->assign('titles', $titles);
        $privilege = D('privilege');
//        dump($privilege instanceof \Admin\Model\privilegeModel);
        $pri_info = $privilege->getData();
       // $pri_info = $privilege->select();
        $this->assign('pri_info', $pri_info);
        $a=$privilege->getLastSql();
        //dump($a);
        // dump($pri_info);die;
        $this->display("privilege_list");

    }

    //分类修改
    public function privilege_edit()
    {
        $titles = ['name' => '权限管理', 'sub' => '权限修改'];
        $this->assign('titles', $titles);
        if (IS_GET) {
            $privilege = M('privilege');
            $id = $_GET['pri_id'];
            $pri_info = D('privilege')->getData();
            $this->assign('pri_info', $pri_info);
            $privilege_info = $privilege->find($id);
            $this->assign('privilege_info', $privilege_info);
            //$parent_info =$privilege->select();
            //$this->assign('parent_info', $parent_info);
            //dump($privilege_info);die;
            $this->display("privilege_edit");
            die;
        }
        if (IS_POST) {
            //dump($_FILES);
            $privilege = M('privilege');
                       $data = $_POST;
                        //dump( $_POST);die;

            if ($privilege->create()) {
                if(  $privilege->save()){

                    $this->success('权限修改成功', U('Privilege/privilege_list'),1);
                    //$this->success('权限修改成功', '/index.php/Admin/Privilege/privilege_list',1);
                    die;
                }
            } else {
                $privilege->getError();
                $this->display("privilege_edit");
                die;
            }

        } else {
            $this->display("privilege_edit");
            die;
        }

}

//分类删除
public
function privilege_del()
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