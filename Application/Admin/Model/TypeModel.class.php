<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 21:08
 */

namespace Admin\Model;

use Think\Model;


class TypeModel extends Model
{
    protected $insertFields = "type_name";
    protected $_validate = array(
        array('type_name', 'require', '类型必须填写！', 1),

    );

    //获得修改用户的基本信息
    public function editinfo($id)
    {

        $user_info = D('type')->where(array('id' => $id))->find();
        return $user_info;

    }

    public  function upd_type_info($id){
        $id=$_GET['id'];

        $msg = D('type')->where(array('id'=>$id))->save($_POST);
        return $msg;
    }

    //查询数据进行排序
    public function getData()
    {
        //进行查询数据库
        $category=M('privilege');
        $data=$category->select();
        return $data;
       // return $this->_getTree($data);
    }
    //封装方法，进行排序
    private function _getTree($data,$parent_id=0,$level=0){
        static $_result=array();
        foreach ($data as $k=>$v){
            if ($v['parent_id']==$parent_id){
                $v['level']=$level;
                $_result[]=$v;
                $this->_getTree($data,$v['id'],$level+1);
            }

        }
        return $_result;

    }



}