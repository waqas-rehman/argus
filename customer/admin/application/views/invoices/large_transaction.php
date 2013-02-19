 <div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Payment</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Payment</h1><span></span></div>
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
							echo '<div class="error_msg"><ul><li>Failed to update product record</li></ul></div>' ;
						}
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Product added successfully</li></ul></div>' ;
						}
						if($msg == 4)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Product record updated successfully</li></ul></div>' ;
						}
					}
				?>
                <form id="transactions_form" class="block-content form" action="<?php echo base_url("payments/insert_transaction") ; ?>" method="post" enctype="multipart/form-data">
				<fieldset>
                	<legend>Transaction Details</legend>
						
                        <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_rec->id ; ?>" />
						
                        <div class='_100'>
                        	<p>
                            	<label for="transaction_amount">Amount (&pound;)</label>
                                <input type="text" id="transaction_amount" name="transaction_amount" value="<?php echo set_value('transaction_amount', '0.00') ; ?>" />
                            </p>
                        </div>
					</fieldset>
                    
                    <div class='block-actions'>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Add Payment</a></li>
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
	$("#submit_form").click(function(){	$("#transactions_form").submit() ; }) ;
	$("#cancel_form").click(function(){ window.location.href = "<?php echo base_url("payments/insert_transaction") ; ?>" ; }) ;
}) ;
</script>
