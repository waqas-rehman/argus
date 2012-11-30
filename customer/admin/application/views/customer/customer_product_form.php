 <div id="main-content">
	<div class="container_12">
	    <div class='grid_12'><h1>Modified Product Prices</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Product Prices for <?php echo $customer_rec->company_name ; ?></h1><span></span></div>
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
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Customer Added Successfully.</li></ul></div>' ;
						}
					}
				?>
                <form id="customer_products_from" class="block-content form" action="<?php echo base_url("customer/add_update_customer_products") ; ?>" method="post">
                    <fieldset>
                    	<legend>Modified Product Prices for <?php echo $customer_rec->company_name ; ?></legend>
                        	<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_rec->id ; ?>" /> 
                            <br /><br />
                            <table class="table">
                            	<thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Group Name</th>
                                        <th>Product Code</th>
                                        <th>ADL Code</th>
                                        <th>Normal Price (&pound;)</th>
                                        <th>Special Price (&pound;)</th>
                                    </tr>
  								</thead>
                                <tbody>
								<?php if($current_products) {  foreach($current_products as $rec): ?>
                                    <tr class='gradeX'>
                                        <td><?php echo $rec->product_name ; ?></td>
                                        <td><?php echo $rec->group_name ; ?></td>
                                        <td><?php echo $rec->product_code ; ?></td>
                                        <td><?php echo $rec->adl_code ; ?></td>
                                        <td><?php echo $rec->product_price ; ?></td>
                                        <td class='center'>
                                        	<input type="hidden" id="product_id_<?php echo $rec->product_id ; ?>" name="product_ids[]" value="<?php echo $rec->product_id ; ?>" />
                                            <input type="text" id="product_price_<?php echo $rec->product_id ; ?>" name="product_price_<?php echo $rec->product_id ; ?>" value="<?php echo $rec->new_product_price ; ?>" />
                                        </td>
                                    </tr>
                                <?php endforeach ; } ?>
                                
                                <?php if($other_products) {  foreach($other_products as $rec): ?>
                                    <tr class='gradeX'>
                                        <td><?php echo $rec->product_name ; ?></td>
                                        <td><?php echo $rec->group_name ; ?></td>
                                        <td><?php echo $rec->product_code ; ?></td>
                                        <td><?php echo $rec->adl_code ; ?></td>
                                        <td><?php echo $rec->product_price ; ?></td>
                                        <td class='center'>
                                        	<input type="hidden" id="product_id_<?php echo $rec->product_id ; ?>" name="product_ids[]" value="<?php echo $rec->product_id ; ?>" />
                                            <input type="text" id="product_price_<?php echo $rec->product_id ; ?>" name="product_price_<?php echo $rec->product_id ; ?>" value="<?php echo $rec->product_price ; ?>" />
                                        </td>
                                    </tr>
                                <?php endforeach ; } ?>
                                
								</tbody>
  							</table>
                            <br /><br />
					</fieldset>
					
                    <div class='block-actions'>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Add/Update Product Prices</a></li>
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
		$("#customer_products_from").submit() ;
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