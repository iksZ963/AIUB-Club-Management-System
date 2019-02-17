<?php foreach ($osa as $item) {
	$name = $item->name;
} ?>
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
						</ol>
					</div>
				</div>
			</div>
			<!-- Row end -->

			<!-- Row start -->
			<div class="row">
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header" align="center">

							<a style="margin: 5px; float: left; display: none;"
							   class="btn btn-info btn-sm icon-action-undo" href="#!"
							   id="osa_back_btn">
							</a>
							<div class="card-header-text">
								<p style="font-size: 24px;" id="mem_title"><?php echo $name; ?></p>
							</div>
							<a style="margin: 5px; float: right;" class="btn btn-info btn-sm icon-pencil" href="#!"
							   id="osa_btn" title="Edit">
							</a>
						</div>
						<div class="card-block" id="osa">
							<?php foreach ($osa as $single_value) { ?>
								<div class="form-group row">
									<label for="objective" class="col-xs-3 col-form-label form-control-label">Objective
									</label>
									<div class="col-sm-9">
										<textarea class="form-control" type="text" name="objective" id="objective"
												  autocomplete="off"
												  readonly style="overflow: hidden;"><?php echo $single_value->objective; ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="activities" class="col-xs-3 col-form-label form-control-label">Activities</label>
									<div class="col-sm-9">
										<textarea class="form-control" type="text" name="activities" id="activities"
												  autocomplete="off"
												  readonly style="overflow: hidden;"><?php echo $single_value->activities; ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="clubs"
										   class="col-xs-3 col-form-label form-control-label">Student
										Organizations</label>
									<div class="col-sm-9">
										<textarea class="form-control" type="text" name="clubs" id="clubs"
												  autocomplete="off" readonly style="overflow: hidden;"><?php foreach ($all_club as $item) {
												echo $item->club_name . "\r\n";
											} ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="contact"
										   class="col-xs-3 col-form-label form-control-label">Contact</label>
									<div class="col-sm-9">
										<input class="form-control" name="contact" id="contact"
											   value="<?php echo $single_value->contact; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label for="email" class="col-xs-3 col-form-label form-control-label">Email</label>
									<div class="col-sm-9">
										<input class="form-control" type="email" name="email" id="email"
											   autocomplete="off" value="<?php echo $single_value->email; ?>" readonly>
									</div>
								</div>
								<div class="form-group row">
									<label for="address"
										   class="col-md-3 col-form-label form-control-label">Address</label>
									<div class="col-md-9">
										<input class="form-control" type="text" name="address" id="address"
											   autocomplete="off" value="<?php echo $single_value->address; ?>"
											   readonly>
									</div>
								</div>

							<?php } ?>
						</div>

						<div class="card-block" id="osa_edit" style="display: none;">
							<?php foreach ($osa as $single_value) { ?>
							<form class="form-horizontal" id="edit_details" enctype="multipart/form-data">
								<div class="form-group row">
									<label for="objective2" class="col-xs-3 col-form-label form-control-label">Objective
									</label>
									<div class="col-sm-9">
										<textarea class="form-control" type="text" name="objective2" id="objective2"
												  autocomplete="off"
												  style="overflow: hidden;"><?php echo $single_value->objective; ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="activities2" class="col-xs-3 col-form-label form-control-label">Activities</label>
									<div class="col-sm-9">
										<textarea class="form-control" type="text" name="activities2" id="activities2"
												  autocomplete="off"
												  style="overflow: hidden;"><?php echo $single_value->activities; ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="clubs2"
										   class="col-xs-3 col-form-label form-control-label">Student
										Organizations</label>
									<div class="col-sm-9">
										<textarea class="form-control" type="text" name="clubs2" id="clubs2"
												  autocomplete="off" style="overflow: hidden;" readonly><?php foreach ($all_club as $item) {
												echo $item->club_name . "\r\n";
											} ?></textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="contact2"
										   class="col-xs-3 col-form-label form-control-label">Contact</label>
									<div class="col-sm-9">
										<input class="form-control" name="contact2" id="contact2"
											   value="<?php echo $single_value->contact; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="email2" class="col-xs-3 col-form-label form-control-label">Email</label>
									<div class="col-sm-9">
										<input class="form-control" type="email" name="email2" id="email2"
											   autocomplete="off" value="<?php echo $single_value->email; ?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="address2"
										   class="col-md-3 col-form-label form-control-label">Address</label>
									<div class="col-md-9">
										<input class="form-control" type="text" name="address2" id="address2"
											   autocomplete="off" value="<?php echo $single_value->address; ?>">
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12" align="center">
										<button class="btn btn-primary" id="btn_upload" type="submit">Edit</button>
									</div>
								</div>
							</form>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header" align="center">

							<a style="margin: 5px; float: left; display: none;"
							   class="btn btn-info btn-sm icon-action-undo" href="#!"
							   id="osa_back_btn">
							</a>
							<div class="card-header-text">
								<p style="font-size: 24px;" id="mem_title"><?php echo $name; ?></p>
								<p style="font-size: 16px;">Menu</p>
							</div>
							<a style="margin: 5px; float: right;" class="btn btn-info btn-sm icon-pencil" href="#!"
							   id="osa_btn" title="Edit">
							</a>
						</div>
						<div class="card-block" align="center">
							<a style="margin: 5px;" class="btn btn-success icon-people"
							   title="OSA Officials List"
							   href="<?php echo base_url(); ?>Show_form/osa_member/main">&emsp; OSA Officials
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	var observe;
	if (window.attachEvent) {
		observe = function (element, event, handler) {
			element.attachEvent('on' + event, handler);
		};
	}
	else {
		observe = function (element, event, handler) {
			element.addEventListener(event, handler, false);
		};
	}

	function init() {
		function resize(element) {
			element.style.height = 'auto';
			element.style.height = element.scrollHeight + 'px';
		}

		/* 0-timeout to get the already changed text */
		function delayedResize(element) {
			window.setTimeout(function () {
				resize(element)
			}, 0);
		}

		var textareas = document.getElementsByTagName("textarea");
		for (i = 0; i < textareas.length; i++) {
			var textarea = textareas[i];
			observe(textarea, 'change', function () {
				resize(this)
			});
			observe(textarea, 'cut', function () {
				delayedResize(this)
			});
			observe(textarea, 'paste', function () {
				delayedResize(this)
			});
			observe(textarea, 'drop', function () {
				delayedResize(this)
			});
			observe(textarea, 'keydown', function () {
				delayedResize(this)
			});
			// textarea.focus();
			// textarea.select();
			resize(textarea);
		}
	}

	init();

	//textarea script end--

	$('#osa_btn').on('click', function (e) {
		$('#osa_back_btn').show();
		$('#osa_edit').show();
		$('#osa').hide();
		$('#osa_btn').hide();
		init();
	});

	$('#osa_back_btn').on('click', function (e) {
		$('#osa_back_btn').hide();
		$('#osa_edit').hide();
		$('#osa').show();
		$('#osa_btn').show();
	});

	$(document).ready(function () {
		$('#example').DataTable({
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		});

		$("#c_role").select2({
			placeholder: "Select Member Type",
			allowClear: true
		});

		$("#faculty").select2({
			placeholder: "Select Faculty",
			allowClear: true
		});

		$("#designation").select2({
			placeholder: "Select Designation",
			allowClear: true
		});

		$("#joining_sem").select2({
			placeholder: "Select Joinig Semester",
			allowClear: true
		});

		$("#joining_sem_year").select2({
			placeholder: "Select Year",
			allowClear: true
		});

		$('#add_member').submit(function (e) {
			e.preventDefault();
			// var formData = new FormData(this);
			//
			// for (var pair of formData.entries()) {
			// 	console.log(pair[0]+ ', ' + pair[1]);
			// }
			$.ajax({
				url: '<?php echo base_url();?>Insert/add_member',
				type: "post",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function (data) {
					alert("Member Added Successfully");
					location.reload();
				}
			});
		});

		$('#edit_details').submit(function (e) {
			e.preventDefault();
			// var formData = new FormData(this);
			//
			// for (var pair of formData.entries()) {
			// 	console.log(pair[0]+ ', ' + pair[1]);
			// }
			$.ajax({
				url: '<?php echo base_url();?>Edit/edit_osa',
				type: "post",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function (data) {
					alert("Edited Successfully");
					location.reload();
				}
			});
		});
	});

	$('#c_role').on('change', function (e) {
		if ($('#c_role').val() == 'excom') {
			$('#des_div').show();
		} else {
			$('#des_div').hide();
		}
	});

	$('#designation').on('change', function (e) {
		if ($('#designation').val() == 'Other') {
			$('#other_des').show();
		} else {
			$('#other_des').hide();
		}
	});

	function remove_member(member_id) {
		var post_data = {
			'member_id': member_id,
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
		};
		console.log(post_data);
		$.ajax({
			url: '<?php echo base_url();?>Delete/remove_member',
			type: "post",
			data: post_data,
			success: function (data) {
				alert("Removed Successfully");
				location.reload();
			}
		});
	}

	function suspend_member(member_id) {
		var post_data = {
			'member_id': member_id,
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
		};
		console.log(post_data);
		$.ajax({
			url: '<?php echo base_url();?>Edit/suspend_member',
			type: "post",
			data: post_data,
			success: function (data) {
				alert("Suspended");
				location.reload();
			}
		});
	}

	function resume_member(member_id) {
		var post_data = {
			'member_id': member_id,
			'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
		};
		console.log(post_data);
		$.ajax({
			url: '<?php echo base_url();?>Edit/resume_member',
			type: "post",
			data: post_data,
			success: function (data) {
				alert("Resumed");
				location.reload();
			}
		});
	}
</script>
