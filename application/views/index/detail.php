<script src="application/third_party/thumb/js/tb_lib_ce622a14.js"></script>
<link rel="stylesheet" href="application/third_party/thumb/images/divcss5.css" />
<script type="text/javascript" src="application/third_party/thumb/js/index.js"></script>
<div class = "content">
	<div ><!-- begin of the head -->
    


<div class ="info">
<?php if (isset($good)): foreach ($good as $a):?>
<div class="title">
<p><?php echo $a->title?></p>
</div>
<div >
<table class="more">
<tr>
<td class="col-md-4">方式：见面交易</td>
<td class="col-md-4"><?php echo $a->update_time;?></td>
<td class="col-md-4"><p class="price1"><?php echo $a->price;?>元</p></td>
</tr>
<tr>
<td>卖家：<?php echo $a->connector;?></td>
<td>地址：<?php echo $a->address;?></td>
<td>电话：<?php echo $a->phone;?></td>
</tr>
</table>
</div>
<?php endforeach;endif;?>
</div><!-- end of the head -->

<div class="clear"></div>
<div class = "des">
<div class="panel panel-info">
<div class="panel-heading">
  <h3 class="panel-title ">物品详情</h3>
  </div>
  
  <div class="panel-body">
    <?php if (isset($good)){ foreach ($good as $a){echo $a->description;}}?>
  </div>

</div>


</div>

</div>