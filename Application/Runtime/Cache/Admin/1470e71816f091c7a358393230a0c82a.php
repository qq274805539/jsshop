<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->

<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->

<!--[if !IE]><!--> <html lang="en" class="no-js"> <!--<![endif]-->

<!-- BEGIN HEAD -->

<head>

    <meta charset="utf-8" />

    <title>Metronic | Admin Dashboard Template</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <meta content="" name="description" />

    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="<?php echo C('ADMIN_CSS_PATH');?>bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo C('ADMIN_CSS_PATH');?>bootstrap-responsive.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo C('ADMIN_CSS_PATH');?>font-awesome.min.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo C('ADMIN_CSS_PATH');?>style-metro.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo C('ADMIN_CSS_PATH');?>style.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo C('ADMIN_CSS_PATH');?>style-responsive.css" rel="stylesheet" type="text/css"/>

    <link href="<?php echo C('ADMIN_CSS_PATH');?>default.css" rel="stylesheet" type="text/css" id="style_color"/>

    <link href="<?php echo C('ADMIN_CSS_PATH');?>uniform.default.css" rel="stylesheet" type="text/css"/>

    <!-- END GLOBAL MANDATORY STYLES -->



</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

<!-- BEGIN HEADER -->

<div class="header navbar navbar-inverse navbar-fixed-top">

    <!-- BEGIN TOP NAVIGATION BAR -->

    <div class="navbar-inner">

        <div class="container-fluid">

            <!-- BEGIN LOGO -->

            <a class="brand" href="index.html">

                <img src="<?php echo C('ADMIN_IMG_PATH');?>logo.png" alt="logo"/>

            </a>

            <!-- END LOGO -->

            <!-- BEGIN RESPONSIVE MENU TOGGLER -->

            <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

                <img src="<?php echo C('ADMIN_IMG_PATH');?>menu-toggler.png" alt="" />

            </a>

            <!-- END RESPONSIVE MENU TOGGLER -->

            <!-- BEGIN TOP NAVIGATION MENU -->

            <ul class="nav pull-right">

                <!-- BEGIN NOTIFICATION DROPDOWN -->

                <li class="dropdown" id="header_notification_bar">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <i class="icon-warning-sign"></i>

                        <span class="badge">6</span>

                    </a>

                    <ul class="dropdown-menu extended notification">

                        <li>

                            <p>You have 14 new notifications</p>

                        </li>

                        <li>

                            <a href="#">

                                <span class="label label-success"><i class="icon-plus"></i></span>

                                New user registered.

                                <span class="time">Just now</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

                                <span class="label label-important"><i class="icon-bolt"></i></span>

                                Server #12 overloaded.

                                <span class="time">15 mins</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

                                <span class="label label-warning"><i class="icon-bell"></i></span>

                                Server #2 not respoding.

                                <span class="time">22 mins</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

                                <span class="label label-info"><i class="icon-bullhorn"></i></span>

                                Application error.

                                <span class="time">40 mins</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

                                <span class="label label-important"><i class="icon-bolt"></i></span>

                                Database overloaded 68%.

                                <span class="time">2 hrs</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

                                <span class="label label-important"><i class="icon-bolt"></i></span>

                                2 user IP blocked.

                                <span class="time">5 hrs</span>

                            </a>

                        </li>

                        <li class="external">

                            <a href="#">See all notifications <i class="m-icon-swapright"></i></a>

                        </li>

                    </ul>

                </li>

                <!-- END NOTIFICATION DROPDOWN -->

                <!-- BEGIN INBOX DROPDOWN -->

                <li class="dropdown" id="header_inbox_bar">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <i class="icon-envelope"></i>

                        <span class="badge">5</span>

                    </a>

                    <ul class="dropdown-menu extended inbox">

                        <li>

                            <p>You have 12 new messages</p>

                        </li>

                        <li>

                            <a href="inbox.html?a=view">

                                <span class="photo"><img src="<?php echo C('ADMIN_IMG_PATH');?>avatar2.jpg" alt="" /></span>

                                <span class="subject">

								<span class="from">Lisa Wong</span>

								<span class="time">Just Now</span>

								</span>

                                <span class="message">

								Vivamus sed auctor nibh congue nibh. auctor nibh

								auctor nibh...

								</span>

                            </a>

                        </li>

                        <li>

                            <a href="inbox.html?a=view">

                                <span class="photo"><img src="" alt="" /></span>

                                <span class="subject">

								<span class="from">Richard Doe</span>

								<span class="time">16 mins</span>

								</span>

                                <span class="message">

								Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh

								auctor nibh...

								</span>

                            </a>

                        </li>

                        <li>

                            <a href="inbox.html?a=view">

                                <span class="photo"><img src="" alt="" /></span>

                                <span class="subject">

								<span class="from">Bob Nilson</span>

								<span class="time">2 hrs</span>

								</span>

                                <span class="message">

								Vivamus sed nibh auctor nibh congue nibh. auctor nibh

								auctor nibh...

								</span>

                            </a>

                        </li>

                        <li class="external">

                            <a href="inbox.html">See all messages <i class="m-icon-swapright"></i></a>

                        </li>

                    </ul>

                </li>

                <!-- END INBOX DROPDOWN -->

                <!-- BEGIN TODO DROPDOWN -->

                <li class="dropdown" id="header_task_bar">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <i class="icon-tasks"></i>

                        <span class="badge">5</span>

                    </a>

                    <ul class="dropdown-menu extended tasks">

                        <li>

                            <p>You have 12 pending tasks</p>

                        </li>

                        <li>

                            <a href="#">

								<span class="task">

								<span class="desc">New release v1.2</span>

								<span class="percent">30%</span>

								</span>

                                <span class="progress progress-success ">

								<span style="width: 30%;" class="bar"></span>

								</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

								<span class="task">

								<span class="desc">Application deployment</span>

								<span class="percent">65%</span>

								</span>

                                <span class="progress progress-danger progress-striped active">

								<span style="width: 65%;" class="bar"></span>

								</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

								<span class="task">

								<span class="desc">Mobile app release</span>

								<span class="percent">98%</span>

								</span>

                                <span class="progress progress-success">

								<span style="width: 98%;" class="bar"></span>

								</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

								<span class="task">

								<span class="desc">Database migration</span>

								<span class="percent">10%</span>

								</span>

                                <span class="progress progress-warning progress-striped">

								<span style="width: 10%;" class="bar"></span>

								</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

								<span class="task">

								<span class="desc">Web server upgrade</span>

								<span class="percent">58%</span>

								</span>

                                <span class="progress progress-info">

								<span style="width: 58%;" class="bar"></span>

								</span>

                            </a>

                        </li>

                        <li>

                            <a href="#">

								<span class="task">

								<span class="desc">Mobile development</span>

								<span class="percent">85%</span>

								</span>

                                <span class="progress progress-success">

								<span style="width: 85%;" class="bar"></span>

								</span>

                            </a>

                        </li>

                        <li class="external">

                            <a href="#">See all tasks <i class="m-icon-swapright"></i></a>

                        </li>

                    </ul>

                </li>

                <!-- END TODO DROPDOWN -->

                <!-- BEGIN USER LOGIN DROPDOWN -->

                <li class="dropdown user">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <!--<img alt="" src="<?php echo C('ADMIN_IMG_PATH');?>avatar1_small.jpg" />-->
                        <img alt="" src="<?php echo ($admin_info["user_logo"]); ?>" style="height: 29px;width: 29px"/>

                        <span class="username">Bob Nilson</span>

                        <i class="icon-angle-down"></i>

                    </a>

                    <ul class="dropdown-menu">

                        <li><a href="<?php echo U('login/loginout');?>"><i class="icon-user"></i>切换用户</a></li>


                        <li><a href="<?php echo U('Login/loginout');?>"><i class="icon-key"></i>退出登录</a></li>

                    </ul>

                </li>

                <!-- END USER LOGIN DROPDOWN -->

            </ul>

            <!-- END TOP NAVIGATION MENU -->

        </div>

    </div>

    <!-- END TOP NAVIGATION BAR -->

