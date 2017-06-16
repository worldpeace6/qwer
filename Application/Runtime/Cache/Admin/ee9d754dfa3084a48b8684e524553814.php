<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta name="renderer" content="webkit">
<title></title>
<link rel="stylesheet" href="/Public/Admin/css/pintuer.css">
<link rel="stylesheet" href="/Public/Admin/css/admin.css">
<script src="/Public/Admin/js/jquery.js"></script>
<script src="/Public/Admin/js/pintuer.js"></script>

<script type="text/javascript" src="/Public/Admin/layer/layer.js"></script>  


</head>
<body>
 <style>
#spec_list{padding:10px;}
#spec_list .tab{height:35px;border-bottom:1px solid #dedede;padding-left: 0;}
#spec_list .tab li{float: left;line-height: 35px;padding: 0 5px;cursor: pointer; width: 50px;}
#spec_list .tab li.cur{background: #01a1ff;}
#spec_list .body{padding: 10px;display: none;}
#spec_list .body.cur{display: block;}
#spec_list .body dl{clear:both;}
#spec_list .body dt,#spec_list .body dd{float: left;}
#spec_list .body dt{width: 30px;text-align: right;padding-right: 10px;}
#spec_list .body dd{padding: 0 10px;border:1px solid #dedede;margin-right: 5px;cursor: pointer;}
#spec_list .body dd.cur{background: #01a1ff;color: #fff;border: 1px solid #01a1ff;}
</style>

<div id="spec_list">
  <ul class="tab">
  <?php if(is_array($goods_type)): foreach($goods_type as $tk=>$type): ?><li <?php if(($tk) == "0"): ?>class="cur"<?php endif; ?>><?php echo ($type["type_name"]); ?></li><?php endforeach; endif; ?>
    
  </ul>
  <div class="tab_body">
  <?php if(is_array($goods_type)): foreach($goods_type as $k=>$t): ?><div class="body <?php if(($k) == "0"): ?>cur<?php endif; ?>">
      <?php if(is_array($t['spec'])): foreach($t['spec'] as $key=>$s): ?><dl>
            <dt><?php echo ($s["spec_name"]); ?></dt>
            <?php if(is_array($s['spec_items'])): foreach($s['spec_items'] as $key=>$i): ?><dd data-item-id="<?php echo ($i["id"]); ?>"><?php echo ($i["item"]); ?></dd><?php endforeach; endif; ?>
            <p style="clear:both;"></p>
        </dl><?php endforeach; endif; ?>
    </div><?php endforeach; endif; ?>
  </div>
  <button type="button" onclick="add_spec_items()">添加规格</button>
  <button type="button" onclick="close_windows()">取消</button>
</div>
<script>
  function add_spec_items(){
    var item_id = [];
    $('#spec_list dd.cur').each(function(){
      item_id.push($(this).attr('data-item-id'));
    });
    if(item_id.length == 0){
      layer.msg('请选择规格',{icon:5});
      return;
    }
    $.ajax({
      type:'post',
      data:{id:item_id},
      url:'<?php echo U("Goods/handel_group");?>',
      dataType:'html',
      success:function(data){
        $('#add_spec_body').html(data);
        close_windows();
      },
      error:function(e){}

    });
  }
  function close_windows(){
    layer.closeAll();
  }

  $('#spec_list .tab li').click(function(){
      $(this).parent().find('li').removeClass('cur');
      $(this).addClass('cur');
      var index = $('#spec_list .tab li').index(this);
      $('#spec_list .tab_body .body').css({display:'none'});
      $('#spec_list .tab_body .body').eq(index).css({display:'block'});
  }); 
  $('dd').click(function(){
        $(this).parents('.body').siblings().find('dd').removeClass('cur');
        $(this).toggleClass('cur');
  });
</script>
<script type="text/javascript">

//搜索
function changesearch(){	
		
}

//单个删除
function del(id,mid,iscid){
	if(confirm("您确定要删除吗?")){
		
	}
}

//全选
$("#checkall").click(function(){ 
  $("input[name='id[]']").each(function(){
	  if (this.checked) {
		  this.checked = false;
	  }
	  else {
		  this.checked = true;
	  }
  });
})

//批量删除
function DelSelect(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		var t=confirm("您确认要删除选中的内容吗？");
		if (t==false) return false;		
		$("#listform").submit();		
	}
	else{
		alert("请选择您要删除的内容!");
		return false;
	}
}

//批量排序
function sorts(){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		return false;
	}
}


//批量首页显示
function changeishome(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}

//批量推荐
function changeisvouch(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){
		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");	
		
		return false;
	}
}

//批量置顶
function changeistop(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();	
	}
	else{
		alert("请选择要操作的内容!");		
	
		return false;
	}
}


//批量移动
function changecate(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		

		Checkbox=true;	
	  }
	});
	if (Checkbox){		
		
		$("#listform").submit();		
	}
	else{
		alert("请选择要操作的内容!");
		
		return false;
	}
}

//批量复制
function changecopy(o){
	var Checkbox=false;
	 $("input[name='id[]']").each(function(){
	  if (this.checked==true) {		
		Checkbox=true;	
	  }
	});
	if (Checkbox){	
		var i = 0;
	    $("input[name='id[]']").each(function(){
	  		if (this.checked==true) {
				i++;
			}		
	    });
		if(i>1){ 
	    	alert("只能选择一条信息!");
			$(o).find("option:first").prop("selected","selected");
		}else{
		
			$("#listform").submit();		
		}	
	}
	else{
		alert("请选择要复制的内容!");
		$(o).find("option:first").prop("selected","selected");
		return false;
	}
}

</script>
</body>
</html>