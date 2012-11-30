<div id="right">
	<div class="section">
		<div class="box">
        	<div class="title">Change Password<span class="hide"></span></div>
            <div class="content">
            	<?php
					if($msg)
					{
						if($msg == 1) echo '<div class="message green"><span>Password updated successfully</span></div>' ;
						if($msg == 2) echo '<div class="message red"><span>Failed to update password</span></div>' ;
					} 
				?>
                <form action="<?php echo base_url("account/update_password") ; ?>" method="post" class="valid">
                    
                    <div class="row">
                        <label>New Password</label>
                        <div class="right"><input type="password" value="" id="new_password" name="new_password" class="{validate:{required:true, messages:{required:'Please enter new password'}}}" /></div>
                    </div>
                    
                    <div class="row">
                        <label>Confirm New Password</label>
                            <div class="right"><input type="password" value="" name="confirm_new_password" class="{validate:{required:true,equalTo:'#new_password', messages:{required:'Please enter new password', equalTo:'Confirm New Password must equal to New Password'}}}" /></div>
                            <br />
                    </div>
                    
                    <div class="row">
                    	<label></label>
                        <div class="right">
                        	<button type="submit"><span>Change Password</span></button>
                        	<button type="button" id="cancel_button"><span>Cancel</span></button>
                        </div>
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