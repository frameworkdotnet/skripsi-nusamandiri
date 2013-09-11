<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title><?php echo $meta_title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Seto El Kahfi">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Le styles -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->
	<link rel="shortcut icon" href="../assets/ico/favicon.png">
	<script type="text/javascript"><!--
	function validation(me) {
		if(me.email.value==''){
			alert('Email harus diisi!');
			me.email.focus();
			return false;
		}
		if(me.password.value==''){
			alert('Password harus diisi!');
			me.password.focus();
			return false;
		}
		return true;
	}
//-->
	</script>
</head>
<body>
	<div class="container">
		<form method="post" class="form-signin" action="<?php echo base_url(); ?>admin/login">
			<h2 class="form-signin-heading">Log In</h2>
			<input type="text" name="email" class="input-block-level" placeholder="Email">
			<input type="password" name="password" class="input-block-level" placeholder="Password">
			<?php if ($this->session->flashdata('msg')) echo $this->session->flashdata('msg'); ?>
			<?php echo validation_errors(); ?>
			<button class="btn btn-large btn-primary" type="submit">Log in</button>
		</form>

    </div> <!-- /container -->
</body>
</html>