<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 21:08
 */

namespace Admin\Model;

use Think\Model;


class CategoryModel extends Model
{
    //添加数据的时候进行数据验证
    protected $insertFields = "cate_name,parent_id";
    protected $_validate = array(
        array('cate_name', 'require', '商品名称必须填写！', 1),
        array('parent_id', 'require', '商品名称必须填写！', 1),
    );


    //查询数据进行排序
    public function getData()
    {
        //进行查询数据库
        $category=M('category');
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
                $this->_getTree($data,$v['cate_id'],$level+1);
            }

        }
        return $_result;

    }




}