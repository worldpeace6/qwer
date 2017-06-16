<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="/Public/Home/css/bootstrap.css" />
		<link rel="stylesheet" href="/Public/Home/css/style.css"/>
		<script src="/Public/Home/js/jquery.js"></script>
		
		<title>首页</title>
	</head>
	<body>
		<!--header-->
		<div class="header">
			<div class="header-top">
				<div class="container">
					<div class="nav nav-pills">
						欢迎来到优逸斯！
						<a href="login.html">登录</a>
						|
						<a href="register.html">注册</a>
						<div class="header-rigth">
                   			<p>服务热线 400-828-0000</p>
                   		</div>
					</div>
				</div>
			</div>
			<div class="navbar">
				<div class="container">
					<div class="navbar-left">
						<a href="index.html"><img src="/Public/Home/images/logo.png"></a>
					</div>
					<ul class="nav navbar-nav">
						<li class="dropdown"><a href="index.html">首页</a></li>
						<li class="dropdown"><p>|</p></li>
						<li class="dropdown"><a href="brand_introduction.html">品牌介绍</a>
						</li>
						<li class="dropdown"><p>|</p></li>
						<li class="dropdown"><a href="news.html">新闻中心</a>
						</li>
						<li class="dropdown"><p>|</p></li>
						<li class="dropdown"><a href="<?php echo U('Goods/index');?>">产品中心</a>
						</li>
						<li class="dropdown"><p>|</p></li>
						<li class="dropdown"><a href="user.html">会员中心</a>
						</li>
						<li class="dropdown"><p>|</p></li>
						<li class="dropdown"><a href="contact_us.html">联系我们</a>
						</li>
						<li class="dropdown"><p>|</p></li>
					</ul>
				</div>
				<a href="javascript:;" class="nav_toggle"><span></span><span></span><span></span></a>
			</div>
			<div class="nav_bar">
	            <ul class="nav_ul">
	                <li class="navLi on" style="background:none;"><a href="index.html" title="首页" class="navA off">首页</a></li>
	                <li class="navLi">
	                    <a href="brand_introduction.html" title="品牌介绍" class="navA">品牌介绍</a>
	                </li>
	                <li class="navLi">
	                    <a href="news.html" title="新闻中心 " class="navA">新闻中心 </a>
	                </li>
	                <li class="navLi">
	                    <a href="pro_list.html" title="产品中心" class="navA">产品中心</a>
	                </li>
	                <li class="navLi">
	                    <a href="user.html" title="会员中心" class="navA">会员中心 </a>
	                </li>
	                <li class="navLi">
	                    <a href="contact_us.html" title="联系我们" class="navA">联系我们 </a>
	                </li>
	            </ul>  
	        </div>
		</div>
		
		<!--header end-->
 		<!--content-->
		<div class="index-content">
			<div class="index-banner">
				<div id="myCarousel" class="carousel slide">
					<ul class="carousel-inner">
						<li class="item active">
							<a href="###"><img src="/Public/Home/images/banner1.jpg" alt="First slide"></a>
						</li>
						<li class="item">
							<a href="###"><img src="/Public/Home/images/banner2.jpg" alt="Second slide"></a>
						</li>
						<li class="item">
							<a href="###"><img src="/Public/Home/images/banner3.jpg" alt="Third slide"></a>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="pic-box">
				<div class="index-pic">
					<div class="container">
						<ul>
							<li class="col-md-4"><a href="pro_center.html"><img src="/Public/Home/images/index-pic-01.png"></a></li>
							<li class="col-md-4"><a href="pro_center.html"><img src="/Public/Home/images/index-pic-02.png"></a></li>
							<li class="col-md-4"><a href="pro_center.html"><img src="/Public/Home/images/index-pic-03.png"></a></li>
						</ul>
					</div>
				</div>
			</div>
			
		</div>
		<!--content end-->
		<!--footer-->
		<div class="footer">
			<div class="container">
				<p>CopyRight © 2003 - 2015  版权所有 ICP证号： 闽ICP备16003468号-1</p>
			</div>
		</div>
		<!--footer end-->
		
		<!--[if lte IE 8]>
		<script type="text/javascript" src="js/respond.js" ></script>
		<script type="text/javascript" src="js/html5shiv.min.js" ></script>
		<![endif]-->
		<script type="text/javascript" src="/Public/Home/js/jquery.js" ></script>
		<script type="text/javascript" src="/Public/Home/js/bootstrap.js" ></script>
		<script type="text/javascript" src="/Public/Home/js/main.js" ></script>
	</body>
</html>