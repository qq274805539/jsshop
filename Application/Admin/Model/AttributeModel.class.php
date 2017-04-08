<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 21:08
 */

namespace Admin\Model;

use Think\Model;


class AttributeModel extends Model
{
    protected $insertFields = "attribute_name,attribute_type,attribute_option_value,type_id";
    protected $_validate = array(
        array('attribute_name', 'require', '属性名称必须填写！', 1),
    );

    //获得修改用户的基本信息
    public function editinfo($id)
    {
        $msg = D('Attribute')->where(array('id' => $id))->find();
        return $msg;

    }

    public  function upd_attribute_info($data,$id){
        $msg = D('Attribute')->where(array('id'=>$id))->save($data);
        return $msg;

    }



}