<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Money Manager</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  
  <link rel="stylesheet" href="<?php echo base_url()?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url()?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url()?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url()?>bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="<?php echo base_url()?>login-register.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo base_url()?>bower_components/mycss.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container" style="grid-auto-rows: 1fr;">
          <div class="navbar-header">
            <a href="<?php echo base_url()?>" class="navbar-brand">Money Manager</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <?php if ($this->session->userdata('loggedin')): ?>
            <?php 
            $wallet=$this->transaction_model->GetMoney($this->session->userdata('user_id'));
            $array = array(
              'wallet' => $wallet
              );
            
              $this->session->set_userdata( $array );?>
              <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                  <li id="buttonTransaction"><a href="<?php echo(base_url()); ?>Transaction">Transaction<span class="sr-only"></span></a></li>
                  <li id="buttonReport"><a href="<?php echo(base_url()); ?>Report">Report<span class="sr-only"></span></a></li>
                  <li id="buttonBudget"><a href="<?php echo(base_url());?>Budget">Budget<span class="sr-only"></span></a></li>
                </ul>

              </div>
              <!-- /.navbar-collapse -->
              <!-- Navbar Right Menu -->
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <!-- The user image in the navbar-->
                      <img src="<?php echo base_url()?>dist/img/user.png" class="user-image" alt="User Image">
                      <!-- hidden-xs hides the username on small devices so only the image appears. -->
                      <span class="hidden-xs"><?php echo($this->session->userdata('username')) ?></span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- The user image in the menu -->
                      <li class="user-header">
                        <img src="<?php echo base_url()?>dist/img/user.png" class="img-circle" alt="User Image">

                        <p class="profile-username text-center"><?php echo $this->session->userdata('username');?></p>
                        <p><?php echo(number_format($this->session->userdata('wallet'),0,",",".")); ?>₫ </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="#" class="btn btn-info btn-flat" data-toggle="modal" data-target="#profileModal">Profile</a>
                        </div>

                        <div class="pull-right">
                          <a href="<?php echo base_url();?>Users/Logout" class="btn btn-warning btn-flat">Sign out</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            <?php else: ?>
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <li>
                    <a href="#" data-toggle="modal" data-target="#loginModal">Login</a>

                  </li>
                  <li>
                    <a href="#" data-toggle="modal" data-target="#registerModal">Register</a>
                  </li>
                </ul>
              </div>
            <?php endif ?>
            <!-- /.navbar-custom-menu -->
          </div>
          <!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
      <div class="content-wrapper" style="background-image: url('<?php echo base_url();?>/dist/img/background.jpg'); background-size: cover; background-attachment: fixed;">
        <div class="container">


         <!-- Content Header (Page header) -->
         <section class="content-header">
          <?php if ($this->session->flashdata('message')): ?>
            <div class="alert alert-dismissible alert-warning">
              <p>
                <?php echo $this->session->flashdata('message'); ?>
              </p>
            </div>
          <?php endif; ?>
          <?php echo validation_errors('<div class="alert alert-dismissible alert-danger">','</div>'); ?>
          <div class="modal login fade" id="profileModal">
            <div class="modal-dialog login animated">
              <div class="modal-content">
               <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">User Profile</h4>
              </div>
              <div class="modal-body">  
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <div class="btn btn-info btn-flat fa fa-pencil" data-toggle="modal" data-target="#changePasswordModal"><span><i href="#" ></i></span> Password</div>
                    <img class="profile-user-img img-responsive img-circle" src="http://localhost/QLTCCN/dist/img/user.png" alt="User profile picture">
                    <form method="post" action="<?php echo base_url()?>Users/ChangeWallet">
                      <div class="form-group"><h3 class="profile-username text-center"><?php echo($this->session->userdata('username')) ?></h3>
                        <label for="">Số tiền hiện tại:</label>
                        <input type="number" class="form-control input-lg" style="text-align: center; background-color: white; color: black" name="wallet" value="<?php echo ($this->session->userdata('wallet'));?>" lang="en-150" ></input></div>
                        <div class="row">
                          <div class="col-md-4"></div>
                          <button class="btn btn-primary btn-flat col-md-4"><b>Save</b>
                          </button>
                          <div class=" col-md-4 pull-left">
                          </div>
                        </div>
                      </form>

                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="forgot login-footer">
                  <span>Looking to 
                    <a href="#" data-toggle="modal" data-target="#registerModal">create an account</a>?</span>
                  </div>
                </div>        
              </div>
            </div>
            <div class="modal fade login" id="changePasswordModal">
              <div class="modal-dialog login animated">
                <div class="modal-content">
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Change password</h4>
                </div>
                <div class="modal-body">  
                  <div class="box">
                   <div class="content">

                    <div class="error"></div>
                    <div class="form loginBox">
                      <form method="post" action="<?php echo base_url(); ?>Users/ChangePassword" accept-charset="UTF-8">
                        <div class="form-group"><input name="old_password" class="form-control" type="password" placeholder="Old password" required=""></div>
                        <div class="form-group"><input name="new_password" class="form-control" type="password" placeholder="New password" required=""></div>
                        <div class="form-group"><input name="new_password_confirm" class="form-control" type="password" placeholder="Confirm new password" required=""></div>
                        <button type="submit" class="btn btn-warning btn-flat btn-block">Change password</button>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="box">
                  <div class="content registerBox" style="display:none;">
                   <div class="form">
                    <form method="post" html="{:multipart=>true}" data-remote="true" action="/register" accept-charset="UTF-8">
                      <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                      <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                      <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                      <input class="btn btn-default btn-register" type="submit" value="Create account" name="commit">
                    </form>
                  </div>
                </div>
              </div>
            </div>       
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if ($this->session->userdata('loggedin')): ?>
        <div class="row">
          <div class="col-md-4 col-sm-3 col-xs-2"></div>
          <a href="#" class="alert alert-dismissible alert-success col-xs-8 col-md-4 col-sm-6 offset-md-4" data-toggle="modal" data-target="#profileModal">
            <h3 class="text-center"><?php echo(number_format($this->session->userdata('wallet'),0,",",".")); ?> ₫</h3>
          </a>
          <div class="col-md-4 col-sm-3 col-xs-2"></div>
        </div>
      <?php endif ?>
      <!-- /.content -->

