<!--Datepicker-->
<script>
	$(function () {
		$(".new_datepicker").datepicker({
			dateFormat: 'yy-mm-dd',
			constrainInput: true,
			changeYear: true,
			changeMonth: true
		});
	});
</script>
<style>
	div.ui-datepicker{
		font-size:13px;
	}
	/*.ui-datepicker-calendar a.ui-state-default { background: white; }*/
    /*.ui-datepicker-calendar td.ui-datepicker-today a { background: red; }*/
	.ui-datepicker-calendar a.ui-state-hover { background: #066;color: white; }
	.ui-datepicker-calendar a.ui-state-active { background: #066;color: white; }

</style>


<!-- Required Fremwork -->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- waves effects.js -->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/Waves/waves.min.js"></script>

<!-- Scrollbar JS-->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js"></script>

<!--classic JS-->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/classie/classie.js"></script>

<!-- notification -->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/notification/js/bootstrap-growl.min.js"></script>

<!-- Date picker.js -->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/datepicker/js/moment-with-locales.min.js"></script>
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

<!-- Select 2 js -->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/select2/dist/js/select2.full.min.js"></script>

<!-- Max-Length js -->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-maxlength/src/bootstrap-maxlength.js"></script>

<!-- Multi Select js -->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/multi-select/js/jquery.quicksearch.js"></script>

<!-- Tags js -->
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>

<!-- Bootstrap Datepicker js -->
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-datepicker/js/bootstrap-datetimepicker.min.js"></script>

<!-- bootstrap range picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- color picker -->
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/spectrum/spectrum.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/jscolor/jscolor.js"></script>

<!-- highlite js -->
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/syntaxhighlighter/scripts/shCore.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/syntaxhighlighter/scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/plugins/syntaxhighlighter/scripts/shBrushXml.js"></script>
<script type="text/javascript">SyntaxHighlighter.all();</script>

<!-- custom js -->
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/js/main.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>ablepro-lite/assets/pages/advance-form.js"></script>
<script src="<?php echo base_url(); ?>ablepro-lite/assets/js/menu.min.js"></script>



<script>
	var $window = $(window);
	var nav = $('.fixed-button');
	$window.scroll(function () {
		if ($window.scrollTop() >= 200) {
			nav.addClass('active');
		}
		else {
			nav.removeClass('active');
		}
	});
</script>
<!--<script src="--><?php //echo base_url(); ?><!--assets/js/jquery-1.12.4.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
