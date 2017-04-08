<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 11:11
 */

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{  /*
    * 登录界面的展示以及登录验证
    */
    public function login()
    {
        if (empty($_POST)) {
            $this->display();
            die;
        } else {
            $info=D('Admin')->user_login($_POST);
            /*
             * 进行验证用户名登录时的各种情况。
             */

           if($info==0){
                $this->error('验证码错误', 'login');
            }elseif($info==1){
                $this->error('用户名不存在', 'login');
            }elseif ($info==2){
                $this->error('密码错误', 'login');
            }else{
                   // dump($_POST['user_name']);
                    //session_start();
                     session('admin_name',$_POST['user_name']);
                     $admin_name=$_SESSION['admin_name'];

                $this->success('恭喜你,登录成功啦!',U('Admin/Index/index'),1);
            }


            die;
        }
    }

    /*
     * 使用Tp框架的验证码，生成验证码
     */
    public function verify_code()
    {
        $Verify = new \Think\Verify();
        $Verify->fontSize = 30;
        $Verify->length = 3;
        $Verify->useNoise = false;
        $Verify->entry();
    }

    /*
     * 退出登录
     */
    public function loginout()
    {
            session('id',null);
            $this->display('login');exit;

    }





}