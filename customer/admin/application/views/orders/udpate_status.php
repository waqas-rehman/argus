<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Order Details</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Order Status Information</h1><span></span></div>
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
		<form id="order_status_form" class="block-content form" action="<?php echo base_url("orders/update_status") ; ?>" method="post">
        <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_rec->id ; ?>" />
        <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $order_rec->customer_id ; ?>" /> 
        
        <fieldset>
        	<legend>Order Basic Information</legend><br />
   			<div class='_100'><p><span class='label'><b>Current Status: </b> <?php echo $order_rec->status ; ?> </span></p></div>
            
            <div class='_50'>
            	<p>
            		<span class='label'><b>Status</b></span>
						<select id="status" name="status">
							<option value="Pending" <?php if($order_rec->status == "Pending") echo 'selected="selected"' ; ?>>Pending</option>
                            <option value="Ordered" <?php if($order_rec->status == "Ordered") echo 'selected="selected"' ; ?>>Ordered</option>
							<option value="Accepted" <?php if($order_rec->status == "Accepted") echo 'selected="selected"' ; ?>>Accepted</option>
							<option value="Shipped" <?php if($order_rec->status == "Shipped") echo 'selected="selected"' ; ?>>Shipped</option>
							<option value="Invoiced" <?php if($order_rec->status == "Invoiced") echo 'selected="selected"' ; ?>>Invoiced</option>
							<option value="Outstanding" <?php if($order_rec->status == "Outstanding") echo 'selected="selected"' ; ?>>Outstanding</option>
							<option value="Completed" <?php if($order_rec->status == "Completed") echo 'selected="selected"' ; ?>>Completed</option>
						</select>
				</p>
				
				<div class='_50'>
            	<p>
					<span class='label'><b>Insert Note / Delivery Date here..</b></span>
            		
						<input type="text" id="email_data" name="email_data" value="" />
				</p>
			</div>
			
		</fieldset>
		
        <div class='block-actions'>
        	<ul class='actions-right'>
            	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Update Status</a></li>
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
		$("#order_status_form").submit() ;
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