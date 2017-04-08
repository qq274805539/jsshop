<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 11:11
 */

namespace Admin\Controller;

class AdminController extends BaseController
{   //管理员添加
    public function admin_add()
    {
        if (IS_POST) {
            $data = I('post.');
            $user = D('Admin');
            //将接受到的角色通过'，'进行拼接
            $data['role_ids']=implode(',',$data['role_ids']);
         /*   dump($data);
            die;*/
            $user->create($data);
            $info = $user->add();
            if ($info) {
                $this->success('管理员添加成功', 'admin_list');
            } else {
                $this->error('管理员添加失败', 'admin_add');
            }
        } else {
            $titles = ['name' => '管理员管理', 'sub' => '管理员添加'];
            $this->assign('titles', $titles);
            $role_info=D('admin')->admin_role_info();
            //dump($role_info);
            //die;
            $this->assign('role_info',$role_info);
            $this->display("admin_add");
        }

    }
    //管理员用户展示
    public function admin_list()
    {
        $titles = ['name' => '管理员管理', 'sub' => '商管理员列表'];
        $this->assign('titles', $titles);
        $admin_info = M('admin')->select();
      /*  dump($admin_info);
        foreach ($admin_info as $k=>$v) {
        $roleinfo[$k]['roles'] = M('Role')->where(array('id'=>in_array('in',$v['role_ids'])))->getField("group_concat('role_name')");
        }*/
        //$a=D('role')->getLastSql();

        $this->assign('admin_info', $admin_info);
        $this->display("admin_list");
    }
    //管理员修改
    public function admin_edit()
    {
        $titles = ['name' => '管理员管理', 'sub' => '信息修改'];
        $this->assign('titles', $titles);
        if(empty($_POST)){
            $id=$_GET['id'];
            $admin_info = D('admin') ->get_admin_editinfo($id);

            $admin_info['role_ids']=explode(',',$admin_info['role_ids']);
         /*   dump($admin_info);
            die;*/
            $role_info=D('admin')->admin_role_info();
            $this->assign('role_info',$role_info);

            $this->assign('admin_info', $admin_info);
            $this->display("admin_edit");
        }else{
            $logo=$_FILES;
            $admin_if=$_POST;
            $admin_if['role_ids']=implode(',',$admin_if['role_ids']);

            $id=$_GET['id'];

            $res = D('admin')->upd_admin_info($logo,$admin_if,$id);
            if ($res >= 0) {
                $this->success('修改管理员信息成功', U('admin_list'));
                die;
            } else {
                $goods->getError();
                $this->display("admin_edit");
                die;
            }
        }
    }



}