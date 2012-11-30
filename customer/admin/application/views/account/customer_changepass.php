<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Admin Details</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Admin Information - Change Password</h1><span></span></div>
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
							echo '<div class="success_msg"><ul><li>Password updated successfully</li></ul></div>' ;
						}
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to updated Password</li></ul></div>' ;
						}
					}
				?>
                <form id="admin_change_password" class="block-content form" action="<?php echo base_url("registration/update_password") ; ?>" method="post">
				<input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id; ?>"
                	<fieldset>
                    	<legend>Change Password</legend>
						
                        <div class='_50'>
                        	<p>
                            	<label for="new_password">New Password</label>
                                <input type="password" id="new_password" name="new_password" value="" />
                            </p>
                        </div>
                        
                        <div class='_50'>
                        	<p>
                            	<label for="confirm_new_password">Confirm New Password</label>
                                <input type="password" id="confirm_new_password" name="confirm_new_password" value="" />
                          	</p>
                        </div>
                        
					</fieldset>
                 
                    <div class='block-actions'>
                        <ul class='actions-right'>
						<button type="submit" name="Change Password" title="Change Password">
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
	
	$("#submit_form").click(function(){ $("#admin_change_password").submit() ; }) ;

	$("#cancel_form").click(function(){ window.location.href = "<?php echo base_url("account") ; ?>" ; }) ;

}) ;
</script>