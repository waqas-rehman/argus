<div id="main-content">
	<div class="container_12">
    	<div class="grid_12"><h1>Order Details</h1></div>
        <div class='grid_12'>
        	<div class='block-border'>
            	
				<div class='block-header'><h1>Order Details - Purchase Order Number <?php echo $order_rec->purchase_order_number ; ?></h1><span></span></div>
				<?php 
				if($msg)
				{
					if($msg == 5)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to upadte Order Basic information</li></ul></div>' ;
					}
					
					if($msg == 5)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to upadte Order Basic information</li></ul></div>' ;
					}
					
					if($msg == 6)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to upadte Order Basic information</li></ul></div>' ;
					}
					
					if($msg == 7)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to upadte Order Basic information</li></ul></div>' ;
					}
					
					
                	if($msg == 10)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order Basic Information updated successfully</li></ul></div>' ;
					}
					
					if($msg == 11)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order Products updated successfully</li></ul></div>' ;
					}
					
					if($msg == 12)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order Description updated successfully</li></ul></div>' ;
					}
					
					if($msg == 13)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order File updated successfully</li></ul></div>' ;
					}
					
					if($msg == 14)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Order Status update successfully</li></ul></div>' ;
					}
				}
                ?>
				<form id='form' class="block-content form" action="" method='post'>
				
                <fieldset>
					<legend>Order Basic Details</legend>
					<div class='_50'><p><b>Order Status: </b><?php echo $order_rec->status ; ?> (<a href="<?php echo base_url("orders/edit_status/".$order_rec->id) ; ?>">Change</a>)</p></div>
                    <div class='_50'><p><b>Purchase Order Number: </b><?php echo $order_rec->purchase_order_number ; ?></p></div>
					<div class='_50'><p><b>Print Order: </b><a href="<?php echo base_url("orders/create_pdf/".$order_rec->id) ; ?>" target="_blank">Click Here</a></p></div>
                    <div style=" clear:both ;"></div>
                    <div class='_50'><p><b>Invoice Address: </b><?php echo $order_rec->invoice_address ; ?></p></div>
					<div class='_50'><p><b>Delivery Address: </b><?php echo $order_rec->delivery_address ; ?></p></div>
				</fieldset>
				
                <div class="block-actions">
                    <ul class="actions-left">
                    	<li><a class="close-toolbox button red cancel_form" href="javascript:void(0);">&lt;&lt; Back</a></li>
                    </ul>
                    
                    <ul class="actions-right">
                    	<li><a id="edit_basic_order_detail" class="close-toolbox button" href="javascript:void(0);">Edit &gt;&gt;</a></li>
                    </ul>
                </div>
                <br />
                <script type="application/javascript">
                	$("#edit_basic_order_detail").click(function(){
						 window.location.href = "<?php echo base_url("orders/edit_basic_details/".$order_rec->id) ; ?>" ;
					}) ;
                </script>
                <fieldset>
					<legend>Products Details</legend><br />
                    <table class='table'>
						<thead> 
                        	<tr>
                            	<th>Product Group</th>
                            	<th>Products</th>
                                <th>ADL Code -  Product Code</th>
                            	<th>Quantity</th>
                            	<th>Unit Price (&pound;)</th>
                            	<th>Total Price (&pound;)</th>
                        	</tr>
                        </thead>
                        
                        <tbody>
                        <?php
                            $temp_sub_total = 0 ;
                            $temp_vat_tax = 0 ; 
                            $x = 1 ;
							if($products_rec) {
                            foreach($products_rec as $rec):
                        ?>
                            <tr>
                                <td><?php echo $rec->product_group ; ?></td>
                                <td><?php echo $rec->product_name ; ?></td>
                                <td><?php echo $rec->product_adl_code." ".$rec->product_code ; ?></td>
                                <td><?php echo $rec->product_quantity ; ?></td>
                                <td><?php echo number_format($rec->product_price, 2 , ".", ",") ; ?></td>
                                <td>
                                <?php
                                    echo number_format (($rec->product_price) * ($rec->product_quantity), 2 , ".", ",") ;
                                    $temp_sub_total = $temp_sub_total + floatval(($rec->product_price) * ($rec->product_quantity)) ;
                                    $temp_vat_tax = $temp_vat_tax + floatval((($rec->vat_rate)/100) * ($rec->product_price) * ($rec->product_quantity)) ;
                                ?>
                                </td>
                            </tr>
                            <?php endforeach ; } ?>
                            
                            <tr id="last5">
                                <td colspan="5" style="text-align:right !important;">Transpotation Charges</td>
                                <td id="total_plus_vat">
									<?php
										$transport_charges = 0 ;
										if($temp_sub_total <= $customer_rec->maximum_limit)
											$transport_charges = $order_rec->transport_charges ;
										echo number_format($transport_charges, 2, ".", ",") ;
									?>
                                </td>
                            </tr>
                            
                            <tr id="last2">
                                <td colspan="5" style="text-align:right !important;">Sub Total Amount: </td>
                                <td id="sub_total"><?php echo number_format(($temp_sub_total + $transport_charges), 2 , ".", ",") ; ?></td>
                            </tr>
                            
                            <tr id="last3">
                                <td colspan="5" style="text-align:right !important;">VAT Code: </td>
                                <td id="vat-code"><?php echo $vat_rec->vat_code ; ?></td>
                            </tr>
                            <?php $temp_vat_tax = $temp_vat_tax + ($transport_charges * (floatval($vat_rec->vat_rate)/100)) ; ?>
                            <tr id="last4">
                                <td colspan="5" style="text-align:right !important;">VAT</td>
                                <td id="sub_total_vat"><?php echo number_format(($temp_vat_tax), 2 , ".", ",") ; ?></td>
                            </tr>
                            
                            <tr id="last6">
                                <td colspan="5" style="text-align:right !important;">Total</td>
                                <td id="total_plus_vat"><?php echo number_format(($transport_charges + $temp_vat_tax  + $temp_sub_total), 2, ".", ",") ;  ?></td>
                            </tr>
                            
                        </tbody>
					</table>
                    <br />
				</fieldset>
				
                <div class="block-actions">
                    <ul class="actions-left"><li><a class="close-toolbox button red cancel_form" href="javascript:void(0);">&lt;&lt; Back</a></li></ul>
                    <ul class="actions-right"><li><a id="edit_products" class="close-toolbox button" href="javascript:void(0);">Edit &gt;&gt;</a></li></ul>
                </div>
                <br />
                <script type="application/javascript">
                	$("#edit_products").click(function(){
						 window.location.href = "<?php echo base_url("orders/edit_product_details/".$order_rec->id) ; ?>" ;
					}) ;
                </script>
                
                <fieldset>
                	<legend>Order Description</legend>
                    	<?php if($order_rec->order_description == "") { ?>
							<div class='_100'><p><b>Order Description:</b></p><p>No order added</p></div>
                        <?php } else { ?>
                        	<div class='_100'><p><b>Order Description:</b></p><p><?php echo $order_rec->order_description ; ?></p></div>
                        <?php } ?>
                        
                </fieldset>
                <div class="block-actions">
                    <ul class="actions-left"><li><a class="close-toolbox button red cancel_form" href="javascript:void(0);">&lt;&lt; Back</a></li></ul>
                    <ul class="actions-right"><li><a id="edit_order_description" class="close-toolbox button" href="javascript:void(0);">Edit &gt;&gt;</a></li></ul>
                </div>
                
                <script type="application/javascript">
                	$("#edit_order_description").click(function(){
						 window.location.href = "<?php echo base_url("orders/edit_order_description/".$order_rec->id) ; ?>" ;
					}) ;
                </script>
                <br />
                
                <fieldset>
                	<legend>Order File</legend>
                    	
                        <?php if($order_rec->order_file == "") { ?>
							<div class='_100'><p><b>Order File:</b></p><p>No order file attached</p></div>
                        <?php } else { ?>
                        	<div class='_100'>
                            	<p><b>Order File:</b></p>
                                <p>
                                	<?php echo $order_rec->purchase_order_number.".".$file_ext ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                	<a href="<?php echo base_url("orders/download_manual/".$order_rec->id) ; ?>">
                                    	<img title="Download Attachment" src="<?php echo base_url("img/icons/packs/fugue/16x16/drive-download.png") ; ?>" />
                                        </a>
                                </p>
                            </div>
                        <?php } ?>
                </fieldset>
                <div class="block-actions">
                    <ul class="actions-left"><li><a id="back" class="close-toolbox button red cancel_form" href="javascript:void(0);">&lt;&lt; Back</a></li></ul>
                    <ul class="actions-right"><li><a id="edit_order_file" class="close-toolbox button" href="javascript:void(0);">Edit &gt;&gt;</a></li></ul>
                </div>
                
                <script type="application/javascript">
                	$("#edit_order_file").click(function(){
						 window.location.href = "<?php echo base_url("orders/edit_order_file/".$order_rec->id) ; ?>" ;
					}) ;
                </script>
                
            </form> 
                
			</div>
	</div>
   	</div>
    <div class="clear height-fix"></div>
</div> <!-- end of #main-content -->
<script type="application/javascript">
$(function(){
	$("#cancel_form").click(function(){ window.location.href = "<?php echo base_url("orders") ; ?>" ; }) ;
}) ;
</script>