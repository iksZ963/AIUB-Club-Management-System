<!DOCTYPE html>
<html class="bg-dark-facebook">
    <head>
        <meta charset="UTF-8">
        <title>AIUB CLUB MANAGEMENT SYSTEM | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="description" content="Phoenixcoded">
		<meta name="keywords" content=", Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
		<meta name="author" content="Phoenixcoded">

<!--		<link href="--><?php //echo base_url(); ?><!--adminlte/css/bootstrap.min.css" rel="stylesheet" type="text/css" />-->
<!--		<link href="--><?php //echo base_url(); ?><!--adminlte/css/font-awesome.min.css" rel="stylesheet" type="text/css" />-->
		<link href="<?php echo base_url(); ?>assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

		<!-- Favicon icon -->
		<link rel="shortcut icon" href="<?php echo base_url(); ?>ablepro-lite/assets/images/favicon.png" type="image/x-icon">
		<link rel="icon" href="<?php echo base_url(); ?>ablepro-lite/assets/images/favicon.ico" type="image/x-icon">

		<!-- Google font-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

		<!-- Font Awesome -->
		<link href="<?php echo base_url(); ?>ablepro-lite/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!--ico Fonts-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/icon/icofont/css/icofont.css">

		<!-- Required Framework -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap/css/bootstrap.min.css">

		<!-- Style.css -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/css/main.css">

		<!-- Responsive.css-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/css/responsive.css">

		<!--color css-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/css/color/color-1.min.css" id="color"/>

		<!-- bash syntaxhighlighter css -->
		<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/syntaxhighlighter/styles/shCoreDjango.css"/>

		<!-- Select 2 css -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/select2/css/select2.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/select2/css/s2-docs.css">

		<!-- simple line icon -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/icon/simple-line-icons/css/simple-line-icons.css">

    </head>
    <body class="bg-dark-facebook">
        <?php echo form_open('Log_in_out/login_check'); ?>
        <div class="form-box" id="" style="margin-top: 13%;">
            <div class="header bg-primary">Sign In</div>

            <div class="body"  align="center">
                <div class="form-group" style="border: #2196F3 1px solid;">
                    <input type="text" name="userid" class="form-control" placeholder="User ID">
                </div>
                <div class="form-group" style="border: #2196F3 1px solid;">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>

                <div class="form-group" style="color: red;">
                    <?php echo validation_errors(); ?>
                </div>
                <div class="form-group" style="color: red;">
                    <?php echo $wrong_msg; ?>
                </div>
            </div>
            <div class="footer">
                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign in</button>
            </div>

        </div>

    </form>

</body>
</html>
