<?php

namespace Home\Controller;

use Think\Controller;

class ShopController extends Controller
{
    /**
     * 购物车增加减少处理方法
     */
    function addcart()
    {
        $good_id = I('get.goods_id');
        $buy_num = I('get.buy_num');

        $info = D('Goods')->find($good_id);
        //dump($info);
        //将被添加的商品组织成数组形式
        $shuju['goods_id'] = $info['id'];
        $shuju['goods_name'] = $info['goods_name'];
        $shuju['goods_price'] = $info['goods_price'];
        $shuju['goods_buy_number'] = $buy_num;
        $shuju['goods_total_price'] = $info['goods_price'] * $shuju['goods_buy_number'];
        //dump($shuju);die;

        $cart = new \Home\Common\Cart();
        $cart->add($shuju);

        //将数据进行更新
        //通过调用方法可以获得以下两个值
        //$arr['number'] = $number;
        //$arr['price'] = $price;

        $number_price = $cart->getNumberPrice();

        //返回的信息有商品数量和商品总价格
        echo json_encode($number_price);
        die;
    }


    /**
     * 购物车详细信息界面，并展示到购物车里面
     */

    public function flow1()
    {
        $cart = new \Home\Common\Cart();
        $cartinfo = $cart->getCartInfo();

        $good_ids = implode(',', array_keys($cartinfo));
        $logoinfo = D('Goods')->select($good_ids);

        //将数据进行整合
        foreach ($cartinfo as $k => $v) {
            foreach ($logoinfo as $kk => $vv) {
                if ($k == $vv['id']) {
                    $cartinfo[$k]['logo'] = $logoinfo[$kk]['sm_logo'];
                }
            }
        }

        // dump($cartinfo);die;

        $goods_total_price = 0;
        foreach ($cartinfo as $k => $v) {
            $goods_total_price += $v['goods_total_price'];

        };

        $this->assign('cartinfo', $cartinfo);
        $this->assign('number_price', $goods_total_price);
        //获得购物车的图片信息


        $this->display();
    }


    /**
     * 核对订单信息界面，将订单信息存入到数据库中
     */
    public function flow2()
    {

        if (IS_POST) {
            //通过购物车的cookie将购物车的信息提取出来
            $cart = new \Home\Common\Cart();

            //提取购物车里面的数量以及价格
            $number_price = $cart->getNumberPrice();
            //获取用户的收货地址、支付方式，以及发票信息
            $shuju = I('post.');

            $shuju['user_id'] = session('user_id');
            $shuju['order_number'] = "jsshop-" . date("YmdHis") . "-" . mt_rand(1000, 9999);
            $shuju['order_price'] = $number_price['price'];
            $shuju['user_id'] = session('user_id');
            $shuju['add_time'] = $shuju['upd_time'] = time();
            $order_id = D('Order')->add($shuju); //形成订单记录，写入数据库
            //维护订单关联的商品信息sp_order_goods

            //② 维护订单关联的商品信息sp_order_goods
            //获取购物车信息
            $cartinfo = $cart->getCartInfo();
            dump($cartinfo);die;
            $shuju2 = array();
            foreach ($cartinfo as $k => $v) {
                $shuju2['order_id'] = $order_id;
                $shuju2['goods_id'] = $k;
                $shuju2['goods_price'] = $v['goods_price'];
                $shuju2['goods_number'] = $v['goods_buy_number'];
                $shuju2['goods_total_price'] = $v['goods_total_price'];
                //给sp_order_goods表形成记录
                D('OrderGoods')->add($shuju2);
            }

            //2) 清除购物车信息
            $cart->delAll();

            //echo "订单形成中....";
            //实现支付宝支付效果(订单号码、商品名称、付款金额、商品描述)
            $WIDout_trade_no = $shuju['order_number'];
            $WIDsubject = $shuju['order_number'];
            $WIDtotal_fee = $number_price['price'];
            $fm = <<<eof
        <form action="/Application/Common/Plugins/alipay/alipayapi.php" method="post">
            <input type="hidden" name="WIDout_trade_no" value="$WIDout_trade_no" />
            <input type="hidden" name="WIDsubject" value="$WIDsubject" />
            <input type="hidden" name="WIDtotal_fee" value="$WIDtotal_fee" />
            <input type="hidden" name="WIDbody" value="" />
        </form>
        <script type="text/javascript">
            document.getElementsByTagName('form')[0].submit();
        </script>
eof;
            echo $fm;

        } else {
            if (!session('username')) {
                session('back_url', 'Shop/flow2');
                $this->redirect('User/login');
            }

            //获得购物车商品列表信息
            $cart = new \Home\Common\Cart();
            $cartinfo = $cart->getCartInfo();//获得购物车商品信息

            //获得购物车商品的图片信息(数据表字段：goods_small_logo)
            //获得购物车商品的goods_id信息，并拼装为字符串
            $goods_ids = implode(',', array_keys($cartinfo));//string(5) "21,18"

            //通过$goods_ids获取商品的小图信息
            $logoinfo = D('Goods')
                ->field('id,sm_logo')
                ->select($goods_ids);
            //dump($logoinfo);

            //整合，使得$logoinfo的图片信息添加进$cartinfo 里边去
            foreach ($cartinfo as $k => $v) {
                foreach ($logoinfo as $vv) {
                    if ($k == $vv['id']) { //购物车商品 与 图片商品对应上
                        //把logo图片添加进$cartinfo的数组里边
                        $cartinfo[$k]['logo'] = $vv['sm_logo'];
                    }
                }
            }
            //dump($cartinfo);
            $this->assign('cartinfo', $cartinfo);
            //获得购物车商品金额总计
            $number_price = $cart->getNumberPrice();
            $this->assign('number_price', $number_price);
            $this->display();


        }
    }


    /**
     * 订单完成后的界面
     */
    public function flow3()
    {
        $this->display();
    }


    /**
     *
     *通过ajax将数据发生变化
     */
    function changeNumber()
    {
        //获得客户端的id以及数量
        $goods_id = I('post.goods_id');
        $num = I('post.num');
        $cart = new \Home\Common\Cart();
        $xiaoji_price->$cart->changeNumber($num, $goods_id);
        //获得当前全部价格
        $number_price = $cart->getNumberPrice();
        return json_encode(array(
            'total_price' => $number_price['price'],
            'xiaoji_price' => $xiaoji_price
        ));

    }



    /**
     * 通过ajax将购物车的数据进行删除
     */
    function del_goods()
    {
        $goods_id = I('get.goods_id');
        $cart = new \Home\Common\Cart();
        $cart->del($goods_id);


    }


}