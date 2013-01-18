<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Customer Details</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Customer Information</h1><span></span></div>
                <!-- <div class="info_msg">Info message</div>
                <div class="success_msg">Successful operation message</div>
                <div class="warning_msg">Warning message</div>-->
                <?php
					if($msg)
					{
                		if($msg == 1) {
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Email sent successfully</li></ul></div>' ;
						} if($msg == 2) {
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to send email</li></ul></div>' ;
						}
					}
				?>
                <form id="customer_form" class="block-content form" action="<?php echo base_url("customer/upadte_customer") ; ?>" method="post">
                	<div class='block-actions'>
						<ul class='actions-right'>
                        	<!--<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Update Customer</a></li>
                            <li class="divider-vertical"></li>-->
                            <li><a id="cancel_form" class="close-toolbox button" href="javascript:void(0);" onclick="javascript:close();">Close</a></li>
						</ul>
					</div>
				</form>
				</div>
			</div>
		</div>
		<div class="clear height-fix"></div>
	</div>
</div> <!--! end of #main-content -->