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
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Show_form/osa_member/main">OSA
									Officials</a>
							</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- Row end -->

			<!-- Row start -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-header" align="center">

							<a style="margin: 5px; float: left; display: none;"
							   class="btn btn-info btn-sm icon-action-undo" href="#!"
							   id="member_back_btn">
							</a>
							<div class="card-header-text">
								<p style="font-size: 24px;" id="mem_title"><?php echo $name; ?></p>
							</div>
							<a style="margin: 5px; float: right;" class="btn btn-info btn-sm icon-plus" href="#!"
							   id="member_btn" title="Add OSA Official">
							</a>
						</div>
						<div class="card-block" id="mem_list">
							<div class="col-sm-12 table-responsive">
								<table class="table" id="example">
									<thead>
									<tr>
										<th style="text-align: center;">#</th>
										<th style="text-align: center;">Name</th>
										<th style="text-align: center;">Designation</th>
										<th style="text-align: center;">Contact No.</th>
										<th style="text-align: center;">Email</th>
										<th style="text-align: center;">AIUB ID</th>
										<th style="text-align: center;">Action</th>
									</tr>
									</thead>
									<tbody>
									<?php
									$count = 0;
									foreach ($all_osa_member as $single_value) {
										$count++;
										?>
										<tr class="<?php if ($single_value->status == 1) {
											echo 'table-danger';
										} else {
											echo 'table-info';
										} ?>">
											<td style="text-align: center;"><?php echo $count; ?></td>
											<td style="text-align: center;"><?php echo $single_value->name; ?></td>
											<td style="text-align: center;"><?php echo $single_value->designation; ?></td>
											<td style="text-align: center;"><?php echo $single_value->contact; ?></td>
											<td style="text-align: center;"><?php echo $single_value->email; ?></td>
											<td style="text-align: center;"><?php echo $single_value->userid; ?></td>
											<td style="text-align: center;">
												<?php if ($single_value->status == 2) {
													echo 'N/A';
												}else{
													if ($single_value->status == 0) { ?>
														<a style="margin: 5px;" class="btn btn-warning icon-ban"
														   href="#!"
														   title="Suspend"
														   onclick="suspend_member('<?php echo $single_value->record_id; ?>')">
														</a>
													<?php } else { ?>
														<a style="margin: 5px;"
														   class="btn btn-inverse-warning icon-check" href="#!"
														   title="Resume"
														   onclick="resume_member('<?php echo $single_value->record_id; ?>')">
														</a>
													<?php } ?>
												<a style="margin: 5px;" class="btn btn-danger icon-trash" href="#!"
												   title="Remove"
												   onclick="remove_member('<?php echo $single_value->record_id; ?>')">
												</a>
												<?php } ?>
											</td>
										</tr>
									<?php } ?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="card-block">
							<form class="form-horizontal" enctype="multipart/form-data" id="add_member"
								  style="display: none;">
								<div class="form-group row">
									<label for="name" class="col-xs-3 col-form-label form-control-label">
										Name</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="name" id="name"
											   autocomplete="off">
									</div>
								</div>

								<div class="form-group row">
									<label for="designation"
										   class="col-xs-3 col-form-label form-control-label">Designation</label>
									<div class="col-sm-9">
										<select id="designation" name="designation"
												class="js-example-placeholder-single"
												style="width: 100%;">
											<option></option>
											<option value="Founder">Founder</option>
											<option value="Director">Director</option>
											<option value="Deputy Director">Deputy Director</option>
											<option value="Special Assistant">Special Assistant</option>
											<option value="Jr. Executive">Jr. Executive</option>
											<option value="Other">Other</option>
										</select>
										<input class="form-control" type="text" name="other_des" id="other_des"
											   autocomplete="off" placeholder="Specify Designation"
											   style="display: none;">
									</div>
								</div>

								<div class="form-group row">
									<label for="phone" class="col-xs-3 col-form-label form-control-label">Contact
										No.</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="phone" id="phone"
											   autocomplete="off">
									</div>
								</div>
								<div class="form-group row">
									<label for="email" class="col-xs-3 col-form-label form-control-label">Email</label>
									<div class="col-sm-9">
										<input class="form-control" type="email" name="email" id="email"
											   autocomplete="off">
									</div>
								</div>
								<div class="form-group row">
									<label for="aiub_id" class="col-xs-3 col-form-label form-control-label">AIUB
										ID</label>
									<div class="col-sm-9">
										<input class="form-control" type="text" name="aiub_id" id="aiub_id"
											   autocomplete="off">
									</div>
								</div>
								<div class="form-group row">
									<label for="password"
										   class="col-xs-3 col-form-label form-control-label">Password</label>
									<div class="col-sm-9">
										<input class="form-control" type="password" name="password" id="password"
											   autocomplete="off">
									</div>
								</div>
								<!--								<div class="form-group row">-->
								<!--									<label for="logo"-->
								<!--										   class="col-md-3 col-form-label form-control-label">Logo</label>-->
								<!--									<div class="col-md-9">-->
								<!--										<input type="file" id="logo" name="logo" class="form-control">-->
								<!--									</div>-->
								<!--								</div>-->

								<div class="form-group row">
									<div class="col-md-12" align="center">
										<button class="btn btn-primary" id="btn_upload" type="submit">Save</button>
									</div>
								</div>

							</form>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	$('#member_btn').on('click', function (e) {
		$('#member_back_btn').show();
		$('#add_member').show();
		$('#mem_list').hide();
		$('#member_btn').hide();
	});

	$('#member_back_btn').on('click', function (e) {
		$('#member_back_btn').hide();
		$('#add_member').hide();
		$('#mem_list').show();
		$('#member_btn').show();
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
				url: '<?php echo base_url();?>Insert/add_osa_member',
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
			url: '<?php echo base_url();?>Delete/remove_osa_member',
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
			url: '<?php echo base_url();?>Edit/suspend_osa_member',
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
			url: '<?php echo base_url();?>Edit/resume_osa_member',
			type: "post",
			data: post_data,
			success: function (data) {
				alert("Resumed");
				location.reload();
			}
		});
	}
</script>
