<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 11:11
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{
    public function __construct()
    {
        //运行父类控制器的构造方法
        parent::__construct();

        //进行查询该用户所具有的权限以及信息
        $admin_name = $_SESSION['admin_name'];
        $admin_info = D('Admin')->where(array('user_name' => $admin_name))->find();
        $admin_id = $admin_info['id'];

        if (!$admin_id) {
            $this->error("请登录", U("Admin/Login/login"), 1);
            die;
        }
        //进行判断是否存在登录用户的权限信息
        //$admin_pri = session('privilege_' . $admin_id);

        //判断session里面是存在权限信息
        if (!$admin_pri) {
            //查询权限信息
            if ($admin_id == 1) {
                //判断如果是管理员,获得全部的权限信息
                $privilege = M('privilege')->select();
                $this->assign('privilege_info', $privilege);
                $admin_info = D('Admin')->where(array('id' => '1'))->find();

            } else {
                //查询当前管理员所拥有的权限
                $admin_info = D('Admin')->where(array('id' => $admin_id))->find();
                //进行查询权限信息
                $role_info = D('Role')->where(array('id' => $admin_info['role_ids']))->find();
                //将用户的权限信息进行组合到数组中.
                $role_info['pri_ids'] = array_unique(explode(',', $role_info['pri_ids']));

                $privilege = D('privilege')->where(array('id' => array('in', $role_info['pri_ids'])))->select();

                //将用户的权限ID存入session中
                session('privilege_allow' . $admin_id , $role_info['pri_ids']);
            }
            //查询完毕后将数据存储到Session里面
            session('privilege_' . $admin_id, $privilege);

        }

        //进行判断是否存在登录用户的权限信息
        $admin_pri = session('privilege_' . $admin_id);

        //将用户的权限信息进行排序
        $menu = $this->getmenu($admin_pri);

        $admin_allow_pri=session('privilege_allow' . $admin_id);

        //进行判断当前用户登录的界面是否存在自己的权限内
        //调用越权方法,进行调用防止越权操作的方法
        $this->getpri($admin_id, $admin_allow_pri);

        //将查询到的信息展示到页面上
        $this->assign('menu', $menu);
        $this->assign('admin_info', $admin_info);

    }



    /**
     * 封装一个获得权限信息的方法，防止越权操作
     */
    protected function getpri($admin_id,$admin_allow_pri){
        //将登录界面进行排除,
        if (CONTROLLER_NAME != 'Index') {
            if ($admin_id!=1) {
                $p_id = M('privilege')->where(array('model_name' => CONTROLLER_NAME, 'controller_name' => MODULE_NAME, 'action_name' => ACTION_NAME))->find();
                //将查询的目前所属于的界面是否存在于访问用户的权限列表中...
                if(!in_array($p_id['id'],$admin_allow_pri)){
                    $this->error('越权访问,请登录.......',U('login/login'),1); die;
                }

            }
        }

    }



    /**
     * 将获得的权限信息进行排序，呈现到界面上
     * @author 2017年4月1日09:11:04
     */

    protected function getmenu($men)
    {
        $res = array();
        foreach ($men as $k => $v) {
            if ($v['parent_id'] == 0) {
                foreach ($men as $k1 => $v1) {
                    if ($v1['parent_id'] == $v['id']) {
                        $v['children'][] = $v1;
                }
                }
                $res[] = $v;
            }
        }
        return $res;

    }


}