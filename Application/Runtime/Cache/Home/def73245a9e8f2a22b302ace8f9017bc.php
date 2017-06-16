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
<div class="pro_center-content">
	<div class="container">
		<div class="pro_center-banner">
			<a href="###"><img src="/Public/Home/images/pro_center-banner.jpg"></a>
		</div>
		<div class="pro_center-location">
			<p><a href="index.html">首页</a>><a href="pro_list.html">产品中心</a>><a href="###">隔尿垫</a></p>
		</div>
		<ul>
			<li><a href="pro_list.html">隔尿垫</a></li>
			<li><a href="pro_list.html">尿布</a></li>
			<li><a href="pro_list.html">凉席</a></li>
			<li><a href="pro_list.html">毯被</a></li>
			<li><a href="pro_list.html">睡袋</a></li>
			<li><a href="pro_list.html">护栏婴儿</a></li>
		</ul>
		<div class="pro_center-details">
			<div class="preview">
				<div id="preview" class="spec-preview">
					<span class="jqzoom"><img src="/<?php echo ($goods['image']); ?>"></span>
				</div>
				<div class="spec-scroll">
					<div class="items">
						<ol>
						<?php if(is_array($img)): foreach($img as $key=>$v): ?><li><img src="/<?php echo ($v['photo']); ?>" onmousemove="preview(this);"></li><?php endforeach; endif; ?>	
						</ol>
					</div>
				</div>
				<div class="pro_com"><span>承诺</span><span>15天退货</span><span>运费险</span><span>公益宝贝</span></div>
				<div class="pro_pay"><span>支付</span><span>快捷支付</span><span>信用卡支付</span><span>余额宝支付</span><span>蚂蚁花呗</span></div>
			</div>
			<div class="right">
				<h3><?php echo ($goods['goods_name']); ?></h3>
				<div class="pro-con"><?php echo ($desc['content']); ?></div>
				<div class="box1">
					<?php if(is_array($group)): foreach($group as $key=>$value): ?><div class="pro-spec"><?php echo ($key); ?>：
						<?php if(is_array($value)): foreach($value as $key=>$val): ?><span class="item" style="margin-left:10px" ><?php echo ($val['item']); ?></span><?php endforeach; endif; ?>
					</div><?php endforeach; endif; ?>
					<style>
						.item{cursor:pointer} 
					</style> 					
					<div class="pro-price">本店价格：<span>￥<?php echo ($goods['shop_price']); ?></span></div>
					<div class="pro-price">参考价格：<span>￥<?php echo ($goods['market_price']); ?></span></div>
<!-- 					<?php if(is_array($group)): foreach($group as $key=>$value): ?><div class="pro-color" id="color"><?php echo ($key); ?>：
							<?php if(is_array($value)): foreach($value as $key=>$val): ?><a class="color" href="###" onclick="color(this);"><?php echo ($val['item']); ?></a><?php endforeach; endif; ?>
						</div><?php endforeach; endif; ?> -->
					<div class="pro-dis">配送：上海 至
						<select>
							<option value="1">广州市天河区</option>
							<option value="2">广州市花都区</option>
							<option value="3">广州市越秀区</option>
							<option value="4">广州市白云区</option>
							<option value="5">广州市番禺区</option>
							<option value="6">深圳市龙华区</option>
						</select>
					</div>
					<div class="pro-courier">快递 免运费 17:00前付款，预计5月12日(周四)送达</div>
					<a href="shop_cart.html"><button name="buy">立即购买</button></a>
					<div class="pro-com"><span>承诺</span><span>15天退货</span><span>运费险</span><span>公益宝贝</span></div>
					<div class="pro-pay"><span>支付</span><span>快捷支付</span><span>信用卡支付</span><span>余额宝支付</span><span>蚂蚁花呗</span></div>
				</div>
				<div class="box2">
					<div class="com">累计评论<br>1000</div>
					<div class="succ">交易成功</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<script>
    $('.item').click(function(){
    	$(this).css({border:'1px solid red'}).siblings().css({border:'1px solid  transparent'});
    });
</script>
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