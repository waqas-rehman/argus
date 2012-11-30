<div id="right">
	<div class="section">
		<div class="box">
        	<div class="title">Account Information<span class="hide"></span></div>
            <div class="content">
                <?php
					if($msg)
					{
						if($msg == 1) echo '<div class="message green"><span>Information updated successfully</span></div>' ;
						if($msg == 2) echo '<div class="message red"><span>Failed to update record</span></div>' ;
					} 
				?>
                <form action="<?php echo base_url("account/update_account_info") ; ?>" method="post" class="valid">
                    
                    <div class="row">
                       	<label>Company Name</label>
                        <div class="right"><input type="text" value="<?php echo $customer_rec->company_name ; ?>" name="company_name" class="{validate:{required:true, messages:{required:'Company Name is required'}}}" /></div>
                    </div>
                    
                    <div class="row">
                        <label>Contact Person Name</label>
                        <div class="right"><input type="text" value="<?php echo $customer_rec->contact_person_name ; ?>" name="contact_person_name" class="{validate:{required:true, messages:{required:'Contact Person name is required'}}}" /></div>
                    </div>
                    
                    <div class="row">
                        <label>Email Address</label>
                        <div class="right"><input type="text" value="<?php echo $customer_rec->email_address ; ?>" name="email_address" class="{validate:{required:true, email:true, messages:{required:'Please enter new password', email:'Email should be valid'}}}" /></div>
                    </div>
                    
                    <div class="row">
                        <label>Telephone Number</label>
                        <div class="right"><input type="text" value="<?php echo $customer_rec->telephone_number ; ?>" name="telephone_number" class="{validate:{required:true, messages:{required:'Telephone Number is required'}}}" /></div>
                    </div>

                    <div class="row">
                        <label>Address Line 1</label>
                        <div class="right"><input type="text" value="<?php echo $customer_rec->address_line_1 ; ?>" name="address_line_1" class="{validate:{required:true, messages:{required:'Address Line 1 is required'}}}" /></div>
                    </div>
                    
                    <div class="row">
                        <label>Address Line 2</label>
                        <div class="right"><input type="text" value="<?php echo $customer_rec->address_line_2 ; ?>" name="address_line_2" class="{validate:{required:true, messages:{required:'Address Line 2 is required'}}}" /></div>
                    </div>
                    
                    <div class="row">
                        <label>City</label>
                        <div class="right"><input type="text" value="<?php echo $customer_rec->city ; ?>" name="city" class="{validate:{required:true, messages:{required:'City is required'}}}" /></div>
                    </div>
                  	
                    <div class="row">
                        <label>Country</label>
                        <div class="right"><input type="text" value="<?php echo $customer_rec->country ; ?>" name="country" class="{validate:{required:true, messages:{required:'Country is required'}}}" /></div>
                    </div>
                    
                    <div class="row">
                        <label>Post Code</label>
                            <div class="right"><input type="text" value="<?php echo $customer_rec->post_code ; ?>" name="post_code" class="{validate:{required:true, messages:{required:'Post Code is required'}}}" /></div>
                    </div>
                    
                    
                    <div class="row">
                    	<label></label>
                        <div class="right"><button type="submit"><span>Update Info</span></button>&nbsp;<button type="button" id="cancel_button"><span>Cancel</span></button></div>
                   	</div>
                
                </form>
            </div>
		</div>
	</div>
</div>
<script type="application/javascript">
	$(function(){
		$("#cancel_button").click(function(){
			window.location.href = "<?php echo base_url("dashboard") ; ?>";
		}) ;
	}) ;
</script>