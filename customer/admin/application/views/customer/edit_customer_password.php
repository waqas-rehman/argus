<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Customer Details</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Customer Password</h1><span></span></div>
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
							echo '<div class="error_msg"><ul><li>Failed to update customer password</li></ul></div>' ;
						}
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Customer password updated successfully</li></ul></div>' ;
						}
					}
				?>
                <form id="update_password_form" class="block-content form" action="<?php echo base_url("customer/update_password") ; ?>" method="post">
                	<fieldset>
                    	<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_id ; ?>" />
                    	<legend>Update Customer Password</legend>
                        
						<div class='_50'><p><label for="">Password</label><input type="text" id="password" name="password" value="<?php echo set_value("password") ; ?>" /></p></div>
                    </fieldset>
                 
                    
                    <div class='block-actions'>
						<ul class='actions-left'><li><a id="clear_form" class="close-toolbox button red" href="javascript:void(0);">Clear Form</a></li></ul>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Update Customer</a></li>
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
		$("#company_name").val("") ;
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#submit_form").click(function(){
		$("#update_password_form").submit() ;
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