</div>Metronic is a brand new Responsive Admin Dashboard Template you have always been looking for!

<!-- END HEADER -->
<div class="copyrights">Collect from <a href="http://www.cssmoban.com/" >网页模板</a></div>

<!-- BEGIN CONTAINER -->

<div class="page-container">

    <!-- BEGIN SIDEBAR -->

    <div class="page-sidebar nav-collapse collapse">

        <!-- BEGIN SIDEBAR MENU -->

        <ul class="page-sidebar-menu">

            <li>

                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

                <div class="sidebar-toggler hidden-phone"></div>

                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->

            </li>

            <li>

                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->

                <form class="sidebar-search">

                    <div class="input-box">

                        <a href="javascript:;" class="remove"></a>

                        <input type="text" placeholder="Search..." />

                        <input type="button" class="submit" value=" " />

                    </div>

                </form>

                <!-- END RESPONSIVE QUICK SEARCH FORM -->

            </li>

            <li class="start active ">
            <li class="start <?php  if(CONTROLLER_NAME=='Index') {echo active;} ?> ">
                <a href="<?php echo U('Admin/Index/index');?>">

                    <i class="icon-home"></i>

                    <span class="title">首页</span>

                    <span class="selected"></span>

                </a>

            </li>


            <?php if(is_array($menu)): foreach($menu as $key=>$v): ?><li class="<?php  if($v['pri_name'] == $sel_name) {echo active;} ?>">

                    <a href="javascript:;">
                        <i class="icon-cogs"></i>
                        <span class="title"><?php echo ($v["pri_name"]); ?></span>
                        <span class="arrow "></span>
                    </a>
                    <ul class="sub-menu">
                         <?php if(is_array($v["children"])): foreach($v["children"] as $key=>$v1): ?><li  class="<?php  if(ACTION_NAME==$v1['action_name']) echo 'active'; ?>">
                                <a href="/index.php/<?php echo ($v1["controller_name"]); ?>/<?php echo ($v1["model_name"]); ?>/<?php echo ($v1["action_name"]); ?>"><?php echo ($v1["pri_name"]); ?></a>
                            </li><?php endforeach; endif; ?>
                </ul>
                </li><?php endforeach; endif; ?>

            <!-- END SIDEBAR MENU -->

    </div>

    <!-- END SIDEBAR -->

    <!-- BEGIN PAGE -->

    <div class="page-content">

        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->

        <div id="portlet-config" class="modal hide">

            <div class="modal-header">

                <button data-dismiss="modal" class="close" type="button"></button>

                <h3>Widget Settings</h3>

            </div>

            <div class="modal-body">

                Widget settings form goes here

            </div>

        </div>
        <!-- BEGIN PAGE CONTAINER-->

        <div class="container-fluid">

            <!-- BEGIN PAGE HEADER-->

            <div class="row-fluid">

                <div class="span12">

                    <!-- BEGIN STYLE CUSTOMIZER -->

                    <div class="color-panel hidden-phone">

                        <div class="color-mode-icons icon-color"></div>

                        <div class="color-mode-icons icon-color-close"></div>

                        <div class="color-mode">

                            <p>THEME COLOR</p>

                            <ul class="inline">

                                <li class="color-black current color-default" data-style="default"></li>

                                <li class="color-blue" data-style="blue"></li>

                                <li class="color-brown" data-style="brown"></li>

                                <li class="color-purple" data-style="purple"></li>

                                <li class="color-grey" data-style="grey"></li>

                                <li class="color-white color-light" data-style="light"></li>

                            </ul>

                            <label>

                                <span>Layout</span>

                                <select class="layout-option m-wrap small">

                                    <option value="fluid" selected>Fluid</option>

                                    <option value="boxed">Boxed</option>

                                </select>

                            </label>

                            <label>

                                <span>Header</span>

                                <select class="header-option m-wrap small">

                                    <option value="fixed" selected>Fixed</option>

                                    <option value="default">Default</option>

                                </select>

                            </label>

                            <label>

                                <span>Sidebar</span>

                                <select class="sidebar-option m-wrap small">

                                    <option value="fixed">Fixed</option>

                                    <option value="default" selected>Default</option>

                                </select>

                            </label>

                            <label>

                                <span>Footer</span>

                                <select class="footer-option m-wrap small">

                                    <option value="fixed">Fixed</option>

                                    <option value="default" selected>Default</option>

                                </select>

                            </label>

                        </div>

                    </div>

                    <!-- END BEGIN STYLE CUSTOMIZER -->

                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->

                    <h3 class="page-title">

                        <?php echo ($titles["name"]); ?> <small></small>

                    </h3>

                    <ul class="breadcrumb">

                        <li>

                            <i class="icon-home"></i>

                            <a href="index.html"><?php echo ($titles["name"]); ?></a>

                            <i class="icon-angle-right"></i>

                        </li>

                        <li><a href="#"><?php echo ($titles["sub"]); ?></a></li>

                        <li class="pull-right no-text-shadow">

                            <div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">

                                <i class="icon-calendar"></i>

                                <span></span>

                                <i class="icon-angle-down"></i>

                            </div>

                        </li>

                    </ul>


                    <!-- END PAGE TITLE & BREADCRUMB-->

                </div>

            </div>
        

