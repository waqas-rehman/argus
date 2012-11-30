<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Admin Details</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Admin Information</h1><span></span></div>
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
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Profile information updated successfully</li></ul></div>' ;
						}
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to update profile information</li></ul></div>' ;
						}
					}
				?>
                <form id="admin_profile_form" class="block-content form" action="<?php echo base_url("account/update_profile") ; ?>" method="post">
                	<fieldset>
                    	<legend>Admin Account Information</legend>
						
                        <div class='_100'><p>Want to Change Password?&nbsp;<a href="<?php echo base_url("account/change_password") ; ?>">Click here</a></p></div>
                        
                        <div class='_100'>
                        	<p>
                            	<label for="company_name">Admin Name</label>
                                <input type="text" id="contact_person_name" name="contact_person_name" value="<?php echo $admin_rec->contact_person_name ; ?>" />
                            </p>
                        </div>
                        
                        <div class='_100'>
                        	<p>
                            	<label for="contact_person_name">Email Address</label>
                                <input type="text" id="email_address" name="email_address" value="<?php echo $admin_rec->email_address ; ?>" />
                          	</p>
                        </div>
                        
					</fieldset>
                 
                    <div class='block-actions'>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Update Information</a></li>
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
	$("#submit_form").click(function(){
		$("#admin_profile_form").submit() ;
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("dashboard") ; ?>" ;
	}) ;
}) ;
</script>