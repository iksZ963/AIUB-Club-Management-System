<div class="content-wrapper">
	<!-- Container-fluid starts -->
	<div class="container-fluid">
		<!-- Main content starts -->
		<div>
			<!-- Row Starts -->
			<div class="row">

				<div class="col-sm-12 p-0">
					<div class="main-header">
						<h4>Calendar</h4>
						<ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Log_in_out"><i
										class="icofont icofont-home"></i></a>
							</li>
							<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Show_form/calendar/main">Calendar </a>
							</li>
						</ol>
					</div>
				</div>
			</div>
			<!-- Row end -->

			<!-- Row start -->
			<div class="row">
				<div class="col-lg-3"></div>
				<div class="col-lg-6">
					<div class="card">
						<div class="card-header" align="center">


						</div>
						<div class="card-block">
							<div id="calendar"></div>
							<div class="modal fade" id="addModal" tabindex="-1" role="dialog"
								 aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Add Calendar Event</h4>
										</div>
										<div class="modal-body">
											<?php echo form_open(site_url("calendar/add_event"), array("class" => "form-horizontal")) ?>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">Event Name</label>
												<div class="col-md-8 ui-front">
													<input type="text" class="form-control" name="name" value="">
												</div>
											</div>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">Description</label>
												<div class="col-md-8 ui-front">
													<textarea rows="5" type="text" class="form-control" name="description"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">Start Date</label>
												<div class="col-md-8">
													<input type="text" autocomplete="off"
														   class="form-control new_datepicker" name="start_date" id="start_date1">
												</div>
											</div>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">End Date</label>
												<div class="col-md-8">
													<input type="text" autocomplete="off"
														   class="form-control new_datepicker" name="end_date">
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close
											</button>
											<input type="submit" class="btn btn-primary" value="Add Event">
											<?php echo form_close() ?>
										</div>
									</div>
								</div>
							</div>

							<div class="modal fade" id="editModal" tabindex="-1" role="dialog"
								 aria-labelledby="myModalLabel">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="myModalLabel">Update Calendar Event</h4>
										</div>
										<div class="modal-body">
											<?php echo form_open(site_url("calendar/edit_event"), array("class" => "form-horizontal")) ?>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">Created By</label>
												<div class="col-md-8 ui-front">
													<input type="text" class="form-control" name="created_by" value=""
														   id="created_by" readonly>
												</div>
											</div>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">Event Name</label>
												<div class="col-md-8 ui-front">
													<input type="text" class="form-control" name="name" value=""
														   id="name">
												</div>
											</div>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">Description</label>
												<div class="col-md-8 ui-front">
													<textarea rows="5" type="text" class="form-control" name="description"
													id="description"></textarea>
												</div>
											</div>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">Start Date</label>
												<div class="col-md-8">
													<input type="text" autocomplete="off" id="start_date"
														   class="form-control new_datepicker" name="start_date">
												</div>
											</div>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">End Date</label>
												<div class="col-md-8">
													<input type="text" autocomplete="off" id="end_date"
														   class="form-control new_datepicker" name="end_date">
												</div>
											</div>
											<div class="form-group">
												<label for="p-in" class="col-md-4 label-heading">Delete Event</label>
												<div class="col-md-8">
													<input type="checkbox" name="delete" value="1">
												</div>
											</div>
											<input type="hidden" name="eventid" id="event_id" value="0"/>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close
											</button>
											<input type="submit" class="btn btn-primary" value="Update Event">
											<?php echo form_close() ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	$(document).ready(function () {
		$('#calendar').fullCalendar({});
	});

	var date_last_clicked = null;

	$('#calendar').fullCalendar({
		eventSources: [
			{
				events: function (start, end, timezone, callback) {
					$.ajax({
						url: '<?php echo base_url() ?>calendar/get_events',
						dataType: 'json',
						data: {
							start: start.unix(),
							end: end.unix()
						},
						success: function (msg) {
							var events = msg.events;
							callback(events);
						}
					});
				}
			},
		],
		dayClick: function (date, jsEvent, view) {
			date_last_clicked = $(this);
			$('#start_date1').val($.datepicker.formatDate('yy-mm-dd', new Date(date)));
			$('#addModal').modal();
		},
		eventClick: function (event, jsEvent, view) {
			$('#created_by').val(event.created_by);
			$('#name').val(event.title);
			$('#description').val(event.description);
			$('#start_date').val(moment(event.start).format('YYYY-MM-DD'));
			if (event.end) {
				$('#end_date').val(moment(event.end).format('YYYY-MM-DD'));
			} else {
				$('#end_date').val(moment(event.start).format('YYYY-MM-DD'));
			}
			$('#event_id').val(event.id);
			$('#editModal').modal();
		},
	});
</script>
