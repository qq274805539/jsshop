<?php

namespace Home\Controller;

use Think\Controller;

class UserController extends Controller
{
    public function login()
    {
        if (IS_POST) {
            $data = I('post.');

            $res = M('user')->where(array('username' => $data['username'], 'password' => $data['password']))->select();

            if (empty($res)) {
                $this->error('抱歉,用户名或者密码错误!', U('user/login'), 1);
                die;

            } else {
                if ($res[0]['is_action'] == 0) {
                    $this->error('你未激活,请激活后重新登录!', U('user/login'), 1);
                    die;
                } else {
                    session('username', $data['username']);
                    //进行查询数据库将用户的id存入session
                    $id = M('User')->where(array('user_name' => $data['username']))->field('user_id')->find();

                    session('user_id', $id['user_id']);
                    //判断是否存在回跳地址。如果存在将页面进行跳转到原来的页面
                    //dump(session('back_url'));die;
                    if (session('back_url')) {
                        $back_url = session('back_url');
                        session('back_url', null);
                        $this->redirect($back_url);
                        die;
                    } else {
                        $this->success('登录成功!', U('Index/index'), 1);
                        die;
                    }

                }
            }
        }


        $this->display();
    }

    /*
     *注册用户信息
     *@author
     */


    public function register()
    {
        //判断数据是否通过post提交过来.
        if (IS_POST) {
            $data = I('post.');
            $data['user_time'] = time();
            $data['last_time'] = time();
            $data['email_is'] = time();

            //将验证码的信息从session中获取出来
            $yanzhengma=session('data');
            $yzm = $data['user_yzm'];

            $now_time =time()-60 * 3; //将验证码时间进行转化

            //判断验证码的失效与否与正确性
            if ($yanzhengma['newtime']-$now_time < 0) {

                $this->error('验证码失效，请重现验证，页面跳转中……', U('user/register'), 1);
                die;
            } else {
                if ($yanzhengma['code'] !=$yzm ){
                    $this->error('验证码错误，页面跳转中……', U('user/register'), 1);
                    die;
                }
           }
            //判断数据是否增加成功
            if ($id = M('user')->add($data)) {
                $email = I('post.user_email');
                $content = "http://www.123dsshop123.com/index.php/Home/User/action_email/id/" . $id . "/email_is/" . $data['email_is'];
                $email_content = "<a href='{$content}'>请点击进行激活你的账号</a>";
                //判断邮件是否发送成功
                $a = sendMail($email, $email_content);
                if ($a) {
                    $this->success('恭喜你,注册成功,请登录邮箱进行验证激活……', U('user/login'), 1);
                    die;
                }
            } else {
                $this->error('抱歉,注册失败喽!', U('user/register'), 1);
                die;
            }
            die;
        };

        $this->display();
        die;
    }

    /**
     * 退出登录
     */

    public function loginout()
    {
        session('username', null);
        $this->display('Index/index');
        die;


    }

    //进行激活邮件
    function action_email()
    {
        $id = I('get.id');
        $email_is = I('get.email_is');
        //将数据库里面的信息进行更新并将数据库的验证信息删除
        $info = M('user')->where(array('user_id' => $id, 'email_is' => $email_is))->save(array('is_action' => '1', 'email_is' => ''));
        if ($info) {

            $this->success('恭喜你,激活成功！', U('user/login'), 1);
            die;
        } else {
            $this->error('抱歉,激活失败！', U('user/register'), 1);
            die;
        }


    }


    /**
     * 制作注册的时候的发送手机验证码
     *
     */
    public function sendCont()
    {
        //获取手机号码
        $tel = I('get.user_tel');
        //制作验证码
        $data['code'] = mt_rand(1000, 9999);
        $data['limittime'] = 3;
        $data['newtime'] = time();
        //将发送的验证码存入到session
        session('data', $data);
        //发送验证码
        $a = sendSms($tel, array($data['code'], $data['limittime']));
        if ($a) {
            echo json_encode(array('static' => 0));
        } else {
            echo json_encode(array('static' => 1));
        }

    }


}