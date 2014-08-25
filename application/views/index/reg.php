<div class = "content">

<div class="container">
<?php if($this->data['message']):?>
<script>
$('#regModal').modal();
</script>
<div class="alert alert-danger col-sm-10 col-sm-offset-2"><?php echo $this->data['message'];?></div>
<?php endif; // for error infomation?>



<?php echo form_open("auth/create_user",'class="form-horizontal" role="form"');?>

<div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name = "email" placeholder="邮箱地址">
    </div>
  </div>
  <div class="form-group">
    <label for="username" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" name = "username" placeholder="用户名只能是字母、数字、下划线的组合">
    </div>
  </div>
  <div class="form-group">
    <label for="password" class="col-sm-2 control-label">登录密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" name = "password" placeholder="长度不低于8位">
    </div>
  </div>
  <div class="form-group">
    <label for="password_confirm" class="col-sm-2 control-label">确认密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password_confirm" name = "password_confirm" placeholder="请确认密码">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary btn-block">注册</button>
    </div>
  </div>

</div>
</div>
