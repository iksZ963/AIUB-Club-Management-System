<?php foreach ($club_details as $single_value) { ?>
	<div class="card-header" align="center">
		<a style="margin: 5px; float: left;" class="btn btn-info btn-sm icon-action-undo" href="#!"
		   id="default_btn">
		</a>
		<a style="margin: 5px; float: left; display: none;" class="btn btn-info btn-sm icon-action-undo" href="#!"
		   id="club_back_btn">
		</a>
		<div class="card-header-text">
			<p style="font-size: 26px;" id="me_title"><?php echo $single_value->club_name;?></p>
		</div>
		<a style="margin: 5px; float: right;" class="btn btn-info btn-sm icon-pencil" href="#!"
		   id="edit_btn" title="Edit Club Details">
		</a>
	</div>
	<div class="card-block">
		<form class="form-horizontal" id="show_details" enctype="multipart/form-data">
			<div class="form-group row">
				<label for="club_name" class="col-xs-3 col-form-label form-control-label">Club
					Name</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="club_name" id="club_name"
						   autocomplete="off" value="<?php echo $single_value->club_name;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label for="foundation_date" class="col-xs-3 col-form-label form-control-label">Foundation
					Date</label>
				<div class="col-sm-9">
					<input class="form-control new_datepicker" type="text"
						   name="foundation_date"
						   id="foundation_date" autocomplete="off"
						   value="<?php echo $single_value->foundation_date;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label for="slogan"
					   class="col-xs-3 col-form-label form-control-label">Slogan</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="slogan" id="slogan"
						   autocomplete="off" value="<?php echo $single_value->slogan;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label for="details"
					   class="col-xs-3 col-form-label form-control-label">Details</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="details" id="details" readonly><?php echo $single_value->details;?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="current_com" class="col-xs-3 col-form-label form-control-label">Current
					Committee</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="current_com" id="current_com"
						   autocomplete="off" value="<?php echo $single_value->current_committee;?>" readonly>
				</div>
			</div>
			<div class="form-group row">
				<label for="logo"
					   class="col-md-3 col-form-label form-control-label">Logo</label>
				<div class="col-md-9">
					<?php if (file_exists('./assets/img/club/' . $single_value->logo)) { ?>
						<img class="zoom" style="width: 200px; height: 200px;"
							 src="<?php echo base_url(); ?>assets/img/club/<?php echo $single_value->logo; ?>">
					<?php } else {
						echo 'No Image';
					} ?>
				</div>
			</div>

			<!--		<div class="form-group row">-->
			<!--			<div class="col-md-12" align="center">-->
			<!--				<button class="btn btn-primary" id="btn_upload" type="submit">Save</button>-->
			<!--			</div>-->
			<!--		</div>-->
		</form>

		<form class="form-horizontal" id="edit_details" enctype="multipart/form-data" style="display: none;">

			<input class="form-control" type="hidden" name="club_id" id="club_id"
				   autocomplete="off" value="<?php echo $single_value->record_id;?>">

			<div class="form-group row">
				<label for="club_name" class="col-xs-3 col-form-label form-control-label">Club
					Name</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="club_name2" id="club_name2"
						   autocomplete="off" value="<?php echo $single_value->club_name;?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="foundation_date" class="col-xs-3 col-form-label form-control-label">Foundation
					Date</label>
				<div class="col-sm-9">
					<input class="form-control new_datepicker" type="text"
						   name="foundation_date2"
						   id="foundation_date2" autocomplete="off"
						   value="<?php echo $single_value->foundation_date;?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="slogan"
					   class="col-xs-3 col-form-label form-control-label">Slogan</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="slogan2" id="slogan2"
						   autocomplete="off" value="<?php echo $single_value->slogan;?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="details"
					   class="col-xs-3 col-form-label form-control-label">Details</label>
				<div class="col-sm-9">
					<textarea class="form-control" name="details2" id="details2"><?php echo $single_value->details;?></textarea>
				</div>
			</div>
			<div class="form-group row">
				<label for="current_com" class="col-xs-3 col-form-label form-control-label">Current
					Committee</label>
				<div class="col-sm-9">
					<input class="form-control" type="text" name="current_com2" id="current_com2"
						   autocomplete="off" value="<?php echo $single_value->current_committee;?>">
				</div>
			</div>
			<div class="form-group row">
				<label for="logo"
					   class="col-md-3 col-form-label form-control-label">Logo</label>
				<div class="col-md-9">
					<?php if (file_exists('./assets/img/club/' . $single_value->logo)) { ?>
						<img class="zoom" style="width: 200px; height: 200px;"
							 src="<?php echo base_url(); ?>assets/img/club/<?php echo $single_value->logo; ?>">
					<?php } else {
						echo 'No Image';
					} ?>
					<input type="file" id="logo2" name="logo2" class="form-control">
				</div>
			</div>

			<div class="form-group row">
				<div class="col-md-12" align="center">
					<button class="btn btn-primary" id="btn_upload" type="submit">Edit</button>
				</div>
			</div>
		</form>
	</div>

<?php } ?>


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

