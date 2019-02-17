<?php $user_type = $this->session->ses_user_type;
$userid = $this->session->ses_userid;
$all_message = $this->Common_model->get_all_info('message');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>AIUB CLUB MANAGEMENT SYSTEM</title>
	<link rel="Tab Icon" type="image/png" href="<?php echo base_url(); ?>assets/img/fab.jpg"/>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!--	<link href="-->
	<?php //echo base_url(); ?><!--adminlte/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
	<!--	<link href="-->
	<?php //echo base_url(); ?><!--adminlte/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>-->
	<!--	<link href="--><?php //echo base_url(); ?><!--assets/css/w3.css" rel="stylesheet" type="text/css"/>-->
	<!--	<link href="-->
	<?php //echo base_url(); ?><!--adminlte/css/AdminLTE.css" rel="stylesheet" type="text/css"/>-->
	<link href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" type="text/css"/>
	<link rel="stylesheet" href="<?php echo base_url() ?>scripts/fullcalendar/fullcalendar.min.css"/>

	<!-- Favicon icon -->
	<link rel="shortcut icon" href="<?php echo base_url(); ?>ablepro-lite/assets/images/favicon.png"
		  type="image/x-icon">
	<link rel="icon" href="<?php echo base_url(); ?>ablepro-lite/assets/images/favicon.ico" type="image/x-icon">

	<!-- Google font-->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

	<!-- Font Awesome -->
	<link href="<?php echo base_url(); ?>ablepro-lite/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- iconfont -->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/icon/icofont/css/icofont.css">

	<!-- simple line icon -->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/icon/simple-line-icons/css/simple-line-icons.css">

	<!-- Required Fremwork -->
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap/css/bootstrap.min.css">

	<!-- Date Picker css -->
	<link rel="stylesheet"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css"/>

	<!-- Bootstrap Date-Picker css -->
	<link rel="stylesheet"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-datepicker/css/bootstrap-datetimepicker.css"/>
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-daterangepicker/daterangepicker.css"/>

	<!-- Select 2 css -->
	<link rel="stylesheet"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/select2/dist/css/select2.min.css"/>
	<link rel="stylesheet" type="text/css"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/select2/css/s2-docs.css">

	<!-- Multi Select css -->
	<link rel="stylesheet"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-multiselect/dist/css/bootstrap-multiselect.css"/>
	<link rel="stylesheet"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/multiselect/css/multi-select.css"/>

	<!-- Color Picker css -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/spectrum/spectrum.css"/>

	<!-- Tags css -->
	<link rel="stylesheet"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css"/>

	<!-- bash syntaxhighlighter css -->
	<link type="text/css" rel="stylesheet"
		  href="<?php echo base_url(); ?>ablepro-lite/assets/plugins/syntaxhighlighter/styles/shCoreDjango.css"/>

	<!-- Style.css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/css/main.css">

	<!-- Responsive.css-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/css/responsive.css">

	<!--color css-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>ablepro-lite/assets/css/color/color-1.min.css"
		  id="color"/>


	<script src="<?php echo base_url(); ?>assets/js/html5shiv.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>

	<!--Live Search-->
	<!--	<script src="--><?php //echo base_url(); ?><!--assets/js/jquery.min.js"></script>-->


	<!-- Required Jqurey -->
	<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/jquery/dist/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/tether/dist/js/tether.min.js"></script>

	<script src="<?php echo base_url() ?>scripts/fullcalendar/lib/moment.min.js"></script>
	<script src="<?php echo base_url() ?>scripts/fullcalendar/fullcalendar.min.js"></script>
	<script src="<?php echo base_url() ?>scripts/fullcalendar/gcal.js"></script>


</head>
<body class="skin-black">
<div class="loader-bg">
	<div class="loader-bar">
	</div>
</div>
<div class="wrapper">
	<!--   <div class="loader-bg">
    <div class="loader-bar">
    </div>
