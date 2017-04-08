<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26
 * Time: 21:08
 */

namespace Admin\Model;

use Think\Model;


class GoodsModel extends Model
{
    protected $insertFields = "goods_name,goods_price,logo,upd_time,add_time,goods_desc,cate_id,type_id,goods_id,attribute_option_value";
    protected $_validate = array(
        array('goods_name', 'require', '商品名称必须填写！', 1),
        array('goods_price', 'currency', '商品格式不对！', 1),
    );

    //添加数据之前的钩子函数
    protected function _before_insert(&$data, $option)
    {   //通过使用插件将收到的数据进行过滤，定义过滤函数
        $data['goods_desc'] = guolv($_POST['goods_desc']);
        $data['add_time'] = time();
        $data['upd_time'] = time();
        //dump($_FILES);exit;
       // $_FILES['goods_pic']['error']['1']=4;  // 0,1,2,

        $this->uploadimg($data);
        // dump($data);
    }

    //商品上传完之后进行的信息
    protected function _after_insert(&$data, $option)
    {
        $id = $data['id'];
        $this->uploadimgs($data, $id);
        // dump($data);

        $this->goods_attribute($id);
    }

    //更新数据数据之前的钩子函数
    protected function _before_update(&$data, $option)
    {
        //通过使用插件将收到的数据进行过滤，定义过滤函数
        $data['goods_desc'] = guolv($_POST['goods_desc']);
        $data['upd_time'] = time();

        //判断商品在进行更新时是否更换图片，如果存在图片进行删除之前的图片，上传现在的图片
        if ($_FILES['logo']['error'] == 0) {
            //进行查询图片的存储路径进行删除
            $logo_pic = M('goods')->where('logo', 'sm_logo', 'mid_logo')->find($option['where']['id']);
            foreach ($logo_pic as $v) {
                @unlink('.' . $v);
            }
            //进行上传现在的图片
            $this->uploadimg($data);
        }

        // dump($data);
    }

    //商品修改完后完之后进行需要处理的信息
    protected function _after_update(&$data, $option)
    {
        $id = $data['id'];
        if ($_FILES['goods_pic']['error'][0] == 0) {
            $this->uploadimgs($data, $id);
        }
    }

    //删除数据之前的钩子函数
    protected function _before_delete($option)
    {
        //进行查询图片的存储路径进行删除
        $logo_pic = M('goods')->where('logo', 'sm_logo', 'mid_logo')->find($option['where']['id']);
        foreach ($logo_pic as $v) {
            @unlink('.' . $v);
        }
        //获取商品相册中需要删除的图片
        $goods_pic = M('goods_pic')->where(array('goods_id' => $option['where']['id']))->select();
        foreach ($goods_pic as $v) {
            @unlink('.' . $v['goods_pic']);
            @unlink('.' . $v['sm_goods_pic']);
            @unlink('.' . $v['mid_goods_pic']);
            @unlink('.' . $v['big_goods_pic']);
        }
        M('goods_pic')->where(array('goods_id' => $option['where']['id']))->delete();
        $goods_id=$option['where']['id'];
        $this->del_attri($goods_id);

    }

    //双击删除图片时进行删除本地图片
    public function ajax_delete($goods_id, $goods_pic)
    {
        //获取商品相册中需要删除的图片
        $goods_pic = M('goods_pic')->where(array('goods_id' => $goods_id, 'goods_pic' => $goods_pic))->select();
        foreach ($goods_pic as $v) {
            @unlink('.' . $v['goods_pic']);
            @unlink('.' . $v['sm_goods_pic']);
            @unlink('.' . $v['mid_goods_pic']);
            @unlink('.' . $v['big_goods_pic']);
        }

    }

