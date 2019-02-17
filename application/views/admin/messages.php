<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Main content starts -->
		<div>
			<!-- Row Starts -->
			<div class="row">
				<div class="col-sm-12 p-0">
					<div class="main-header">
						<h4>Messages</h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Log_in_out"><i
										class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Show_form/messages/main">Messages </a>
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
							<h5 class="card-header-text">Messages</h5>
						</div>
						<div class="card-block">
							<div class="row">
								<div class="col-sm-12 table-responsive">
									<table class="table">
										<thead>
										<tr>
											<th style="text-align: center;">#</th>
											<th style="text-align: center;">From</th>
										</tr>
										</thead>
										<tbody>
										<?php
										$count = 0;
										$userid = '';
										foreach ($all_message as $single_value) {
											$rcpt = explode('###', $single_value->to_);
											if (in_array($this->session->ses_userid, $rcpt)) {
												$result = $this->Common_model->get_allinfo_byid('login', 'userid', $single_value->from_);
												foreach ($result as $res) {
													$user_t = $res->user_type;
												}
												if ($user_t == 'osa') {
													$result2 = $this->Common_model->get_allinfo_byid('osa_member', 'userid', $single_value->from_);
												} else {
													$result2 = $this->Common_model->get_allinfo_byid('member', 'userid', $single_value->from_);
												}
												foreach ($result2 as $res) {
													$user_name = $res->name;
												}
												if ($single_value->from_ != $userid) { ?>
													<tr class="<?php if ($single_value->status == 0) {
														echo 'table-info';
													} else {
														echo '';
													} ?>">
														<td style="text-align: center;"><?php echo $count; ?></td>
														<td style="text-align: center;"><?php echo $user_name; ?></td>
														<td style="text-align: center;">
															<a style="margin: 5px;" class="btn btn-primary icon-speech"
															   title="Message"
															   href="#!"
															   onclick="get_message('<?php echo $single_value->to_; ?>','<?php echo $single_value->from_; ?>')">
															</a>
														</td>
													</tr>
												<?php }
												$userid = $single_value->from_;
											}
										} ?>
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
					<div class="card" id="message_body">
						<div class="card-header">

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

		});


		function get_message(receiver_id, sender_id) {
			var post_data = {
				'to_': receiver_id,'from_': sender_id,
				'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
			};
			console.log(post_data);
			$.ajax({
				url: '<?php echo base_url();?>Get_ajax_value/get_message',
				type: "post",
				data: post_data,
				success: function (data) {
					$('#message_body').html(data);
				}
			});
		}

	</script>

