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
 
<link rel="stylesheet" type="text/css" href="/Public/Admin/upload/Huploadify.css"/>
<script type="text/javascript" src="/Public/Admin/upload/jquery.js"></script>
<script type="text/javascript" src="/Public/Admin/upload/jquery.Huploadify.js"></script>
<div class="panel admin-panel">
  <div class="panel-head" id="add"><strong><span class="icon-pencil-square-o"></span>增加内容</strong></div>
  <div class="body-content">
    <form method="post" class="form-x" enctype="multipart/form-data" action="">  
      <div class="form-group">
        <div class="label">
          <label>新闻标题：</label>
        </div>
        <div class="field">
          <input type="text" class="input w50" value="<?php echo ((isset($news["name"]) && ($news["name"] !== ""))?($news["name"]):''); ?>" name="name"  />
          <div class="tips"></div>
        </div>
      </div>
   


      <div class="form-group">
        <div class="label">
          <label>新闻分类：</label>
        </div>
        <div class="field">
          <select class="input w50" name="class_id">
			<option value="0">请选择新闻分类</option>
				<?php if(is_array($c)): foreach($c as $key=>$v): ?><option value="<?php echo ($v['id']); ?>" <?php if(($news['class_id']) == $v["id"]): ?>selected<?php endif; ?>><?php echo ($v['c_name']); ?></option><?php endforeach; endif; ?>
		  </select>
        </div>
      </div>
	  


	  <div class="form-group">
        <div class="label">
          <label>商品图片：</label>
        </div>
        <div class="field">
			<div id="upload"></div>
			<div>
			<div id="queque_list">
				<?php if(!empty($_GET['id'])): if(is_array($news['news_img'])): foreach($news['news_img'] as $key=>$pic): ?><dl style="float:left;margin-right:20px;" id="1">
							<dt style="border:1px solid #01a1ff;padding:5px;">
								<img src="/<?php echo ($pic['photo']); ?>" width="100" height="100">
							</dt>
							<dd style="text-align:center;">
								
								<button onclick="removepic(this)" type="button">删除</button>
								<input type="hidden" name="pic[]" value="Public/Uploads/2017-06-09/5939fa4cdd7d0.jpg">
							</dd>
						</dl><?php endforeach; endif; endif; ?>
			</div>
			</div>
        </div>
      </div>  


	  
	  <div class="form-group">
        <div class="label">
          <label>新闻详情：</label>
        </div>
		<div class="field">
            <!-- 加载编辑器的容器 -->
			<textarea id="container" name="content" type="text/plain"><?php echo ($news['news_desc']['content']); ?></textarea>
			<!-- 配置文件 -->
			<script type="text/javascript" src="/Public/Admin/ueditor/ueditor.config.js"></script>
			<!-- 编辑器源码文件 -->
			<script type="text/javascript" src="/Public/Admin/ueditor/ueditor.all.js"></script>
			<!-- 实例化编辑器 -->
			<script type="text/javascript">
				var ue = UE.getEditor('container');
			</script>
		</div>
      </div>

      <div class="form-group">
        <div class="label">
          <label></label>
        </div>
        <div class="field">
          <button class="button bg-main icon-check-square-o" type="submit"> 提交</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script type="text/javascript">
	$(function(){
		$('#upload').Huploadify({
			auto:true,
			fileTypeExts:'*.jpg;*.png;*.exe',
			multi:true,
			formData:{key:123456,key2:'vvvv'},
			fileSizeLimit:9999,
			showUploadedPercent:true,//是否实时显示上传的百分比，如20%
			showUploadedSize:true,
			removeTimeout:99999,
			uploader:'<?php echo U("Goods/upload");?>',
			
			fileObjName:'pic',
			onUploadStart:function(){
				//alert('开始上传');
				},
			onInit:function(){
				//alert('初始化');
				},
			onUploadComplete:function(){
				//alert('上传完成');
				},
			onDelete:function(file){
				console.log('删除的文件：'+file);
				console.log(file);
			},
			 onUploadSuccess: function(file, data, response) {
			 console.log(file);
			 var data = eval("("+data+")");
			 if(data.code == 0){
			 var html = '<dl style="float:left;margin-right:20px;" id="'+file.id+'">'+
							'<dt style="border:1px solid #01a1ff;padding:5px;">'+
							   '<img src="/'+data.path+'" width="100" height="100">'+
							'</dt>'+
							'<dd style="text-align:center;">'+
								// '<button onclick="main(this)" type="button">主图</button>'+
								'<button onclick="removepic(this)" type="button">删除</button>'+
								'<input type="hidden" name="pic" value="'+data.path+'">'+
							'</dd>'+
						'</dl>';
					$('#queque_list').append(html);
				}
			}
			});
		});
	// function main(o){
	// //alert(0);
	// 	$(o).parents('#queque_list').find('input[type="hidden"]').prop('name','pic');
	// 	$(o).nextAll('input[type="hidden"]').prop('name','image');
		
	// 	$(o).parents('#queque_list').find('dt').css({border:'1px solid #01a1ff'});
	// 	$(o).parents('dl').find('dt').css({border:'1px solid red'});
		
	//}
		
	function removepic(o){
	//alert(0);
		$(o).parents('dl').remove();
	}	

    function add_spec(){

      $.ajax({
        type:'get',
        url:'<?php echo U("Goods/add_spec");?>',
        data:{},
        dataType:'html',
        success:function(data){
          layer.open({
            type:1,
            skin:'layui-layer-rim',
            area:['450px','240px'],
            content:data,
          });
        }
      });
    }
		
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