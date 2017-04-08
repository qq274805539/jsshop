<?php

namespace Admin\Controller;

class IndexController extends BaseController
{


        public function index()
    {
        $titles = ['name' => '首页', 'sub' => '当前页'];
        $this->assign('titles', $titles);


        $this->display();
    }




}