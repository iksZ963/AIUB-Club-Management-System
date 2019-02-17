<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Main content starts -->
		<div>
			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-12 p-0">
					<div class="main-header">
						<h4>Clubs</h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Log_in_out"><i
										class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Show_form/club_list/main">Clubs </a>
							</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- Row end -->

			<!-- Row start -->
			<div class="row">
				<!-- Form Control starts -->
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-header-text">Club List</h5>
						</div>
						<div class="card-block">
							<div class="row">
								<div class="col-sm-12 table-responsive">
									<table class="table">
										<thead>
										<tr>
											<th style="text-align: center;">#</th>
											<th style="text-align: center;">Club Name</th>
											<th style="text-align: center;">Actions</th>
										</tr>
										</thead>
										<tbody>
										<?php
										$count = 0;
										foreach ($all_club as $single_value) {
											$count++;
											?>
											<tr class="<?php if ($single_value->status == 0) {
												echo 'table-danger';
											} else {
												echo 'table-info';
											} ?>">
												<td style="text-align: center;"><?php echo $count; ?></td>
												<td style="text-align: center;"><?php echo $single_value->club_name; ?></td>
												<td style="text-align: center;">
													<a style="margin: 5px;" class="btn btn-primary icon-docs"
													   title="Details"
													   href="#!"
													   onclick="details('<?php echo $single_value->record_id; ?>')">
													</a>
													<a style="margin: 5px;" class="btn btn-success icon-people"
													   title="Members"
													   href="<?php echo base_url(); ?>Show_form/club_members/main/<?php echo $single_value->record_id; ?>">
													</a>
													<?php if ($single_value->status == 1) { ?>
														<a style="margin: 5px;" class="btn btn-warning icon-ban"
														   href="#!"
														   title="Suspend"
														   onclick="suspend_club('<?php echo $single_value->record_id; ?>')">
														</a>
													<?php } else { ?>
														<a style="margin: 5px;"
														   class="btn btn-inverse-warning icon-check" href="#!"
														   title="Resume"
														   onclick="resume_club('<?php echo $single_value->record_id; ?>')">
														</a>
													<?php } ?>
													<a style="margin: 5px;" class="btn btn-danger icon-trash" href="#!"
													   title="Remove"
													   onclick="remove_club('<?php echo $single_value->record_id; ?>','<?php echo $single_value->logo; ?>')">
													</a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Form Control ends -->

				<!-- Textual inputs starts -->
				<div class="col-lg-6">
					<div class="card" id="club_actions">
						<div id="action1">
							<div class="card-header" align="center">
								<div class="card-header-text">
									<a style="margin: 5px;" class="btn btn-success" href="#!"
									   id="club_add_btn">
										Add New Club
									</a>
									<a style="margin: 5px;" class="btn btn-info" href="#!"
									   id="club_post_btn">
										Post to Club
									</a>
								</div>
							</div>

							<div class="card-block">
								<p id="name_header"></p>
								<form class="form-horizontal" id="add_club" enctype="multipart/form-data">
									<div class="form-group row">
										<label for="club_name" class="col-xs-3 col-form-label form-control-label">Club
											Name</label>
										<div class="col-sm-9">
											<input class="form-control" type="text" name="club_name" id="club_name"
												   autocomplete="off">
										</div>
									</div>
									<div class="form-group row">
										<label for="foundation_date" class="col-xs-3 col-form-label form-control-label">Foundation
											Date</label>
										<div class="col-sm-9">
											<input class="form-control new_datepicker" type="text"
												   name="foundation_date"
												   id="foundation_date" autocomplete="off">
										</div>
									</div>
									<div class="form-group row">
										<label for="slogan"
											   class="col-xs-3 col-form-label form-control-label">Slogan</label>
										<div class="col-sm-9">
											<input class="form-control" type="text" name="slogan" id="slogan"
												   autocomplete="off">
										</div>
									</div>
									<div class="form-group row">
										<label for="details"
											   class="col-xs-3 col-form-label form-control-label">Details</label>
										<div class="col-sm-9">
											<textarea class="form-control" name="details" id="details"></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="current_com" class="col-xs-3 col-form-label form-control-label">Current
											Committee</label>
										<div class="col-sm-9">
											<input class="form-control" type="text" name="current_com" id="current_com"
												   autocomplete="off">
										</div>
									</div>
									<div class="form-group row">
										<label for="logo"
											   class="col-md-3 col-form-label form-control-label">Logo</label>
										<div class="col-md-9">
											<input type="file" id="logo" name="logo" class="form-control">
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12" align="center">
											<button class="btn btn-primary" id="btn_upload" type="submit">Save</button>
										</div>
									</div>
								</form>


								<form class="form-horizontal" enctype="multipart/form-data" id="post_club"
									  style="display: none;">
									<div class="form-group row">
										<label for="clubs"
											   class="col-md-2 col-form-label form-control-label">Select Club</label>
										<div class="col-md-10">
											<select id="clubs" name="clubs[]" class="js-example-basic-multiple"
													multiple="multiple"
													style="width: 100%;">
												<?php foreach ($all_club as $single_value) { ?>
													<option
														value="<?php echo $single_value->record_id; ?>"><?php echo $single_value->club_name; ?></option>
												<?php } ?>
											</select>
											<input type="checkbox" id="checkbox" >Select All
										</div>
									</div>

									<div class="form-group row">
										<label for="post"
											   class="col-md-2 col-form-label form-control-label">Post</label>
										<div class="col-md-10">
										<textarea class="form-control" name="post" id="post"
												  placeholder="Write here..." rows="6"></textarea>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12" align="center">
											<button class="btn btn-primary" id="btn_upload" type="submit">Post</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div id="action2"></div>
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

		function initdatepicker() {
			$(".new_datepicker").datepicker({
				dateFormat: 'yy-mm-dd',
				constrainInput: true,
				changeYear: true,
				changeMonth: true
			});
		}

		$('#club_add_btn').on('click', function (e) {
			$('#add_club').show();
			$('#post_club').hide();
		});

		$('#club_post_btn').on('click', function (e) {
			$('#post_club').show();
			$('#add_club').hide();
		});

		$('#default_btn').on('click', function (e) {
			$('#club_actions').show();
			$('#action1').show();
			$('#action2').hide();
			$('#member_actions').hide();
			$('#add_club').show();
			$('#post_club').hide();
		});

		$("#checkbox").click(function(){
			if($("#checkbox").is(':checked') ){
				$("#clubs > option").prop("selected","selected");
				$("#clubs").trigger("change");
			}else{
				$("#clubs > option").removeAttr("selected");
				$("#clubs").trigger("change");
			}
		});

		$(document).ready(function () {



			$('#add_club').submit(function (e) {
				e.preventDefault();
				$.ajax({
					url: '<?php echo base_url();?>Insert/add_club',
					type: "post",
					data: new FormData(this),
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function (data) {
						alert("Added Successfully");
						location.reload();
					}
				});
			});

			$('#post_club').submit(function (e) {
				e.preventDefault();
				$.ajax({
					url: '<?php echo base_url();?>Insert/post_club',
					type: "post",
					data: new FormData(this),
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function (data) {
						alert("Posted Successfully");
						location.reload();
					}
				});
			});

		});

		function remove_club(club_id, logo) {
			var post_data = {
				'club_id': club_id, 'logo': logo,
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			};
			console.log(post_data);
			$.ajax({
				url: '<?php echo base_url();?>Delete/remove_club',
				type: "post",
				data: post_data,
				success: function (data) {
					alert("Removed Successfully");
					location.reload();
				}
			});
		}

		function suspend_club(club_id) {
			var post_data = {
				'club_id': club_id,
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			};
			console.log(post_data);
			$.ajax({
				url: '<?php echo base_url();?>Edit/suspend_club',
				type: "post",
				data: post_data,
				success: function (data) {
					alert("Suspended");
					location.reload();
				}
			});
		}

		function resume_club(club_id) {
			var post_data = {
				'club_id': club_id,
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			};
			console.log(post_data);
			$.ajax({
				url: '<?php echo base_url();?>Edit/resume_club',
				type: "post",
				data: post_data,
				success: function (data) {
					alert("Resumed");
					location.reload();
				}
			});
		}

		function member(club_id) {
			$('#club_actions').hide();
			$('#member_actions').show();
			var post_data = {
				'club_id': club_id,
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			};
			console.log(post_data);
			$.ajax({
				url: '<?php echo base_url();?>Get_ajax_value/get_member_list',
				type: "post",
				data: post_data,
				success: function (data) {
					$('#member_list').html(data);
				}
			});
			// $('#add_member').show();
			$('#clubs2').val(club_id);
			$('#club_id').val(club_id);
			$('#clubs2').trigger('change');
			var club_name = $('#clubs2 :selected').text();
			$('#mem_title').html(club_name + ' Member List');
		}


		function details(club_id) {
			$('#club_actions').show();
			$('#member_actions').hide();
			var post_data = {
				'club_id': club_id,
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			};
			console.log(post_data);
			$.ajax({
				url: '<?php echo base_url();?>Get_ajax_value/get_club_details',
				type: "post",
				data: post_data,
				success: function (data) {
					// initdatepicker();
					$('#action1').hide();
					$('#action2').show();
					$('#action2').html(data);
				}
			});
		}
	</script>

