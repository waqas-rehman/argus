 <div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Payment/Credit Note for Invoice</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Payment/Credit Note Invoice</h1><span></span></div>
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
                <form id="transactions_form" class="block-content form" action="<?php echo base_url("invoices/update_transaction") ; ?>" method="post" enctype="multipart/form-data">
                	<fieldset>
                    	<legend>Transaction Details</legend>
						
						<input type="hidden" name="order_id" id="order_id" value="<?php echo $order_rec->id ; ?>" />
						<input type="hidden" name="customer_id" id="customer_id" value="<?php echo $order_rec->customer_id ; ?>" />
						
						<div class='_100'><p><label for="product_name">Purchase Order Number</label><input type="text" disabled="disabled" id="" name="" value="<?php echo $order_rec->purchase_order_number ; ?>" /></p></div>
						
						<div class='_100'><p><label for="product_name">Invoiced Amount</label><input type="text" disabled="disabled" id="" name="" value="<?php echo $order_rec->invoice_amount ; ?>" /></p></div>
                        
                        <div class='_100'><p><label for="product_name">Amount Due Against this Invoice</label><input type="text" disabled="disabled" id="" name="" value="<?php echo $due_amount ; ?>" /></p></div>
                        
                        <div class='_100'><p><label for="product_price">Amount (&pound;)</label><input type="text" id="transaction_amount" name="transaction_amount" value="<?php echo set_value('transaction_amount', '0.00') ; ?>" /></p></div>
						
                        <div class='_50'>
							<p>
								<span class="transaction_type">Transaction type</span>
								<select id="transaction_type" name="transaction_type">
									<option value="">Select Transaction Type</option>
									<option value="Credit_Note" <?php set_select("transaction_type", "Credit_Note") ; ?>>Credit Note</option>
									<option value="Payment" <?php set_select("transaction_type", "Payment") ; ?>>Payment</option>
									<option value="Add_Back" <?php set_select("transaction_type", "Add_Back") ; ?>>Add Back</option>
								</select>
							</p>
						</div>
						
					</fieldset>
                 
                    <div class='block-actions'>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Proceed</a></li>
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
	$("#cancel_form").click(function(){ window.location.href = "<?php echo base_url("invoices/payments") ; ?>" ; }) ;
}) ;
</script>
