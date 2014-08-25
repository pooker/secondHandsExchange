<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <base href="<?= base_url() ?>"/>
    <base href="<?= base_url() ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <script src="application/third_party/jquery.js"></script>
    <link
        href="application/third_party/bootstrap/dist/css/bootstrap.min.css"
        rel="stylesheet">
    <link href="application/third_party/bootstrap/myStyle.css"
          rel="stylesheet">
    <link rel="shortcut icon" href="application/third_party/images/icon.ico"/>
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


<nav class="navbar navbar-default navag" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1"><span class="sr-only">Toggle
navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span>
            <span class="icon-bar"></span></button>
        <!--<a class="navbar-brand" href="#"><span><img src="logo.svg" /></span></a>-->
        <div><a href="index.php/home"><img src="application/third_party/images/logo.png" class="brand"/></a></div>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            <li <?php echo ($page == '1') ? "class='active'" : ""; ?>><?php echo anchor('home/get_good/1', '电脑数码'); ?></li>
            <li <?php echo ($page == '2') ? "class='active'" : ""; ?>><?php echo anchor('home/get_good/2', '图书音像'); ?></li>
            <li <?php echo ($page == '3') ? "class='active'" : ""; ?>><?php echo anchor('home/get_good/3', '文体用品'); ?></li>
            <li <?php echo ($page == '4') ? "class='active'" : ""; ?>><?php echo anchor('home/get_good/4', '衣服鞋子'); ?></li>
            <li <?php echo ($page == '5') ? "class='active'" : ""; ?>><?php echo anchor('home/get_good/5', '生活用品'); ?></li>
            <li <?php echo ($page == '6') ? "class='active'" : ""; ?>><?php echo anchor('home/get_good/6', '小家电'); ?></li>

        </ul>

        <?php
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in()){
        //redirect them to the login page
        ?>

        <div class="nav navbar-nav navbar-right">
            <button class="btn btn-link btn-sm" data-toggle="modal"
                    data-target="#loginModal">登录
            </button>
            <a href="index.php/home/reg" class="btn btn-link btn-sm">注册</a>
            <!-- Modal -->
            <div class="modal fade" id="loginModal" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog login-model">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">登录</h4>
                        </div>
                        <div class="modal-body">

                            <?php if ($message && $this->data['page'] == '7'): ?>
                                <script>
                                    $('#loginModal').modal();
                                </script>

                                <div class="alert alert-danger"><?php echo $message; ?></div>
                            <?php endif; ?>
                            <?php echo form_open(site_url('/auth/login'), 'class="form-horizontal" role="form" method = "post"'); ?>


                            <div class="form-group">
                                <?php echo form_input('identity', '', 'type="email" class="form-control" placeholder="邮箱地址"'); ?>
                            </div>
                            <div class="form-group">

                                <input name='password' type="password" class="form-control" id="password"
                                       placeholder="密码">
                            </div>


                            <div class="checkbox">
                                <label>
                                    <?php echo form_checkbox('remember', '1', true, 'id="remember" type = "checkbook" '); ?>
                                    记住我？
                                </label>
                                <a href="forgot_password"><?php echo '忘记密码？'; ?></a>

                            </div>

                            <?php echo form_submit('submit', '登录', 'type="button" class="btn btn-primary btn-block"'); ?>

                            <?php echo form_close(); ?>


                        </div>
                    </div>

                    <!-- /.modal-content --></div>
                <!-- /.modal-dialog --></div>
            <!-- /.modal -->


            <!-- 	<ul class="nav navbar-nav navbar-right">
      <li><?php echo anchor('auth/login','登录')?></li>
	<li><?php echo anchor('home/reg','注册')?></li>
	</ul>
	
	 -->
            <?php
            }

            else {
                //set the flash data error message if there is one
                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                //list the users
                $this->data['users'] = $this->ion_auth->users()->result();
                foreach ($this->data['users'] as $k => $user) {
                    $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
                }

                //$this->load->view('home/index', $this->data);

                ?>
                <ul class="nav navbar-nav navbar-right dropdown">
                    <li class=""><a class="dropdown-toggle"
                                    data-toggle="dropdown"><?php echo $this->session->userdata('username'); ?>
                            <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor('home/order', '我出售的物品') ?></li>
                            <li><?php echo anchor('home/add_good', '我要发布二手') ?></li>
                            <li class="divider"></li>
                            <li><?php echo anchor('auth/logout', '退出登录') ?></li>
                        </ul>
                    </li>
                </ul>
            <?php } ?>

        </div>
    </div>
    <!-- /.navbar-collapse -->
</nav>



