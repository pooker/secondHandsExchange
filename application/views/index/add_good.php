<?php
	$htmlData = '';
	if (!empty($_POST['content1'])) {
		if (get_magic_quotes_gpc()) {
			$htmlData = stripslashes($_POST['content1']);
		} else {
			$htmlData = $_POST['content1'];
		}
	}
?>
<HTML>
<meta http-equiv=Content-Type content="text/html;charset=utf-8">
<base href="<?=base_url()?>" />
<head>
<script charset="utf-8"
	src="application/third_party/editor/kindeditor.js"></script>
<script charset="utf-8"
	src="application/third_party/editor/lang/zh_CN.js"></script>
<link rel="stylesheet" href="application/third_party/editor/themes/default/default.css" />
<link rel="stylesheet" href="application/third_party/editor/plugins/code/prettify.css" />
<script charset="utf-8" src="application/third_party/editor/plugins/code/prettify.js"></script>
<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="description"]', {
				cssPath : 'application/third_party/editor/plugins/code/prettify.css',
				uploadJson : 'application/third_party/editor/php/upload_json.php',
				fileManagerJson : 'application/third_party/editor/php/file_manager_json.php',
				allowFileManager : true,
				width :'960px',
				height :'400px',
				items : ['undo', 'redo', '|', 'preview','code', 'cut', 'copy', 'paste','|',
							 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
				         'italic', 'underline','|', 'justifyleft', 'justifycenter', 'justifyright',
				        'justifyfull', '|', 'image', 'multiimage','|','anchor', 'link', 'unlink', ],
				
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=form1]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=form1]')[0].submit();
					});
				}
			
					
			});
			prettyPrint();
		});
	</script>
</head>
<body>
<div class = "content">
<h1><?php echo lang('create_user_heading');?></h1>
<p><?php echo lang('create_user_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>
<div class="form-horizontal">
<?php echo form_open_multipart("home/add_good",'name = "form1" class="form-horizontal" role="form" ');?>

 <div class="form-group">
<label for = "title" class="col-xs-1 control-label")>标题</label>
<div class="col-xs-8 ">
<input type="text" name = "title" value="" class = "form-control">
</div>
</div>

 <div class="form-group">
<?php 
$options = array(
                  '1'  => '电脑数码',
                  '2'    => '图书音像',
                  '3'   => '文体用品',
                  '4' => '衣服鞋子',
      			  '5' => '生活用品',
      			  '6' => '小家电',
);
$js = "id = 'dropdown' class = 'dropdown form-control' "
      ?>
      
<label for = "catagery" class="col-sm-1 control-label")>分类</label>
<div class = "col-sm-2">
<?php echo form_dropdown('catagery',$options,'',$js);?>
</div>
</div>

 <div class="form-group">
<label for = "price" class = "col-xs-1 control-label">价格</label>
<div class="col-sm-2">
<?php echo form_input($price,'','class="form-control"');?>
</div>
</div>

<div class="form-group">
<label for="price" class="col-sm-1 control-label">地址</label>
<div class="col-sm-4">
<?php echo form_input($address,'','class="form-control"');?>
</div>
</div>
<div class="form-group">
<label for="connector" class="col-sm-1 control-label">联系人</label>
<div class="col-sm-4">
<?php echo form_input($connector,'','class="form-control"');?>
</div>
</div>
<div class="form-group">
<label for="phone" class="col-sm-1 control-label">电话</label>
<div class="col-sm-4">
<?php echo form_input($phone,'','class="form-control"');?>
</div>
</div>
<?php //echo form_label('图片', 'picture'); echo form_upload($picture,'','multiple');?>

<?php //$op = ' style="width:700px;height:500px;" visibility:hidden; '?> 

 <div class="form-group edit">
<label for="description" class="col-sm-1 control-label">详情：</label>
<?php echo htmlspecialchars($htmlData); ?>

<?php echo form_textarea($description,'','class="form-control col-sm-10" rows="9"');?>
</div>
<br>
<div class="form-group">
<?php echo form_submit('submit', "发布",'class="btn btn-primary col-sm-2 col-sm-offset-1"');?>
</div>
<?php echo form_close();?>
</div>

</div>
</body>