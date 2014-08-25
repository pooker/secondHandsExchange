<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<base href="<?=base_url()?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>用户管理</title>
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
  <h1>用户列表</h1>
  <table class="table">
          <thead>
            <tr>
              <th class="col-md-1">id</th>
              <th class="col-md-2">用户名</th>
              <th class="col-md-3">邮箱</th>
              <th class="col-md-2">注册时间</th>
              <th class="col-md-2">最后登录</th>
              <th class="col-md-1">Active</th>
              <th class="col-md-1">操作</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach ($users as $user):?>
          <tr>
          	<td><?php echo $user->id;?></td>
          	<td><?php echo $user->username;?></td>
          	<td><?php echo $user->email;?></td>
          	<td><?php echo date('Y-m-d H:i:s',$user->created_on);?></td>
          	<td><?php echo date('Y-m-d H:i:s',$user->last_login);?></td>
          	<td><?php echo $user->active;?></td>
          	<td><a class="btn btn-danger btn-xs" href=<?php echo 'index.php/home/delete/'.$user->id;?> role="button">删除</a></td>
          
          </tr>
          <?php endforeach;?>
          </tbody>
          </table>
</div>

</body>