<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 11:11
 */

namespace Admin\Controller;



class TypeController extends BaseController
{
    /*
     * 管理员添加
     */
    public function Type_add()
    {



        if (IS_POST) {
            $data = I('post.');
            $user = D('type');
            //dump($user);die;


            $user->create($data);
            $info = $user->add();
            if ($info) {
                $this->success('类型添加成功', 'type_list');
            } else {
                $this->error('类型添加失败', 'type_add');
            }
        } else {
            $titles = ['name' => '类型管理', 'sub' => '类型添加'];

            $this->assign('titles', $titles);
            $this->display("type_add");
        }

    }

    /*
     * 管理员用户展示
     */

    public function type_list()
    {
        $titles = ['name' => '类型管理', 'sub' => '类型列表'];
        $this->assign('titles', $titles);

        $type_info = M('type') ->select();

        $this->assign('type_info', $type_info);
        $this->display("type_list");
    }

    /*
     * 管理员修改
     */

    public function type_edit()
    {
        $titles = ['name' => '管理员管理', 'sub' => '信息修改'];
        $this->assign('titles', $titles);
        if(empty($_POST)){
            $id=$_GET['id'];
            $type_info = D('type')->editinfo($id);

            $this->assign('type_info', $type_info);
            $this->display("type_edit");
        }else{
            $logo=$_FILES;
            $type_if=$_POST;
            $id=$_GET['id'];
            $res = D('type')->upd_type_info($logo,$type_if,$id);
            if ($res >= 0) {
                $this->success('修改类型成功', U('type_list'));
                die;
            } else {
                $goods->getError();
                $this->display("type_edit");
                die;
            }
        }
    }



}