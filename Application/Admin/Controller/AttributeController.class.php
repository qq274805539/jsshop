<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 11:11
 */

namespace Admin\Controller;


class AttributeController extends BaseController
{
    /*
     * 管理员添加
     */
    public function attribute_add()
    {
        if (IS_POST) {
            $data = I('post.');
            $type_id=$data['type_id'];
            $user = D('Attribute');

            $data['attribute_option_value']=str_replace('，',',',$data['attribute_option_value']);
            //dump($data);die;
            $user->create($data);
            $info = $user->add();
            if ($info) {
                $this->success('属性添加成功', U("Attribute/attribute_list?type_id=$type_id"
                ));
            } else {
                $this->error('属性添加失败', 'attribute_add');
            }
        } else {
            $type_id=I('get.');
            $this->assign('type_id', $type_id);
            $titles = ['name' => '属性管理', 'sub' => '属性添加'];
            //dump($type_id);die;
            $this->assign('titles', $titles);
            $this->display("attribute_add");
        }

    }

    /*
     * 类型属性展示
     */

    public function attribute_list()
    {
        $titles = ['name' => '属性管理', 'sub' => '属性列表'];
        $this->assign('titles', $titles);

        $attribute_info = M('Attribute')-> where(array('type_id'=>I('get.')['type_id']))->select();

        //$a= M('Attribute')->getLastSql();
        //dump($a);
        //dump( $attribute_info);die;
        $type_id=I('get.')['type_id'];
        $this->assign('type_id', $type_id);

        $this->assign('attribute_info', $attribute_info);
        $this->display("attribute_list");
    }

    /*
     * 属性修改
     */

    public function attribute_edit()
    {
        $titles = ['name' => '管理员管理', 'sub' => '信息修改'];
        $this->assign('titles', $titles);
        if(empty($_POST)){
            $id=$_GET['id'];
            $attribute_info = D('Attribute')->editinfo($id);
            //dump($attribute_info);die;
            $this->assign('attribute_info', $attribute_info);
            $this->display("attribute_edit");
        }else{

            $id=$_GET['id'];
            $data=I('post.');
            $type_id=$data['type_id'];
            $res = D('attribute')->upd_attribute_info($data,$id);
            if ($res >= 0) {
                $this->success('修改属性成功', U("Attribute/attribute_list?type_id=$type_id"));
                die;
            } else {
                $goods->getError();
                $this->display("attribute_edit");
                die;
            }
        }
    }




    /**
     * 通过ajax返回的数据进行查询商品具有的类型
     * @author
     * 2017年4月1日23:10:59
     */
    public function get_attribute_by_typeid(){
        //通过ajax传过来的值进行查询信息
        $type_id=I('get.');
        $data=M('attribute')->where(array('type_id'=>$type_id['type_id']))->select();
        //print_r($data);
        $data=json_encode($data);
        echo $data;die;

    }



}