<link rel="stylesheet" type="text/css" href="<?php echo C('ADMIN_CSS_PATH');?>select2_metro.css" />

<link rel="stylesheet" href="<?php echo C('ADMIN_CSS_PATH');?>DT_bootstrap.css" />

<!-- END PAGE LEVEL STYLES -->

<link rel="shortcut icon" href="<?php echo C('ADMIN_IMG_PATH');?>favicon.ico" />

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box blue">

							<div class="portlet-title">

								<div class="caption"><i class="icon-edit"></i>订单详情</div>

								<div class="tools">

									<a href="javascript:;" class="collapse"></a>

									<a href="#portlet-config" data-toggle="modal" class="config"></a>

									<a href="javascript:;" class="reload"></a>

									<a href="javascript:;" class="remove"></a>

								</div>

							</div>

							<div class="portlet-body">

								<div class="clearfix">

									<div class="btn-group">

										<!--<button id="sample_editable_1_new" class="btn green">-->
											<!--<button id="" class="btn green">
											<a href="<?php echo U('Admin/Goods/Goods_add');?>">添加产品 </a><i class="icon-plus"></i>

										</button>-->

									</div>

									<div class="btn-group pull-right">

										<!--<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="icon-angle-down"></i>

										</button>-->

										<ul class="dropdown-menu pull-right">

											<li><a href="#">Print</a></li>

											<li><a href="#">Save as PDF</a></li>

											<li><a href="#">Export to Excel</a></li>

										</ul>

									</div>

								</div>

							<!--	<table class="table table-striped table-hover table-bordered" id="sample_editable_1">-->
								<table class="table table-striped table-hover table-bordered" >

									<thead>

                                    <tr>
                                  <th colspan="3">订单详细信息</th>
                                    </tr>
                                    </thead>

                                    <tbody>
									<tr>
									<td width="15%">订单ID</td>
									<td><?php echo ($orderinfo["order_id"]); ?></td>
									<td width="10%"></td>
									</tr>
									<tr>
										<td>订单编号</td>
										<td><?php echo ($orderinfo["order_number"]); ?></td>
										<td></td>
									</tr>
									<tr>
										<td>订单总价格</td>
										<td><?php echo ($orderinfo["order_price"]); ?></td>
										<td>修改</td>
									</tr>
									<tr>
										<td>支付方式</td>
										<td><?php echo ($orderinfo["order_pay"]); ?></td>
										<td></td>
									</tr>
									<tr>
										<td>订单收货地址</td>
										<td><?php echo ($orderinfo["cgn"]); ?></td>
										<td>修改</td>
									</tr>
									<tr>
										<td>发票抬头</td>
										<td><?php echo ($orderinfo["order_fapiao_title"]); ?></td>
										<td>修改</td>
									</tr>
									<tr>
										<td>发票内容</td>
										<td><?php echo ($orderinfo["order_fapiao_content"]); ?></td>
										<td>修改</td>
									</tr>
									<tr>
										<td>订单是否发货</td>
										<td><?php echo ($orderinfo["is_send"]); ?></td>
										<td>修改</td>
									</tr>
									<tr>
										<td>订单是否支付</td>
										<td><?php echo ($orderinfo["order_status"]); ?></td>
										<td>修改</td>
									</tr>
									</tbody>


								</table>

								<table class="table table-striped table-hover table-bordered" >

									<thead>

									<tr>
										<th colspan="3">订单关联商品信息</th>
									</tr>
									</thead>

									<tbody>
									<tr>
										<td >商品ID</td>
										<td>商品名称</td>
										<td >商品单格</td>
										<td >商品数量</td>
										<td >合计价格</td>
									</tr>
									<?php if(is_array($ordergoods)): foreach($ordergoods as $key=>$v): ?><tr>
										<td><?php echo ($v["goods_id"]); ?></td>
										<td><?php echo ($v["goods_name"]); ?></td>
										<td><?php echo ($v["goods_price"]); ?></td>
										<td><?php echo ($v["goods_number"]); ?></td>
										<td><?php echo ($v["goods_total_price"]); ?></td>
									</tr><?php endforeach; endif; ?>

									</tbody>
								</table>
								<div style="width: 900px;height: 500px;">
									<style type="text/css">
										*{
											margin:0px;
											padding:0px;
										}
										body, button, input, select, textarea {
											font: 12px/16px Verdana, Helvetica, Arial, sans-serif;
										}
										p{
											width:603px;
											padding-top:3px;
											margin-top:10px;
											overflow:hidden;
										}
										input#address{
											width:300px;
										}
										#container {
											min-width:603px;
											min-height:500px;
										}
									</style>
									<script charset="utf-8" src="http://map.qq.com/api/js?v=2.exp"></script>
									<script>
                                        var geocoder,map,marker = null;
                                        var init = function() {
                                            var center = new qq.maps.LatLng(39.916527,116.397128);
                                            map = new qq.maps.Map(document.getElementById('container'),{
                                                center: center,
                                                zoom: 15
                                            });
                                            //调用地址解析类
                                            geocoder = new qq.maps.Geocoder({
                                                complete : function(result){
                                                    map.setCenter(result.detail.location);
                                                    var marker = new qq.maps.Marker({
                                                        map:map,
                                                        position: result.detail.location
                                                    });
                                                }
                                            });
                                        }



                                        function codeAddress() {
                                            var address = "<?php echo ($orderinfo["cgn"]); ?>" ;
                                            //通过getLocation();方法获取位置信息值
                                            //var address = document.getElementById("address").value;
                                            //通过getLocation();方法获取位置信息值
                                            geocoder.getLocation(address);
                                        }
                                        function f123(){
                                            codeAddress();
                                            //alert('你好啊');
										}
                                        window.onload= f123() ;
									</script>
									</head>
									<body onload="init()">
									<div>
										<input id="address" type="textbox" value="<?php echo ($orderinfo["cgn"]); ?>" >
										<button onclick="codeAddress()">search</button>

									</div>
									<div id="container"></div>

								</div>




								<div class="form-actions">
									<button type="submit" class="btn green" style="background-color: rgb(74, 141, 247); ">修改订单</button>
								</div>

							</div>

						</div>

						<!-- END EXAMPLE TABLE PORTLET-->

					</div>

				</div>

				<!-- END PAGE CONTENT -->

			</div>

			<!-- END PAGE CONTAINER-->

		</div>

		<!-- END PAGE -->

	</div>

	<!-- END CONTAINER -->

	<!-- BEGIN FOOTER -->


