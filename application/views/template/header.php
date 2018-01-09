<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Money Manager</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link href="<?php echo base_url()?>login-register.css" rel="stylesheet" />
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="<?php echo base_url()?>" class="navbar-brand">Money Manager
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <?php if ($this->session->userdata('loggedin')): ?>
              <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                <ul class="nav navbar-nav">
                  <li class=""><a href="#">Transaction<span class="sr-only"></span></a></li>
                  <li><a href="#">Report</a></li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Separated link</a></li>
                      <li class="divider"></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li>
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
                        <p><?php echo $this->session->userdata('username')?></p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="#" class="btn btn-info btn-flat">Profile</a>
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
                  <li class="dropdown user user-menu">
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
      <div class="content-wrapper">
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
          <!-- Modal Login -->
          <div class="modal fade login" id="loginModal">
            <div class="modal-dialog login animated">
              <div class="modal-content">
               <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login with</h4>
              </div>
              <div class="modal-body">  
                <div class="box">
                 <div class="content">
                  <div class="social">
                    <a class="circle github" href="/auth/github">
                      <i class="fa fa-github fa-fw"></i>
                    </a>
                    <a id="google_login" class="circle google" href="/auth/google_oauth2">
                      <i class="fa fa-google-plus fa-fw"></i>
                    </a>
                    <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                      <i class="fa fa-facebook fa-fw"></i>
                    </a>
                  </div>
                  <div class="division">
                    <div class="line l"></div>
                    <span>or</span>
                    <div class="line r"></div>
                  </div>
                  <div class="error"></div>
                  <div class="form loginBox">
                    <form method="post" action="<?php echo base_url();?>Users/Login" accept-charset="UTF-8">
                      <input id="username" class="form-control" type="text" placeholder="Username" name="username" required="">
                      <input id="password" class="form-control" type="password" placeholder="Password" name="password" required="">
                      <button class="btn-login" type="submit">Login</button>
                    </form>
                  </div>
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
        </div>
        <!-- Modal Register -->
        <div class="modal fade login" id="registerModal">
          <div class="modal-dialog login animated">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Register</h4>
              </div>
              <div class="modal-body">  
                <div class="box">
                  <div class="content registerBox">
                    <div class="social">
                      <a class="circle github" href="/auth/github">
                        <i class="fa fa-github fa-fw"></i>
                      </a>
                      <a id="google_login" class="circle google" href="/auth/google_oauth2">
                        <i class="fa fa-google-plus fa-fw"></i>
                      </a>
                      <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                        <i class="fa fa-facebook fa-fw"></i>
                      </a>
                    </div>
                    <div class="division">
                      <div class="line l"></div>
                      <span>or</span>
                      <div class="line r"></div>
                    </div>
                    <div class="error"></div>
                    <div class="form">
                      <form method="post" action="<?php echo base_url();?>Users/Register" accept-charset="UTF-8">
                        <input class="form-control" type="text" placeholder="Email" name="username" required="">
                        <input id="password" class="form-control" type="password" placeholder="Password" name="password" required="">
                        <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation" required="">
                        <button class="btn-register" type="submit">Register</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
               <div class="forgot register-footer">
                 <span>Already have an account?</span>
                 <a href="#" data-toggle="modal" data-target="#loginModal #registerModal">Login</a>
               </div>
             </div>        
           </div>
         </div>
       </div>
     </section>

     <!-- Main content -->
     <section class="content">
      <div class="callout callout-info">
        <h4>Tip!</h4>

        <p>Add the layout-top-nav class to the body tag to get this layout. This feature can also be used with a
          sidebar! So use this class if you want to remove the custom dropdown menus from the navbar and use regular
          links instead.</p>
        </div>
        <div class="callout callout-danger">
          <h4>Warning!</h4>

          <p>The construction of this layout differs from the normal one. In other words, the HTML markup of the navbar
            and the content will slightly differ than that of the normal layout.</p>
          </div>
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Blank Box</h3>
            </div>
            <div class="box-body">
              The great content goes here
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
