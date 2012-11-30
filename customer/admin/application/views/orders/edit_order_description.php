<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Order Details</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Order Information</h1><span></span></div>
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
                <form id="order_information_form" class="block-content form" action="<?php echo base_url("orders/update_order_description") ; ?>" method="post">
                	<input type="hidden" id="order_id" name="order_id" value="<?php echo $order_rec->id ; ?>" />
                    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $order_rec->customer_id ; ?>" /> 
                    
                    <!-- <fieldset>
						<legend>Important Information</legend>
						<div class='_100'><p><b>For Multiple Recipients: </b>Use Comma(,) Separated Email Addresses (e.g. email_address_1, email_address_2, email_address_3)</p></div>
					</fieldset> -->

                    <fieldset>
                    	<legend>Order Basic Information</legend>
                        <br />
                        
                    <div class="_100">
								<p class="no-top-margin"><label for="message">Message</label><textarea id="order_description" name="order_description" rows="5" cols="40"><?php echo set_value("order_description", $order_rec->order_description) ; ?></textarea></p>
							</div>
                        
                    </fieldset>
                	
                    <div class='block-actions'>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Update Info</a></li>
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
		$("#order_information_form").submit() ;
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("orders/order_details/".$order_rec->id) ; ?>" ;
	}) ;
}) ;
</script>