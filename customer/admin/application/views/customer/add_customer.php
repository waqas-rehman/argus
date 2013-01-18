 <div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Add New Customer</h1></div>
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
							echo '<div class="error_msg"><ul><li>Failed to Add Staff</li></ul></div>' ;
						}
					}
				?>
                <form id="customer_form" class="block-content form" action="<?php echo base_url("customer/add_customer") ; ?>" method="post">
                	<fieldset>
                    	<legend>Company Information</legend>
						<div class='_50'><p><label for="company_name">Company Name</label><input type="text" id="company_name" name="company_name" value="<?php echo set_value("company_name") ; ?>" /></p></div>
                        <div class='_50'><p><label for="contact_person_name">Contact Person Name</label><input type="text" id="contact_person_name" name="contact_person_name" value="<?php echo set_value("contact_person_name") ; ?>" /></p></div>
                        <div class='_50'><p><label for="email_address">Email Address</label><input type="text" id="email_address" name="email_address" value="<?php echo set_value("email_address") ; ?>" /></p></div>
                        <div class='_50'><p><label for="telephone_number">Telephone Number</label><input type="text" id="telephone_number" name="telephone_number" value="<?php echo set_value("telephone_number") ; ?>" /></p></div>
                        <div class='_50'><p><label for="address_line_1">Address Line 1</label><input type="text" id="address_line_1" name="address_line_1" value="<?php echo set_value("address_line_1") ; ?>" /></p></div>
                        <div class='_50'><p><label for="address_line_2">Address Line 2</label><input type="text" id="address_line_2" name="address_line_2" value="<?php echo set_value("address_line_2") ; ?>" /></p></div>
                        <div class='_50'><p><label for="city">City</label><input type="text" id="city" name="city" value="<?php echo set_value("city") ; ?>" /></p></div>
                        <div class='_50'><p><label for="county">County</label><input type="text" id="county" name="county" value="<?php echo set_value("county") ; ?>" /></p></div>
                        <div class='_50'><p><label for="post_code">Post Code</label><input type="text" id="post_code" name="post_code" value="<?php echo set_value("post_code") ; ?>" /></p></div>
                        <div class='_50'><p><label for="country">Country</label><input type="text" id="country" name="country" value="<?php echo set_value("country") ; ?>" /></p></div>
                        <div class='_50'><p><span class="status">Status</span><select id="status" name="status"><option value="Active" <?php echo set_select('status', 'Active', TRUE); ?>>Active</option><option value="Disable" <?php echo set_select('status', 'Disable'); ?>>Disable</option></select></p></div>
					</fieldset>
                 
                    <fieldset>
                    	<legend>Customer Login Information</legend>
                        <div class='_50'><p><label for="username">Username</label><input type="text" id="username" name="username" value="<?php echo set_value("username") ; ?>" /></p></div>
                        
					</fieldset>
                    
                    <fieldset>
                    	<legend>Relationship with Customer</legend>
                        
                        <div class='_50'>
                        	<p>
                            	<label for="username">Applicable VAT Code</label>
                                	<select id="vat_code" name="vat_code">
                                    	<option value="">Select VAT Code</option>
                        				<?php if($vat_codes) { foreach($vat_codes as $rec): ?>
                            			<option value="<?php echo $rec->id ; ?>" <?php echo set_select('vat_code', $rec->id); ?>><?php echo $rec->vat_code." (".$rec->vat_rate."% )" ; ?></option>
                        				<?php endforeach ; } ?>
                            		</select>
							</p>
                        </div>
                        
                        <div class='_50'>
                        	<p>
                            	<label for="">Maximum Credit Limit?</label>
                                <input type="text" id="maximum_credit_limit" name="maximum_credit_limit" value="<?php echo set_value("maximum_credit_limit") ; ?>" />
							</p>
						</div>
                        
                        <div class='_50'>
                        	<p>
                            	<label for="">Maximum Limit after which transport is free?</label>
                                <input type="text" id="maximum_limit" name="maximum_limit" value="<?php echo set_value("maximum_limit") ; ?>" />
							</p>
						</div>
                        
                        <div class='_50'>
                        	<p>
                            	<label for="">Transport Charges</label>
                                <input type="text" id="transport_charges" name="transport_charges" value="<?php echo set_value("transport_charges") ; ?>" />
							</p>
						</div>
                        
                        <div class='_50'>
                        	<p>
                            	<label for="">Payment Terms (Days)</label>
                                <input type="text" id="overdue_days" name="overdue_days" value="<?php echo set_value("overdue_days") ; ?>" />
							</p>
						</div>
                        
                        <div class='_50'>
                        	<p>
                            	<label for="username">Special Prices?</label>
                        		<input type="radio" id="special_prices_1" name="special_prices" value="Yes" <?php echo set_radio('special_prices', 'Yes'); ?> /> Yes
                                <input type="radio" id="special_prices_2" name="special_prices" value="No" <?php echo set_radio('special_prices', 'No', TRUE); ?> /> No
                            </p>
                        </div>
                        
                        <div class='_50'>
                        	<p>
                            	<label for="username">Send Registration Email?</label>
                        		<input type="radio" id="send_registration_email_1" name="registration_email_sent" value="Yes" <?php echo set_radio('registration_email_sent', 'Yes', TRUE); ?> /> Yes
                                <input type="radio" id="send_registration_email_2" name="registration_email_sent" value="No" <?php echo set_radio('registration_email_sent', 'No'); ?> /> No
                            </p>
                        </div>
                        
					</fieldset>
					
                    <div class='block-actions'>
						<ul class='actions-left'><li><a id="clear_form" class="close-toolbox button red" href="javascript:void(0);">Clear Form</a></li></ul>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Add Customer</a></li>
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
		$("#contact_person_name").val("") ;
		$("#email_address").val("") ;
		$("#telephone_number").val("") ;
		$("#address_line_1").val("") ;
		$("#address_line_2").val("") ;
		$("#city").val("") ;
		$("#country").val("") ;
		$("#post_code").val("") ;
		$("#status").val("Active") ;
		$("#uniform-status span").html("Active") ;
		$("#username").val("") ;
		$("#password").val("") ;
		
		if($('#special_prices_1').is(':checked'))
		{
			$("#special_prices_1").attr("checked", false) ;
			$("#uniform-special_prices_1 span").removeClass("checked") ;
		
			$("#special_prices_2").attr("checked", true) ;
			$("#uniform-special_prices_2 span").addClass("checked") ;
		}

		$("#maximum_limit").val("") ;
		$("#transport_charges").val("") ;
		$("#overdue_days").val("") ;
		
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#submit_form").click(function(){
		$("#customer_form").submit() ;
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