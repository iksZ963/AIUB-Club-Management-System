<div class="card-header" align="center">

</div>

<div class="card-block" style="height: 800px; overflow-y: scroll;">
	<p id="name_header"></p>
	<?php if(!empty($messages)){
		foreach ($messages as $msg){?>
			<div class="bg-info" style="border-radius: 10px;"><?php
				echo '<h4 style="padding: 10px 0px 0px 10px;">'.$msg->message.'</h4>';
				echo '<p style="color: white; padding: 0px 0px 0px 10px;">'.date('d M Y',strtotime($msg->date)).' '.date('H:i A',strtotime($msg->time)).'</p>';
				?></div><br>
		<?php }
	}?>

	<?php if(!empty($messages2)) {
		foreach ($messages2 as $msg){?>
			<div class="bg-gray" style="border-radius: 10px; text-align: right;"><?php
				echo '<h4 style="padding: 10px 10px 0px 0px;">'.$msg->message.'</h4>';
				echo '<p style="color: black; padding: 0px 10px 0px 0px;">'.date('d M Y',strtotime($msg->date)).' '.date('H:i A',strtotime($msg->time)).'</p>';
				?></div><br>
		<?php }
	}?>
	<form class="form-horizontal" enctype="multipart/form-data" id="msg_box">
		<div class="form-group">
			<div class="col-md-8 ui-front">
				<input class="form-control" type="hidden" name="to_" id="to_"
					   autocomplete="off" value="<?php echo $from_;?>">
				<textarea rows="10" type="text" class="form-control" id="message"
						  name="message"></textarea>
			</div>
		</div>

		<button class="btn btn-primary" id="btn_upload" type="submit">Reply</button>
<!--		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
		<p style="color: red;" id="empty_msg"></p>

	</form>
</div>

<script type="text/javascript">
	$('#msg_box').submit(function (e) {
		alert('a' + $('#message').val() + 'a');
		if($.trim($('#message').val()) == ""){
			$('#empty_msg').text('Nothing to Send');
			$('#message').val('');
		} else {

			$.ajax({
				url: '<?php echo base_url();?>Insert/send_message',
				type: "post",
				data: new FormData(this),
				processData: false,
				contentType: false,
				cache: false,
				async: false,
				success: function (data) {
					$("#empty_msg").css("color", "green");
					$('#empty_msg').text('Message Sent Successfully');
				}
			});
		}
	});
</script>
