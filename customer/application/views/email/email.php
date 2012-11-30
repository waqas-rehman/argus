<script type="text/javascript" src="<?php echo base_url() ; ?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});
</script>
<!-- /TinyMCE -->
<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Send Message to Customer</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Customer Information</h1><span></span></div>
                <!-- <div class="info_msg">Info message</div>
                <div class="success_msg">Successful operation message</div>
                <div class="warning_msg">Warning message</div>-->
                <?php
					if($msg)
					{
                		if($msg == 1) 
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul>'.validation_errors().'</ul></div>' ;
						}
						if($msg == 2)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to Send Email</li></ul></div>' ;
						}
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Email Sent Successfully</li></ul></div>' ;
						}
						
					}
				?>
                <form id="customer_email_form" class="block-content form" action="<?php echo base_url("customer/send_message") ; ?>" method="post"  enctype="multipart/form-data">
                	<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_rec->id ; ?>" /> 
                    <fieldset>
						<legend>Important Information</legend>
						<div class='_100'><p><b>For Multiple Recipients: </b>Use Comma(,) Separated Email Addresses (e.g. email_address_1, email_address_2, email_address_3)</p></div>
					</fieldset>

                    <fieldset>
                    	<legend>Email Customer</legend>
						
                        <div class='_100'><p><label for="customer_email_address">Customer Email Address</label><input type="text" id="customer_email_address" name="customer_email_address" value="<?php echo set_value("customer_email_address", $customer_rec->email_address) ; ?>" /></p></div>
                        
                        <div class='_50'><p><label for="cc_email_address">CC</label><input type="text" id="cc_email_address" name="cc_email_address" value="<?php echo set_value("cc_email_address") ; ?>" /></p></div>
                        
                        <div class='_50'><p><label for="bcc_email_address">BCC</label><input type="text" id="bcc_email_address" name="bcc_email_address" value="<?php echo set_value("bcc_email_address") ; ?>" /></p></div>
                        
                        <div class='_50'><p><label for="email_subject">Subject</label><input type="text" id="email_subject" name="email_subject" value="<?php echo set_value("email_subject") ; ?>" /></p></div>
                        
                        <div class='_50'><p><label for="save_email_address">Save Message</label><input type="checkbox" id="save_email_message" name="save_email_message" value="yes" <?php echo set_checkbox('save_email_address', 'yes'); ?> /></p></div>
                        
                        <div class='_100'><p><label for="email_message">Message</label><textarea id="email_message" name="email_message" rows="5" cols="40"></textarea></p></div>
												
                        <div class='_100'><p><label for="product_manual">Attachment</label><input type="file" id="email_attachment" name="email_attachment" value="" /></p></div>
                    </fieldset>
                	
                    <div class='block-actions'>
						<ul class='actions-left'><li><a id="clear_form" class="close-toolbox button red" href="javascript:void(0);">Clear Form</a></li></ul>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Send Email</a></li>
                            <li class="divider-vertical"></li>
                            <li><a id="cancel_form" class="close-toolbox button" href="javascript:void(0);">Cancel</a></li>
						</ul>
					</div>
				</form>
				</div>
			</div>
		</div>
		<div class="clear height-fix"></div>
	</div>
</div> <!--! end of #main-content -->
<script type="text/javascript">
$(function(){
	$("#clear_form").click(function(){
		$("#customer_email_address").val("") ;
		$("#cc_email_address").val("") ;
		$("#bcc_email_address").val("") ;
		$("#email_subject").val("") ;
		$("#save_email_message").attr("checked", false);
		$("#uniform-save_email_message span").removeClass("checked") ;
		$("#email_message").val("") ;
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#submit_form").click(function(){
		$("#customer_email_form").submit() ;
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("customer") ; ?>" ;
	}) ;
}) ;
</script>