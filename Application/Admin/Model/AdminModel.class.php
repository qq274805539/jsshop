<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 21:08
 */

namespace Admin\Model;

use Think\Model;


class AdminModel extends Model
{
    protected $insertFields = "user_name,password,role_ids";
    protected $_validate = array(
        array('user_name', 'require', '用户名必须填写！', 1),
        array('password', 'require', '密码必须填写！', 1),
    );

    //添加数据之前的钩子函数
    protected function _before_insert(&$data, $option)
    {   //通过使用插件将收到的数据进行过滤，定义过滤函数
        $data['create_time'] = time();
        $data['login_time'] = time();
        $data['last_login_ip'] = ip2long(get_client_ip());
        $this->uploadimg($data);

    }

    //单个图片进行上传的定义方法
    public function uploadimg(&$data)
    {
        if ($_FILES['user_logo']['error'] == 0) {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->rootPath = './Public/Uploads/';// 设置附件上传目录
            $upload->savePath = 'Admin/Admin/user_logo/';// 设置附件上传目录
            $imginfo = $upload->uploadOne($_FILES['user_logo']);
            $data['user_logo'] = '/Public/Uploads/' . $imginfo['savepath'] . $imginfo['savename'];
        }


    }

    //更新数据数据之前的钩子函数
    protected function _before_update(&$data, $option)
    {

        //判断管理员在进行更新数据时是否更换图片，如果存在图片进行删除之前的图片，上传现在的图片
        if ($_FILES['logo']['error'] == 0) {
            //进行查询图片的存储路径进行删除
            $logo_pic = M('admin')->where('user_logo')->find($option['where']['id']);
            foreach ($logo_pic as $v) {
                @unlink('.' . $v);
            }
            //进行上传现在的图片
            $this->uploadimg($data);
        }
        // dump($data);
    }

    //管理员进行添加的时候进项查询的信息

    /**
     * @return string
     */
    public function admin_role_info()
    {
        $role=D('role')->select();
        return $role;
    }

    //获得修改用户的基本信息
    public function get_admin_editinfo($id)
    {
        $user_info = D('admin')->where(array('id' => $id))->find();
        return $user_info;

    }

    public  function upd_admin_info($logo,$admin_if,$id){
     /*   dump($logo);
        dump($admin_if);
        die;*/
        $data=D('admin')->create();
        $msg = D('admin')->where(array('id'=>$id))->save($admin_if);
        $a=D('admin')->getLastSql();

        return $msg;
    }





     //*******************用于登录验证*****************************************

    /**
     * 进行数据验证，用于登录
     */
    public function user_login($data)
    {
        //进行验证验证码是否OK
       // !$this->check_verify($data['verify'])
        if(0){
           return $result=0 ;
        }else{
            //进行验证用户名是否存在
            $info=D('admin')->where(array('user_name'=>$data['user_name']))->find();
            if(!$info){
                return $result=1;
            }elseif($info['password']!=$data['password']){
                return $result=2;
            }else{
                return $result=3;
            }
        }
    }
    /*
     * 进行验证码验证，使用tp框架的原生验证方法
     */
    function check_verify($code, $id = '')
    {
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
    //**********************************************************************


}