<!-- BEGIN CORE PLUGINS -->
<!-- END CORE PLUGINS -->
<div class="footer">
    <div class="footer-inner">
    </div>

    <div class="footer-tools">
			<span class="go-top">
			<i class="icon-angle-up"></i>
			</span>
    </div>

</div>


<script src="<?php echo C('ADMIN_JS_PATH');?>jquery-1.10.1.min.js" type="text/javascript"></script>

<script src="<?php echo C('ADMIN_JS_PATH');?>jquery-migrate-1.2.1.min.js" type="text/javascript"></script>

<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->

<script src="<?php echo C('ADMIN_JS_PATH');?>jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="<?php echo C('ADMIN_JS_PATH');?>bootstrap.min.js" type="text/javascript"></script>

<!--[if lt IE 9]>

<script src="<?php echo C('ADMIN_JS_PATH');?>excanvas.min.js"></script>

<script src="<?php echo C('ADMIN_JS_PATH');?>respond.min.js"></script>

<![endif]-->

<script src="<?php echo C('ADMIN_JS_PATH');?>jquery.slimscroll.min.js" type="text/javascript"></script>

<script src="<?php echo C('ADMIN_JS_PATH');?>jquery.blockui.min.js" type="text/javascript"></script>

<script src="<?php echo C('ADMIN_JS_PATH');?>jquery.cookie.min.js" type="text/javascript"></script>

<script src="<?php echo C('ADMIN_JS_PATH');?>jquery.uniform.min.js" type="text/javascript" ></script>



	<!-- END CORE PLUGINS -->

	<!-- BEGIN PAGE LEVEL PLUGINS -->

	<script type="text/javascript" src="<?php echo C('ADMIN_JS_PATH');?>select2.min.js"></script>

	<script type="text/javascript" src="<?php echo C('ADMIN_JS_PATH');?>jquery.dataTables.js"></script>

	<script type="text/javascript" src="<?php echo C('ADMIN_JS_PATH');?>DT_bootstrap.js"></script>

	<!-- END PAGE LEVEL PLUGINS -->

	<!-- BEGIN PAGE LEVEL SCRIPTS -->

	<script src="<?php echo C('ADMIN_JS_PATH');?>app.js"></script>

	<script src="<?php echo C('ADMIN_JS_PATH');?>table-editable.js"></script>    

	<script>
		var c_url="<?php echo U('Goods/goods_del','',false);?>";
		jQuery(document).ready(function() {       

		   App.init();

		   TableEditable.init();

		});

	</script>

</body>

<!-- END BODY -->

</html>