</div> -->
	<!-- Navbar-->
	<header class="main-header-top hidden-print">
		<a href="#!" class="logo">
			ACMS
		</a>
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#!" data-toggle="offcanvas" class="sidebar-toggle"></a>
			<!-- Navbar Right Menu-->
			<div class="navbar-custom-menu f-right">

				<ul class="top-nav">
					<!--Notification Menu-->

					<!--					<li class="dropdown notification-menu">-->
					<!--						<a href="#!" data-toggle="dropdown" aria-expanded="false" class="dropdown-toggle">-->
					<!--							<i class="icon-bell"></i>-->
					<!--							<span class="badge badge-danger header-badge">9</span>-->
					<!--						</a>-->
					<!--						<ul class="dropdown-menu">-->
					<!--							<li class="not-head">You have <b class="text-primary">4</b> new notifications.</li>-->
					<!--							<li class="bell-notification">-->
					<!--								<a href="javascript:;" class="media">-->
					<!--                                <span class="media-left media-icon">-->
					<!--                                    <img class="img-circle"-->
					<!--										 src="-->
					<?php //echo base_url(); ?><!--ablepro-lite/assets/images/avatar-1.png"-->
					<!--										 alt="User Image">-->
					<!--                                </span>-->
					<!--									<div class="media-body"><span class="block">Lisa sent you a mail</span><span-->
					<!--											class="text-muted block-time">2min ago</span></div>-->
					<!--								</a>-->
					<!--							</li>-->
					<!--							<li class="bell-notification">-->
					<!--								<a href="javascript:;" class="media">-->
					<!--                                    <span class="media-left media-icon">-->
					<!--                                        <img class="img-circle"-->
					<!--											 src="-->
					<?php //echo base_url(); ?><!--ablepro-lite/assets/images/avatar-2.png"-->
					<!--											 alt="User Image">-->
					<!--                                    </span>-->
					<!--									<div class="media-body"><span class="block">Server Not Working</span><span-->
					<!--											class="text-muted block-time">20min ago</span></div>-->
					<!--								</a>-->
					<!--							</li>-->
					<!--							<li class="bell-notification">-->
					<!--								<a href="javascript:;" class="media"><span class="media-left media-icon">-->
					<!--                                        <img class="img-circle"-->
					<!--											 src="-->
					<?php //echo base_url(); ?><!--ablepro-lite/assets/images/avatar-3.png"-->
					<!--											 alt="User Image">-->
					<!--                                    </span>-->
					<!--									<div class="media-body"><span class="block">Transaction xyz complete</span><span-->
					<!--											class="text-muted block-time">3 hours ago</span></div>-->
					<!--								</a>-->
					<!--							</li>-->
					<!--							<li class="not-footer">-->
					<!--								<a href="#!">See all notifications.</a>-->
					<!--							</li>-->
					<!--						</ul>-->
					<!--					</li>-->
					<!-- chat dropdown -->
					<li class="pc-rheader-submenu ">
						<?php $count = 0;
						foreach ($all_message as $msg) {
							$rcpt = explode('###', $msg->to_);
							if (in_array($userid, $rcpt) && $msg->status == 0) {
								$count++;
							}
						} ?>
						<a href="<?php echo base_url(); ?>Show_form/messages/main"
						   class="drop icon-circle displayChatbox">
							<i class="icon-bubbles"></i>
							<?php if ($count != 0) { ?>
								<span class="badge badge-danger header-badge blink"><?php echo $count; ?></span>
							<?php } ?>
						</a>

					</li>
					<!-- window screen -->
					<li class="pc-rheader-submenu">
						<a href="#!" class="drop icon-circle" onclick="javascript:toggleFullScreen()">
							<i class="icon-size-fullscreen"></i>
						</a>


					</li>
					<!-- User Menu-->
					<li class="dropdown">
						<a href="#!" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
						   class="dropdown-toggle drop icon-circle drop-image">
							<span><img class="img-circle "
									   src="<?php echo base_url(); ?>ablepro-lite/assets/images/avatar-1.png"
									   style="width:40px;"
									   alt="User Image"></span>
							<span><b><?php echo $this->session->ses_username; ?></b> <i
									class=" icofont icofont-simple-down"></i></span>

						</a>
						<ul class="dropdown-menu settings-menu">
							<li><a href="<?php echo base_url(); ?>Show_form/profile/main"><i class="icon-user"></i> Profile</a></li>
							<li class="p-0">
								<div class="dropdown-divider m-0"></div>
							</li>
							<li><a href="<?php echo base_url(); ?>Log_in_out/logout"><i class="icon-logout"></i> Logout</a>
							</li>

						</ul>
					</li>
				</ul>

			</div>
		</nav>
	</header>
	<!-- Side-Nav-->
	<aside class="main-sidebar hidden-print ">
		<section class="sidebar" id="sidebar-scroll">

			<div class="user-panel">
				<div class="f-left image"><img src="<?php echo base_url(); ?>ablepro-lite/assets/images/avatar-1.png"
											   alt="User Image" class="img-circle">
				</div>
				<div class="f-left info">
					<p><?php echo $this->session->ses_username; ?></p>
					<!--					<p class="designation">UX Designer</p>-->
				</div>
			</div>

			<!-- Sidebar Menu-->
			<ul class="sidebar-menu">
				<li class="treeview">
					<a class="waves-effect waves-dark" href="<?php echo base_url(); ?>Log_in_out">
						<i class="icon-speedometer"></i><span> Dashboard</span>
					</a>
				</li>
				<!--				<li class="nav-level">Menu</li>-->
				<li class="treeview">
					<a class="waves-effect waves-dark" href="<?php echo base_url(); ?>Show_form/club_list/main">
						<i class="icon-badge"></i>
						<span>Clubs</span>
					</a>
				</li>

				<li class="treeview">
					<a class="waves-effect waves-dark" href="<?php echo base_url(); ?>Show_form/osa/main">
						<i class="icon-people"></i>
						<span>OSA</span>
					</a>
				</li>

				<li class="treeview">
					<a class="waves-effect waves-dark" href="<?php echo base_url(); ?>Show_form/calendar/main">
						<i class="icon-calendar"></i>
						<span>Calendar</span>
					</a>
				</li>

				<!---->
				<!--				<li class="treeview">-->
				<!--					<a class="waves-effect waves-dark" href="-->
				<?php //echo base_url(); ?><!--Show_form/test/main">-->
				<!--						<i class="icon-badge"></i>-->
				<!--						<span>Test</span>-->
				<!--					</a>-->
				<!--				</li>-->
			</ul>
		</section>
	</aside>
</div>


