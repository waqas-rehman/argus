</div> <!--! end of #main -->
</div> <!--! end of #container -->

  <!-- JavaScript at the bottom for fast page loading -->


  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="<?php echo base_url() ; ?>js/plugins.js"></script> <!-- lightweight wrapper for consolelog, optional -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery-ui-1.8.15.custom.min.js"></script> <!-- jQuery UI -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.notifications.js"></script> <!-- Notifications  -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.uniform.min.js"></script> <!-- Uniform (Look & Feel from forms) -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.validate.min.js"></script> <!-- Validation from forms -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.dataTables.min.js"></script> <!-- Tables -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.tipsy.js"></script> <!-- Tooltips -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/excanvas.js"></script> <!-- Charts -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.visualize.js"></script> <!-- Charts -->
  <script defer src="<?php echo base_url() ; ?>js/mylibs/jquery.slidernav.min.js"></script> <!-- Contact List -->
  <script defer src="<?php echo base_url() ; ?>js/common.js"></script> <!-- Generic functions -->
  <script defer src="<?php echo base_url() ; ?>js/script.js"></script> <!-- Generic scripts -->
  
  <script type="text/javascript">
	$().ready(function() {
		
		/*
		 * Form Validation
		 */
		$.validator.setDefaults({
			submitHandler: function(e) {
				$.jGrowl("Form was successfully submitted.", { theme: 'success' });
				$(e).parent().parent().fadeOut();
				v.resetForm();
				v2.resetForm();
				v3.resetForm();
			}
		});
		var v = $("#create-user-form").validate();
		jQuery("#reset").click(function() { v.resetForm(); $.jGrowl("User was not created!", { theme: 'error' }); });
		
		var v2 = $("#write-message-form").validate();
		jQuery("#reset2").click(function() { v2.resetForm(); $.jGrowl("Message was not sent.", { theme: 'error' }); });
		
		var v3 = $("#create-folder-form").validate();
		jQuery("#reset3").click(function() { v3.resetForm(); $.jGrowl("Folder was not created!", { theme: 'error' }); });
		
		/*
		 * Datepicker
		 */
		$( "#datepicker" ).datepicker();
		
		/*
		 * DataTables
		 */
		$('#table-example').dataTable();
		
		/*
		 * Charts
		 */
		$('#graph-data').visualize({type: 'line', height: 250}).appendTo('#tab-line').trigger('visualizeRefresh');
		$('#graph-data').visualize({type: 'area', height: 250}).appendTo('#tab-area').trigger('visualizeRefresh');
		$('#graph-data').visualize({type: 'pie', height: 250}).appendTo('#tab-pie').trigger('visualizeRefresh');
		$('#graph-data').visualize({type: 'bar', height: 250}).appendTo('#tab-bar').trigger('visualizeRefresh');
		
		/*
		 * Tabs
		 */
		$("#specify-a-unique-tab-name").createTabs();
		$("#tab-graph").createTabs();
		
		/*
		 * Contact List
		 */
		$('#slider').sliderNav();
		
	});
  </script>
  <!-- end scripts-->

  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

</body>
</html>