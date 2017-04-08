<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 11:11
 */

namespace Admin\Controller;



class RoleController extends BaseController
{
    /*
     * 管理员添加
     */
    public function role_add()
    {
        if (IS_POST) {
            $data = I('post.');
            $user = D('role');
            $user->create($data);
            $info = $user->add();
            if ($info) {
                $this->success('角色添加成功', 'role_list');
            } else {
                $this->error('角色添加失败', 'role_add');
            }
        } else {
            $titles = ['name' => '角色管理', 'sub' => '角色添加'];

            $this->assign('titles', $titles);
            $this->display("role_add");
        }

    }

    /*
     * 管理员用户展示
     */

    public function role_list()
    {
        $titles = ['name' => '角色管理', 'sub' => '角色列表'];
        $this->assign('titles', $titles);

        $role_info = M('role') ->select();

        $this->assign('role_info', $role_info);
        $this->display("role_list");
    }

    /*
     * 管理员修改
     */

    public function role_edit()
    {
        $titles = ['name' => '管理员管理', 'sub' => '信息修改'];
        $this->assign('titles', $titles);
        if(empty($_POST)){
            $id=$_GET['id'];
            $role_info = D('role')->editinfo($id);

            $this->assign('role_info', $role_info);
            $this->display("role_edit");
        }else{
            $logo=$_FILES;
            $role_if=$_POST;
            $id=$_GET['id'];
            $res = D('Role')->upd_role_info($logo,$role_if,$id);
            if ($res >= 0) {
                $this->success('修改角色成功', U('role_list'));
                die;
            } else {
                $goods->getError();
                $this->display("role_edit");
                die;
            }
        }
    }



}