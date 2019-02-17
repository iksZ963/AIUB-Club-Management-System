<div class="content-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-12 col-lg-12">
				<div class="card">
					<div class="user-block-2">
						<h2>AIUB CLUB MANAGEMENT SYSTEM</h2>
					</div>

					<div class="col-lg-12">
						<div class="card">
							<div class="card-header" align="center">
								<div class="card-header-text">
									<h4>Posts</h4>
								</div>
							</div>
						</div>
					</div>
					<?php $count = 0;
					$userid = '';
					foreach ($all_post as $single_value) {
						if ($this->session->ses_user_type != 'osa') {
							$result = $this->Common_model->get_allinfo_byid('member', 'userid', $this->session->ses_userid);
							foreach ($result as $res) {
								$club_id = $res->club_id;
							}
							$rcpt = explode('#', $single_value->posted_to);
							if (in_array($club_id, $rcpt)) {
								$result = $this->Common_model->get_allinfo_byid('login', 'userid', $single_value->posted_by);
								foreach ($result as $res) {
									$user_t = $res->user_type;
								}
								if ($user_t == 'osa') {
									$result2 = $this->Common_model->get_allinfo_byid('osa_member', 'userid', $single_value->posted_by);
								} else {
									$result2 = $this->Common_model->get_allinfo_byid('member', 'userid', $single_value->posted_by);
								}
								foreach ($result2 as $res) {
									$user_name = $res->name;
								}
								?>
								<div class="col-lg-6">
									<div class="card">
										<div class="card-block" id="club_actions">
											<p style="font-size: 16px;"
											   id="name_header"><?php echo $user_name; ?></p>
											<p style="font-size: 12px;"><?php echo date('d F Y', strtotime($single_value->date)) . '&emsp;' . date('H:i A', strtotime($single_value->time)); ?></p>
											<br>
											<p style="font-size: 14px; text-align: justify-all;"><?php echo $single_value->post; ?></p>
										</div>
									</div>
									<!-- Textual inputs ends -->
								</div>
							<?php }
						} else {
							$result = $this->Common_model->get_allinfo_byid('login', 'userid', $single_value->posted_by);
							foreach ($result as $res) {
								$user_t = $res->user_type;
							}
							if ($user_t == 'osa') {
								$result2 = $this->Common_model->get_allinfo_byid('osa_member', 'userid', $single_value->posted_by);
							} else {
								$result2 = $this->Common_model->get_allinfo_byid('member', 'userid', $single_value->posted_by);
							}
							foreach ($result2 as $res) {
								$user_name = $res->name;
							} ?>
							<div class="col-lg-6">
								<div class="card">
									<div class="card-block" id="club_actions">
										<p style="font-size: 16px;"
										   id="name_header"><?php echo $user_name; ?></p>
										<p style="font-size: 12px;"><?php echo date('d F Y', strtotime($single_value->date)) . '&emsp;' . date('H:i A', strtotime($single_value->time)); ?></p>
										<br>
										<p style="font-size: 14px; text-align: justify-all;"><?php echo $single_value->post; ?></p>
									</div>
								</div>
								<!-- Textual inputs ends -->
							</div>
						<?php }
					} ?>
				</div>
			</div>
		</div>
	</div>
</div>
