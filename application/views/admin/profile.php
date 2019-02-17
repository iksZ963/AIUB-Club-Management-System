<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Main content starts -->
		<div>
			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-12 p-0">
					<div class="main-header">
						<h4>Profile</h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Log_in_out"><i
										class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Show_form/profile/main">Profile </a>
							</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- Row end -->

			<!-- Row start -->
			<div class="row">

				<div class="col-lg-3"></div>
				<!-- Textual inputs starts -->
				<div class="col-lg-6">
					<div class="card" id="club_actions">
						<div id="action1">

							<?php foreach ($profile as $single_value) { ?>
							<div class="card-header" align="center">
								<div class="card-header-text">
									<p style="font-size: 26px;" id="me_title">Profile</p>
								</div>
								<a style="margin: 5px; float: right;" class="btn btn-info btn-sm icon-pencil"
								   href="#!"
								   id="edit_btn" title="Edit Club Details">
								</a>
							</div>
							<div class="card-block">
								<?php if ($this->session->ses_user_type == 'osa') { ?>
									<form class="form-horizontal" enctype="multipart/form-data" id="add_osa_member">
										<div class="form-group row">
											<label for="name" class="col-xs-3 col-form-label form-control-label">
												Name</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="name" id="name"
													   autocomplete="off" value="<?php echo $single_value->name;?>" readonly>
											</div>
										</div>

										<div class="form-group row">
											<label for="designation"
												   class="col-xs-3 col-form-label form-control-label">Designation</label>
											<div class="col-sm-9">
												<select id="designation" name="designation"
														class="js-example-placeholder-single"
														style="display: none;" disabled>
													<option></option>
													<option value="Founder">Founder</option>
													<option value="Director">Director</option>
													<option value="Deputy Director">Deputy Director</option>
													<option value="Special Assistant">Special Assistant</option>
													<option value="Jr. Executive">Jr. Executive</option>
													<option value="Other">Other</option>
												</select>
												<input class="form-control" type="text" name="other_des" id="other_des"
													   autocomplete="off" readonly
													   value="<?php echo $single_value->designation;?>">
											</div>
										</div>

										<div class="form-group row">
											<label for="phone" class="col-xs-3 col-form-label form-control-label">Contact
												No.</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="phone" id="phone"
													   autocomplete="off" value="<?php echo $single_value->contact;?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="email" class="col-xs-3 col-form-label form-control-label">Email</label>
											<div class="col-sm-9">
												<input class="form-control" type="email" name="email" id="email"
													   autocomplete="off" value="<?php echo $single_value->email;?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="aiub_id" class="col-xs-3 col-form-label form-control-label">AIUB
												ID</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="aiub_id" id="aiub_id"
													   autocomplete="off" value="<?php echo $single_value->userid;?>" readonly>
											</div>
										</div>
<!--										<div class="form-group row">-->
<!--											<label for="password"-->
<!--												   class="col-xs-3 col-form-label form-control-label">Password</label>-->
<!--											<div class="col-sm-9">-->
<!--												<input class="form-control" type="password" name="password" id="password"-->
<!--													   autocomplete="off">-->
<!--											</div>-->
<!--										</div>-->
										<div class="form-group row">
											<label for="image"
												   class="col-md-3 col-form-label form-control-label">Image</label>
											<div class="col-md-9">
												<?php if (file_exists('./assets/img/osa_member/' . $single_value->image)) { ?>
													<img class="zoom" style="width: 200px; height: 200px;"
														 src="<?php echo base_url(); ?>assets/img/osa_member/<?php echo $single_value->image; ?>">
												<?php } else {
													echo 'No Image';
												} ?>
												<!--												<input type="file" id="image" name="image" class="form-control">-->
											</div>
										</div>


									</form>

								<?php } else { ?>
									<form class="form-horizontal" enctype="multipart/form-data" id="add_member">
										<div class="form-group row">
											<label for="name" class="col-xs-3 col-form-label form-control-label">
												Name (AIUB Format)</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="name" id="name"
													   autocomplete="off" value="<?php echo $single_value->name;?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="club_name"
												   class="col-md-3 col-form-label form-control-label">Club</label>
											<div class="col-md-9">
												<input class="form-control" type="text" name="club_name" id="club_name"
													   autocomplete="off" readonly value="<?php echo $single_value->club_name; ?>">
												<input class="form-control" type="hidden" name="club_id" id="club_id"
													   autocomplete="off" value="<?php echo $single_value->club_id; ?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="c_role"
												   class="col-xs-3 col-form-label form-control-label">Role</label>
											<div class="col-sm-9">
												<select id="c_role" name="c_role" class="js-example-placeholder-single"
														style="width: 100%;" disabled>
													<option></option>
													<option value="excom" <?php if($single_value->member_type == 'excom'){echo 'selected';}?>>Executive</option>
													<option value="member" <?php if($single_value->member_type == 'member'){echo 'selected';}?>>General Member</option>
												</select>
											</div>
										</div>
										<div class="form-group row" <?php if($single_value->member_type != 'excom'){?> style="display: none;"<?php }?> id="des_div">
											<label for="designation"
												   class="col-xs-3 col-form-label form-control-label">Designation</label>
											<div class="col-sm-9">
												<select id="designation" name="designation"
														class="js-example-placeholder-single"
														style="width: 100%; display: none;">
													<option></option>
													<option value="President" <?php if($single_value->designation == 'President'){echo 'selected';}?>>President</option>
													<option value="Vice President" <?php if($single_value->designation == 'Vice President'){echo 'selected';}?>>Vice President</option>
													<option value="General Secretary" <?php if($single_value->designation == 'General Secretary'){echo 'selected';}?>>General Secretary</option>
													<option value="Assistant General Secretary" <?php if($single_value->designation == 'Assistant General Secretary'){echo 'selected';}?>>Assistant General
														Secretary
													</option>
													<option value="Operating Secretary" <?php if($single_value->designation == 'Operating Secretary'){echo 'selected';}?>>Operating Secretary</option>
													<option value="Other">Other</option>
												</select>
												<input class="form-control" type="text" name="other_des" id="other_des"
													   autocomplete="off" readonly
												value="<?php echo $single_value->designation;?>">
											</div>
										</div>
										<div class="form-group row">
											<label for="joining_sem"
												   class="col-xs-3 col-form-label form-control-label">Joining
												Semester</label>
											<div class="col-sm-3">
												<select id="joining_sem" name="joining_sem"
														class="js-example-placeholder-single"
														style="width: 100%;" disabled>
													<option></option>
													<option value="Spring" <?php if(preg_match('/Spring/', $single_value->joining_semester)){echo 'selected';}?>>Spring</option>
													<option value="Summer" <?php if(preg_match('/Summer/', $single_value->joining_semester)){echo 'selected';}?>>Summer</option>
													<option value="Fall" <?php if(preg_match('/Fall/', $single_value->joining_semester)){echo 'selected';}?>>Fall</option>
												</select>
											</div>
											<div class="col-sm-3">
												<select id="joining_sem_year" name="joining_sem_year"
														class="js-example-placeholder-single"
														style="width: 100%;" disabled>
													<option></option>

													<?php for ($i = (int)date('Y', strtotime('-50 year')); $i < (int)date('Y', strtotime('+19 year')); $i++) { ?>
														<option
															value="<?php echo $i; ?>" <?php if (preg_match('/'.$i.'/', $single_value->joining_semester)) {
															echo 'selected';
														} ?>><?php echo $i; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label for="faculty"
												   class="col-xs-3 col-form-label form-control-label">Faculty</label>
											<div class="col-sm-9">
												<select id="faculty" name="faculty"
														class="js-example-placeholder-single"
														style="width: 100%;" disabled>
													<option></option>
													<option value="Faculty Of Science And Information Technology"
														<?php if($single_value->faculty == 'Faculty Of Science And Information Technology'){echo 'selected';}?>>
														Faculty Of
														Science And
														Information Technology
													</option>
													<option value="Faculty of Engineering"
														<?php if($single_value->faculty == 'Faculty of Engineering'){echo 'selected';}?>>
														Faculty of Engineering
													</option>
													<option value="Faculty of Business Administration"
														<?php if($single_value->faculty == 'Faculty of Business Administration'){echo 'selected';}?>>
														Faculty of
														Business
														Administration
													</option>
													<option value="Faculty of Arts & Social Sciences"
														<?php if($single_value->faculty == 'Faculty of Arts & Social Sciences'){echo 'selected';}?>>
														Faculty of Arts &
														Social
														Sciences
													</option>
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label for="address"
												   class="col-xs-3 col-form-label form-control-label">Address</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="address" id="address"
													   autocomplete="off" value="<?php echo $single_value->name;?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="phone" class="col-xs-3 col-form-label form-control-label">Contact
												No.</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="phone" id="phone"
													   autocomplete="off" value="<?php echo $single_value->phone;?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="email"
												   class="col-xs-3 col-form-label form-control-label">Email</label>
											<div class="col-sm-9">
												<input class="form-control" type="email" name="email" id="email"
													   autocomplete="off" value="<?php echo $single_value->email;?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="cgpa"
												   class="col-xs-3 col-form-label form-control-label">CGPA</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="cgpa" id="cgpa"
													   autocomplete="off" value="<?php echo $single_value->cgpa;?>" readonly>
											</div>
										</div>
										<div class="form-group row">
											<label for="aiub_id" class="col-xs-3 col-form-label form-control-label">AIUB
												ID</label>
											<div class="col-sm-9">
												<input class="form-control" type="text" name="aiub_id" id="aiub_id"
													   autocomplete="off" value="<?php echo $single_value->userid;?>" readonly>
											</div>
										</div>
<!--										<div class="form-group row">-->
<!--											<label for="password"-->
<!--												   class="col-xs-3 col-form-label form-control-label">Password</label>-->
<!--											<div class="col-sm-9">-->
<!--												<input class="form-control" type="password" name="password"-->
<!--													   id="password"-->
<!--													   autocomplete="off" value="--><?php //echo $single_value->password;?><!--" readonly>-->
<!--											</div>-->
<!--										</div>-->
										<div class="form-group row">
											<label for="image"
												   class="col-md-3 col-form-label form-control-label">Image</label>
											<div class="col-md-9">
												<?php if (file_exists('./assets/img/member/' . $single_value->image)) { ?>
													<img class="zoom" style="width: 200px; height: 200px;"
														 src="<?php echo base_url(); ?>assets/img/member/<?php echo $single_value->image; ?>">
												<?php } else {
													echo 'No Image';
												} ?>
<!--												<input type="file" id="image" name="image" class="form-control">-->
											</div>
										</div>

<!--										<div class="form-group row">-->
<!--											<div class="col-md-12" align="center">-->
<!--												<button class="btn btn-primary" id="btn_upload" type="submit">Save-->
<!--												</button>-->
<!--											</div>-->
<!--										</div>-->

									</form>
								<?php }
								} ?>
							</div>
						</div>
					</div>


					<!-- Textual inputs ends -->
				</div>
				<!-- Row end -->
			</div>
			<!-- Main content ends -->
		</div>
		<!-- Container-fluid ends -->
	</div>


	<script type="text/javascript">

		$('#default_btn').on('click', function (e) {
			$('#club_actions').show();
			$('#action1').show();
			$('#action2').hide();
			$('#member_actions').hide();
			$('#add_club').show();
			$('#post_club').hide();
		});

		$('#edit_btn').on('click', function (e) {
			$('#club_back_btn').show();
			$('#edit_details').show();
			$('#show_details').hide();
			$('#default_btn').hide();
		});

		$('#club_back_btn').on('click', function (e) {
			$('#club_back_btn').hide();
			$('#edit_details').hide();
			$('#show_details').show();
			$('#default_btn').show();
		});

		// $(function () {
		// 	$(".new_datepicker").datepicker({
		// 		dateFormat: 'yy-mm-dd',
		// 		constrainInput: true,
		// 		changeYear: true,
		// 		changeMonth: true
		// 	});
		// });

		$(document).ready(function () {

			initdatepicker();

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

			$('#edit_details').submit(function (e) {
				e.preventDefault();
				// var formData = new FormData(this);
				//
				// for (var pair of formData.entries()) {
				// 	console.log(pair[0]+ ', ' + pair[1]);
				// }
				$.ajax({
					url: '<?php echo base_url();?>Edit/edit_club',
					type: "post",
					data: new FormData(this),
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function (data) {
						alert("Edited Successfully");
						$('#club_back_btn').hide();
						$('#edit_details').hide();
						$('#show_details').show();
						$('#default_btn').show();
						$('#action2').html(data);
					}
				});
			});


		});
	</script>

