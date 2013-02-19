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
                		if($msg == 1)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul>'.validation_errors().'</ul></div>' ;
						}
						if($msg == 2)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to update customer record</li></ul></div>' ;
						}
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Customer added successfully</li></ul></div>' ;
						}
						if($msg == 4)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Customer record updated successfully</li></ul></div>' ;
						}
						if($msg == 5)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Customer products added successfully</li></ul></div>' ;
						}
						if($msg == 6)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Customer password updated successfully</li></ul></div>' ;
						}
						if($msg == 7)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to update customer password</li></ul></div>' ;
						}
					}
				?>
                <form id="customer_form" class="block-content form" action="<?php echo base_url("customer/upadte_customer") ; ?>" method="post">
                	<fieldset>
                    	<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_rec->id ; ?>" />
                    	<legend>Company Information</legend>
						<div class='_50'><p><label for="company_name">Company Name</label><input type="text" id="company_name" name="company_name" value="<?php echo set_value("company_name", $customer_rec->company_name) ; ?>" /></p></div>
                        <div class='_50'><p><label for="contact_person_name">Contact Person Name</label><input type="text" id="contact_person_name" name="contact_person_name" value="<?php echo set_value("contact_person_name", $customer_rec->contact_person_name) ; ?>" /></p></div>
                        <div class='_50'><p><label for="email_address">Email Address</label><input type="text" id="email_address" name="email_address" value="<?php echo set_value("email_address", $customer_rec->email_address) ; ?>" /></p></div>
                        <div class='_50'><p><label for="email_address">Account Email</label><input type="text" id="account_email" name="account_email" value="<?php echo set_value("account_email", $customer_rec->account_email) ; ?>" /></p></div>
                        <div class='_50'><p><label for="telephone_number">Telephone Number</label><input type="text" id="telephone_number" name="telephone_number" value="<?php echo set_value("telephone_number", $customer_rec->telephone_number) ; ?>" /></p></div>
                        <div class='_50'><p><label for="address_line_1">Address Line 1</label><input type="text" id="address_line_1" name="address_line_1" value="<?php echo set_value("address_line_1", $customer_rec->address_line_1) ; ?>" /></p></div>
                        <div class='_50'><p><label for="address_line_2">Address Line 2</label><input type="text" id="address_line_2" name="address_line_2" value="<?php echo set_value("address_line_2", $customer_rec->address_line_2) ; ?>" /></p></div>
                        <div class='_50'><p><label for="city">City</label><input type="text" id="city" name="city" value="<?php echo set_value("city", $customer_rec->city) ; ?>" /></p></div>
                        <div class='_50'><p><label for="county">County</label><input type="text" id="county" name="county" value="<?php echo set_value("county", $customer_rec->county) ; ?>" /></p></div>
                        <div class='_50'><p><label for="post_code">Post Code</label><input type="text" id="post_code" name="post_code" value="<?php echo set_value("post_code", $customer_rec->post_code) ; ?>" /></p></div>
                        <div class='_50'><p><label for="country">Country</label><input type="text" id="country" name="country" value="<?php echo set_value("country", $customer_rec->country) ; ?>" /></p></div>
                        <div class='_50'><p><span class="status">Status</span><select id="status" name="status"><option value="Active" <?php if($customer_rec->status == "Active") echo 'selected="selected"'; ?>>Active</option><option value="Disable" <?php if($customer_rec->status == "Disable") echo 'selected="selected"'; ?>>Disable</option></select></p></div>
					</fieldset>
                 
                    <fieldset>
                    	<legend>Customer Login Information</legend>
                        <div class='_50'><p><label for="username">Username</label><input type="text" id="username" name="username" value="<?php echo set_value("username", $customer_login_rec->username) ; ?>" /></p></div>
                        
                        <div class='_50'><p><label for="username">Change/Update Password</label><b><a href="<?php echo base_url("customer/edit_password/".$customer_rec->id) ; ?>">Click here</a></b></p></div>
					</fieldset>
                    
                    <fieldset>
                    	<legend>Relationship with Customer</legend>
                        	<div class='_50'>
                            	<p><span class="status">Applicable VAT Code</span>
                                	<select id="vat_code" name="vat_code"><option value="">Select VAT Code</option>
                        				<?php if($vat_codes) { foreach($vat_codes as $rec): ?>
                            				<option value="<?php echo $rec->id ; ?>" <?php if($rec->id == $customer_rec->vat_code) echo 'selected="selected"'; ?>><?php echo $rec->vat_code." (".$rec->vat_rate."% )" ; ?></option>
                        			<?php endforeach ; } ?>
                            </select></p></div>
                     	
                        <div class='_50'>
                        	<p>
                            	<label for="">Maximum Credit Limit?</label>
                                <input type="text" id="maximum_credit_limit" name="maximum_credit_limit" value="<?php echo set_value("maximum_credit_limit", $customer_rec->maximum_credit_limit) ; ?>" />
							</p>
						</div>	
                        
                        <div class='_50'><p><label for="">Maximum Limit after which transport is free?</label><input type="text" id="maximum_limit" name="maximum_limit" value="<?php echo $customer_rec->maximum_limit ; ?>" /></p></div>
                        
                        <div class='_50'><p><label for="">Transport Charges</label><input type="text" id="transport_charges" name="transport_charges" value="<?php echo $customer_rec->transport_charges ; ?>" /></p></div>
                        
                        <div class='_50'><p><label for="">Payment Terms (Days)</label><input type="text" id="overdue_days" name="overdue_days" value="<?php echo $customer_rec->overdue_days ; ?>" /></p></div>
                        
                        <div class='_50'>
                        	<p>
                            	<label for="username">Registration Email Sent? <?php if($customer_rec->registration_email_sent == "Yes") echo "Yes" ;
                                else echo "<b style=\"color:red;\">No</b>"."&nbsp;".'<a href="'.base_url("customer/send_registration_email/".$customer_rec->id."/2").'"  target="_blank">Send Email</a>' ; ?></label>
                            </p>
                        </div>
                            
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