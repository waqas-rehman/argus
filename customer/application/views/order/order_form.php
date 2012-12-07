

<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Online Purchase Order - Step 1<span class="hide"></span></div>
			<div class="content">
            	<?php if($msg ==  1) { ?> <div class="message red"><span><ul><?php echo validation_errors() ; ?></ul></span></div><?php } ?>
				<form  id="purchase_order_step_1" action="" method="post">
                	<input type="hidden" id="next_step" name="next_step" value="" />
					<div class="row">
						<label>Purchase order #</label>
						<div class="right"><input type="text" id="purchase_order_number" value="<?php echo set_value("purchase_order_number") ; ?>" name="purchase_order_number" /></div>
					</div>
					
                    <div class="row">
						<label for="">Invoice Address</label>
						<div class="right"><textarea id="invoice_address" name="invoice_address" rows="8" cols="" class="wysiwyg">
						<?php echo set_value("invoice_address", ($customer_rec->company_name."<br />".$customer_rec->address_line_1."<br />".$customer_rec->address_line_2."<br />".$customer_rec->city."<br />".$customer_rec->county."<br />".$customer_rec->post_code."<br />".$customer_rec->country)) ; ?></textarea></div>
					</div>
                    
                    <div class="row">
						<label>Delivery Address</label>
						<div class="right"><textarea id="delivery_address" name="delivery_address" rows="8" cols="" class="wysiwyg"><?php echo set_value("delivery_address", ($customer_rec->company_name."<br />".$customer_rec->address_line_1."<br />".$customer_rec->address_line_2."<br />".$customer_rec->city."<br />".$customer_rec->county."<br />".$customer_rec->post_code."<br />".$customer_rec->country)) ; ?></textarea></div>
					</div>
                    
					<div class="row">
						<label></label>
						<div class="right">
                        	<button id="add_products" type="button"><span>Next &gt;&gt;</span></button>&nbsp;
                            <button id="save_and_submit" type="button"><span>Save</span></button>&nbsp;
                            <button id="cancel_form" type="button"><span>Cancel</span></button>
                        </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="application/javascript">
$(function(){
	$("#add_products").click(function(){
		$("#purchase_order_step_1").attr("action","<?php echo base_url("orders/step2") ; ?>") ;
		$("#next_step").val("add_products") ;
		$("#purchase_order_step_1").submit() ;
	}) ;
	
	$("#save_and_submit").click(function(){
		$("#purchase_order_step_1").attr("action","<?php echo base_url("orders/step2") ; ?>") ;
		$("#next_step").val("save") ;
		$("#purchase_order_step_1").submit() ;
	}) ;
	
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("orders") ; ?>" ;
	}) ;
}) ;
</script>