    //单个图片进行上传的定义方法
    public function uploadimg(&$data)
    {
        if ($_FILES['logo']['error'] < 4) {
            $upload = new \Think\Upload();
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
            $upload->rootPath = './Public/Uploads/';// 设置附件上传目录
            $upload->savePath = 'Admin/Goods/Logo/';// 设置附件上传目录
            $imginfo = $upload->uploadOne($_FILES['logo']);
            $data['logo'] = '/Public/Uploads/' . $imginfo['savepath'] . $imginfo['savename'];
            //dump($data['logo']);

            //制作缩略图
            if ($data['logo']) {
                $s_image = new \Think\Image();
                $s_image->open('.' . $data['logo']);
                //将图片裁剪为400x400并保存为corp.jpg
                $data['sm_logo'] = '/Public/Uploads/' . $imginfo['savepath'] . 'sml_' . $imginfo['savename'];
                $data['mid_logo'] = '/Public/Uploads/' . $imginfo['savepath'] . 'mid_' . $imginfo['savename'];
                $s_image->thumb(300, 300)->save('.' . $data['sm_logo']);
                $s_image->thumb(650, 650)->save('.' . $data['mid_logo']);
                // return $data;
            }

        }


    }

    //上传多张图片定义方法
    public function uploadimgs(&$data, $id)
    {


        $upload = new \Think\Upload();
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg'); // 设置附件上传类型
        $upload->rootPath = './Public/Uploads/';// 设置附件上传目录
        $upload->savePath = 'Admin/Goods/goods_pic/';// 设置附件上传目录
        $imginfo = $upload->upload(array($_FILES['goods_pic']));
        $datainfo['goods_pic'] = '/Public/Uploads/' . $imginfo['savepath'] . $imginfo['savename'];
        //制作缩略图以及中等图片

        $s_image = new \Think\Image();
        $goods_pic = M('goods_pic');
        foreach ($imginfo as $v) {
            $s_image->open($upload->rootPath . $v['savepath'] . $v['savename']);
            //将图片进行缩放进行储存
            $datainfo['goods_id'] = $id;
            $datainfo['goods_pic'] = '/Public/Uploads/' . $v['savepath'] . $v['savename'];
            $datainfo['sm_goods_pic'] = '/Public/Uploads/' . $v['savepath'] . 'sml_' . $v['savename'];
            $datainfo['mid_goods_pic'] = '/Public/Uploads/' . $v['savepath'] . 'mid_' . $v['savename'];
            $datainfo['big_goods_pic'] = '/Public/Uploads/' . $v['savepath'] . 'big_' . $v['savename'];
            $s_image->thumb(800, 650)->save('.' . $datainfo['big_goods_pic']);
            $s_image->thumb(450, 350)->save('.' . $datainfo['mid_goods_pic']);
            $s_image->thumb(160, 100)->save('.' . $datainfo['sm_goods_pic']);
            $goods_pic->add($datainfo);
        }
        // return $data;


    }


    //查询数据库，将数据展示到页面上
    public function goods_data()
    {
        //进行查询数据库
         $goodsinfo = D('goods')->field('a.*,b.cate_name')
                                ->alias('a')
                                ->join('left join __CATEGORY__  b on b.cate_id=a.cate_id ')->select();
        return $goodsinfo;
    }
    //修改产品的时候进行查询数据库，将数据展示到页面上
    public function edit_goods_data($id)
    {
        //进行查询数据库
        $goodsinfo = D('goods')->find($id);
        return $goodsinfo;
    }
    //查询分类的全部信息
    public function category_data(){
        $category_data=D('category')->select();
        return $category_data;
    }

    /**
     * 进行处理商品属性信息
     *
     */
    public  function goods_attribute($id){
        $data=I('post.attribute_option_value');
        //dump($data);
        //进行拼接商品的属性信息
        $attribute_mode=M('goods_attribute');
        $data['goods_id']=$id;
            foreach ($data  as $k => $v){
                if(!empty($v)){
                    $atr="";
                    $v=array_unique($v);
                    foreach($v as $k1=>$v1){
                        //dump($v1);die;
                        if(!empty($v1)){
                         $atr.=$v1.',';
                        }
                    }
                    $data['attribute_id']=$k;
                    $data['attribute_value']= rtrim($atr,',');
                    //将循环好的数据进行增加到数据库
                    if(!empty($data['attribute_value'])){
                        $attribute_mode->add($data);
                    }

                }


                //dump($attribute_mode->getLastSql());
                //dump($aa);

                //die;
            }


    }
    //如果删除商品进行删除删除商品的属性
    public function del_attri($id){
        M('goods_attribute')->where(array('goods_id' =>$id))->delete();
    }









}