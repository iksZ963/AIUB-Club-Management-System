<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Main content starts -->
		<div>
			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-12 p-0">
					<div class="main-header">
						<h4>Member List</h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Log_in_out"><i
										class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Show_form/osa/main">OSA </a>
							</li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Show_form/osa_member/main">OSA
									Officials</a>
							</li>
						</ol>
					</div>
				</div>

				<div class="container">
					<div class="page-header">
						<div class="pull-right form-inline">
							<div class="btn-group">
								<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
								<button class="btn btn-default" data-calendar-nav="today">Today</button>
								<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
							</div>
							<div class="btn-group">
								<button class="btn btn-warning" data-calendar-view="year">Year</button>
								<button class="btn btn-warning active" data-calendar-view="month">Month</button>
								<button class="btn btn-warning" data-calendar-view="week">Week</button>
								<button class="btn btn-warning" data-calendar-view="day">Day</button>
							</div>
						</div>
						<h3></h3>
						<small>To see example with events navigate to Februray 2018</small>
					</div>
					<div class="row">
						<div class="col-md-9">
							<div id="showEventCalendar"></div>
						</div>
						<div class="col-md-3">
							<h4>All Events List</h4>
							<ul id="eventlist" class="nav nav-list"></ul>
						</div>
					</div>
				</div>
			</div>
			<!-- Row end -->
		</div>
	</div>
</div>


<script type="text/javascript">



	$(document).ready(function () {

	});

</script>
