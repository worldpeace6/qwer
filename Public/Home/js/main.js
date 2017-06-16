//轮播图自动切换：
$(document).ready(function(){
	$('.carousel').carousel({
		interval:3000
	})
});

//首页
$( window ).on( "load", function(){
    $(".nav_bar .navLi").click(
        function(){
            $(this).find(".navMenu").slideToggle(0);
        });
    $(".nav_toggle").on("click",function(){
		$(".nav_bar").slideToggle(200);
	})
})

//产品中心
$(function(){
	$('.pro_list-content .container ol li .box .box1').hover(function(){
		$('.mask',this).stop().fadeIn();
	},function(){
		$('.mask',this).stop().fadeOut();
	});
});

//产品中心详情
function preview(img){
	$("#preview .jqzoom img").attr("src",$(img).attr("src"));
	$("#preview .jqzoom img").attr("jqimg",$(img).attr("bimg"));
}


//全选
function allCheck() {
	var obj = document.getElementsByTagName("input");
	if(document.getElementById("all").checked == true) {
		for(var i = 0; i < obj.length; i++) {
			obj[i].checked = true;
		}
	} else {
		for(var i = 0; i < obj.length; i++) {
			obj[i].checked = false;
		}
	}
}

function checkT_F() {
	var obj = document.getElementsByTagName("input");
	var j = 0;
	for(var i = 0; i < obj.length; i++) {
		if(obj[i].id != 'all') {
			if(obj[i].checked == true) {
				j++;
			}
		}
	}
	if(j == (obj.length - 1)) {
		document.getElementById("all").checked = true;
	} else {
		document.getElementById("all").checked = false;
	}
}

//收货地址
function changeBg(link) {
	var alllinks = document.getElementById("mylink").getElementsByTagName("li");
	for (var i = 0; i < alllinks.length; i++) {
		alllinks[i].className = "border";
	}
	link.className = "border2";
}

//确认订单
function changeBgB(link) {
	var alllinks = document.getElementById("mylinkB").getElementsByTagName("li");
	for (var i = 0; i < alllinks.length; i++) {
		alllinks[i].className = "borderB";
	}
	link.className = "borderBtow";
}
//支付页
function changeBgC(link) {
	var alllinks = document.getElementById("mylinkC").getElementsByTagName("li");
	for (var i = 0; i < alllinks.length; i++) {
		alllinks[i].className = "borderC";
	}
	link.className = "borderCtow";
}

//产品详情
function color(link) {
	var alllinks = document.getElementById("color").getElementsByTagName("a");
	for (var i = 0; i < alllinks.length; i++) {
		alllinks[i].className = "color";
	}
	link.className = "colortwo";
}

//购物车
function sum1(obj) {
	var a = document.getElementById("number1");
	var b = document.getElementById("price1");
	var s = document.getElementById("myspan1");
	if(a.value=='') {
		alert("请选择或输入一个商品数量")
	}
	s.innerHTML = parseInt(a.value) * parseInt(b.innerHTML) + ".00";
//	document.getElementById("total").innerHTML = parseInt(number1.value) * parseInt(price1.innerHTML) + parseInt(number2.value) * parseInt(price2.innerHTML) + parseInt(number3.value) * parseInt(price3.innerHTML) + parseInt(number4.value) * parseInt(price4.innerHTML) + ".00";
}
function sum2(obj) {
	var a = document.getElementById("number2");
	var b = document.getElementById("price2");
	var s = document.getElementById("myspan2");
	if(a.value=='') {
		alert("请选择或输入一个商品数量")
	}
	s.innerHTML = parseInt(a.value) * parseInt(b.innerHTML) + ".00";
//	document.getElementById("total").innerHTML = parseInt(number1.value) * parseInt(price1.innerHTML) + parseInt(number2.value) * parseInt(price2.innerHTML) + parseInt(number3.value) * parseInt(price3.innerHTML) + parseInt(number4.value) * parseInt(price4.innerHTML) + ".00";
}
function sum3(obj) {
	var a = document.getElementById("number3");
	var b = document.getElementById("price3");
	var s = document.getElementById("myspan3");
	if(a.value=='') {
		alert("请选择或输入一个商品数量")
	}
	s.innerHTML = parseInt(a.value) * parseInt(b.innerHTML) + ".00";
//	document.getElementById("total").innerHTML = parseInt(number1.value) * parseInt(price1.innerHTML) + parseInt(number2.value) * parseInt(price2.innerHTML) + parseInt(number3.value) * parseInt(price3.innerHTML) + parseInt(number4.value) * parseInt(price4.innerHTML) + ".00";
}
function sum4(obj) {
	var a = document.getElementById("number4");
	var b = document.getElementById("price4");
	var s = document.getElementById("myspan4");
	if(a.value=='') {
		alert("请选择或输入一个商品数量")
//	if(a.value === "") {
//		s.innerHTML = "0";
	}
	s.innerHTML = parseInt(a.value) * parseInt(b.innerHTML) + ".00";
//	document.getElementById("total").innerHTML = parseInt(number1.value) * parseInt(price1.innerHTML) + parseInt(number2.value) * parseInt(price2.innerHTML) + parseInt(number3.value) * parseInt(price3.innerHTML) + parseInt(number4.value) * parseInt(price4.innerHTML) + ".00"
}

//
function select1(obj) {
	var sel = document.getElementById("one");
	var selected_val = sel.options[sel.selectedIndex].value;
	var b = document.getElementById("price1");
	var s = document.getElementById("myspan1");
	s.innerHTML = parseInt(selected_val) * parseInt(b.innerHTML) + ".00";
//	document.getElementById("total").innerHTML = parseInt(document.getElementById("one").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("two").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("three").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("four").value) * parseInt(price1.innerHTML) + ".00";

}
function select2(obj) {
	var sel = document.getElementById("two");
	var selected_val = sel.options[sel.selectedIndex].value;
	var b = document.getElementById("price2");
	var s = document.getElementById("myspan2");
	s.innerHTML = parseInt(selected_val) * parseInt(b.innerHTML) + ".00";
//	document.getElementById("total").innerHTML = parseInt(document.getElementById("one").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("two").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("three").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("four").value) * parseInt(price1.innerHTML) + ".00";

}
function select3(obj) {
	var sel = document.getElementById("three");
	var selected_val = sel.options[sel.selectedIndex].value;
	var b = document.getElementById("price3");
	var s = document.getElementById("myspan3");
	s.innerHTML = parseInt(selected_val) * parseInt(b.innerHTML)+ ".00";
//	document.getElementById("total").innerHTML = parseInt(document.getElementById("one").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("two").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("three").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("four").value) * parseInt(price1.innerHTML) + ".00";

}
function select4(obj) {
	var sel = document.getElementById("four");
	var selected_val = sel.options[sel.selectedIndex].value;
	var b = document.getElementById("price4");
	var s = document.getElementById("myspan4");
	s.innerHTML = parseInt(selected_val) * parseInt(b.innerHTML) + ".00";
//	document.getElementById("total").innerHTML = parseInt(document.getElementById("one").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("two").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("three").value) * parseInt(price1.innerHTML) + parseInt(document.getElementById("four").value) * parseInt(price1.innerHTML) + ".00";

}

function fun(){
	var checks = document.getElementsByName("shop");
	var n = 0;
	var a = 0;
	for(i=0;i<checks.length;i++){
		if(checks[i].checked){
			/*alert(123)*/
			n+=1;
			a+=parseInt($(".shop_cart-list label").find(".gwc").html())
		}
		document.getElementById("add").innerHTML = n;
		$("#total").html(a+".00")
	}
	
}























