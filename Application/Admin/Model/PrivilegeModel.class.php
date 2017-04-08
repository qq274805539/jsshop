<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 21:08
 */

namespace Admin\Model;

use Think\Model;


class PrivilegeModel extends Model
{
    //添加数据的时候进行数据验证
    protected $insertFields = "pri_name,parent_id,model_name,controller_name,action_name";
    protected $_validate = array(
        array('pri_name', 'require', '商品名称必须填写！', 1),
        array('parent_id', 'require', '商品名称必须填写！', 1),
    );


    //查询数据进行排序
    public function getData()
    {
        //进行查询数据库
        $category=M('privilege');
        $data=$category->select();
        return $this->_getTree($data);
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