<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<base href="<?=base_url()?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>物品管理</title>
<script src="application/third_party/jquery.js"></script>
<link
	href="application/third_party/bootstrap/dist/css/bootstrap.min.css"
	rel="stylesheet">
<link href="application/third_party/bootstrap/myStyle.css"
	rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="application/third_party/bootstrap/dist/js/bootstrap.min.js"></script>
</head>
<body>

<div class = "content">
  <h1>物品列表</h1>
  <table class="table">
          <thead>
            <tr>
              <th class="col-md-1">id</th>
              <th class="col-md-1">分类</th>
              <th class="col-md-1">价格</th>
              <th class="col-md-3">标题</th>
              <th class="col-md-1">售出</th>
              <th class="col-md-1">地址</th>
              <th class="col-md-1">联系人</th>
              <th class="col-md-1">电话</th>
              <th class="col-md-1">时间</th>
              <th class="col-md-1">用户id</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($orders as $od):?>
          <tr>
          	<td><?php echo $od->id;?></td>
          	<td><?php echo $od->catagery;?></td>
          	<td><?php echo $od->price;?></td>
          	<td><?php echo $od->title;?></td>
          	<td><?php echo $od->soldout?></td>
          	<td><?php echo $od->address;?></td>
          	<td><?php echo $od->connector;?></td>
          	<td><?php echo $od->phone;?></td>
          	<td><?php echo $od->update_time;?></td>
          	<td><?php echo $od->sellor;?></td>
          
          </tr>
          <?php endforeach;?>
          </tbody>
          </table>
</div>

</body>