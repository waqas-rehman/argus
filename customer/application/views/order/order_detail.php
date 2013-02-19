<style type="text/css">
.clear{ clear:both ; }
</style>
<a name="Top"></a>
<div id="right">
	<div class="section">
		<div class="box">
        	<div class="title">Order Details<span class="hide"></span></div>
			<div class="content">
            <?php
				if($msg){
					
					if($msg == 5) echo '<div class="message red"><span>You have not submitted Products yet.</span></div>' ;
					if($msg == 6) echo '<div class="message red"><span>You have not told any thing about the Order Description</span></div>' ;
					if($msg == 7) echo '<div class="message red"><span>You have not told any thing about the Order File yet.</span></div>' ;
					if($msg == 8) echo '<div class="message red"><span>Order File Updated Successfully</span></div>' ;
					
					if($msg == 10) echo '<div class="message green"><span>Order Basic Details Updated Successfully</span></div>' ;
					if($msg == 11) echo '<div class="message green"><span>Product Details Updated Successfully</span></div>' ;
				  if($msg == 12) echo '<div class="message green"><span>Order description information submitted/updated successfully</span></div>' ;
					if($msg == 13) echo '<div class="message green"><span>PO Document Submitted/Updated successfully</span></div>' ;
				}
			?>
                <div class="row">
                	<h2>Order Basic Details</h2>
                    <h6>Purchase Order Number:</h6>
					<p><?php echo $order_rec->purchase_order_number ; ?></p>
                    <h6>Delivery Address</h6>
                    <p><?php echo $order_rec->delivery_address ; ?></p>
                    <h6>Invoice Address</h6>
                    <p><?php echo $order_rec->invoice_address ; ?></p>
                </div>
                
                <div class="row">
					<label></label>
					<div class="right">
						<div style="float:right;">
                        	<a href="<?php echo base_url("orders/view_basic_details/".$order_rec->id) ; ?>">Edit Basic Details</a>&nbsp;
                            <a href="#Top">Top</a>&nbsp;<a href="#Down">Down</a>
                        </div>
						<div class="clear"></div>
					</div>
				</div>
                
                <div clear="clear"></div>
                <br /><br />
                <div class="row">
                	<h2>Products Details</h2>
					<?php if($products_rec) { ?>
                    <table cellspacing="0" cellpadding="0" border="0"> 
					<thead> 
						<tr>
							<th>Product Group</th>
							<th>Products</th>
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
						foreach($products_rec as $rec):
					?>
                        <tr>
							<td><?php echo $rec->product_group ; ?></td>
							<td><?php echo $rec->product_code." - ".$rec->product_adl_code ; //$rec->product_name." - ". ?></td>
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
						<?php endforeach ; ?>
                        
                        <tr id="last5">
                        	<td colspan="4" style="text-align:right !important;">Delivery Charges</td>
                            <td id="sub_total_transpotation_charges">
								<?php
									$transport_charges = floatval(0.00) ;
									if($temp_sub_total <= $customer_rec->maximum_limit)
										$transport_charges = $order_rec->transport_charges ;
									echo number_format(($transport_charges), 2 , ".", ",") ;
								?>
                            </td>
						</tr>
                        
                        <tr id="last2">
                        	<td colspan="4" style="text-align:right !important;">Sub Total Amount: </td>
                            <td id="sub_total"><?php echo number_format(($temp_sub_total + $transport_charges), 2 , ".", ",") ; ?></td>
                      	</tr>
                        <!--
                        <tr id="last3">
                        	<td colspan="4" style="text-align:right !important;">VAT Code: </td>
                            <td id="vat-code"><?php // echo $vat_rec->vat_code ; ?></td>
                       	</tr>-->
                        <?php
							$temp_vat_tax = $temp_vat_tax + ($transport_charges * (($rec->vat_rate)/100)) ;
						?>
                        <tr id="last4">
                        	<td colspan="4" style="text-align:right !important;">VAT (<?php echo $rec->vat_rate."%" ; ?>)</td>
                            <td id="sub_total_vat"><?php echo number_format(($temp_vat_tax), 2 , ".", ",") ; ?></td>
                        </tr>
                        
                        <tr id="last6">
                        	<td colspan="4" style="text-align:right !important;">Total</td>
                            <td id="total_plus_vat"><?php echo number_format(($temp_vat_tax  + $temp_sub_total + $transport_charges), 2, ".", ",") ;  ?></td>
                        </tr>
                    </tbody>
				</table>
			<?php } else { ?>
            	<h6>No Product Added.</h6>
			<?php } ?>
            	
            </div>
            
           	<div class="row">
				<label></label>
				<div class="right">
					<div style="float:right;">
                    	<a href="<?php echo base_url("orders/edit_products/".$order_rec->id) ; ?>">Add/Edit Product Details</a>&nbsp;
                            <a href="#Top">Top</a>&nbsp;<a href="#Down">Down</a>
                    </div>
					<div class="clear"></div>
				</div>
			</div>
                
            <div clear="clear"></div><br /><br />
            
            <div class="row">
            	<h2>Order Description</h2>
                <?php if($order_rec->order_description != "") { ?>
                <p><?php echo "<p>".$order_rec->order_description."</p>" ; ?></p>
                <?php } else { ?>
                <h6>No Order Description Added.</h6>
				<?php } ?>
            </div>
            
            <div class="row">
				<label></label>
				<div class="right">
					<div style="float:right;">
                    	<a href="<?php echo base_url("orders/order_description/".$order_rec->id) ; ?>">Add/Edit Order Description</a>&nbsp;
                        <a href="#Top">Top</a>&nbsp;<a href="#Down">Down</a>
                    </div>
					<div class="clear"></div>
				</div>
			</div>
                
            <div clear="clear"></div><br /><br />
            
            <div class="row">
            	<h2>Order File</h2>
                <?php if($order_rec->order_file != "") { ?>
                <label></label>
                <div class="right">
					<?php echo $order_rec->purchase_order_number.".".$file_ext ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        	<a href="<?php echo base_url("orders/download_manual/".$order_rec->id) ; ?>"><img title="Download File" src="<?php echo base_url("gfx/icons/small/drive-download.png") ; ?>" /></a>&nbsp;&nbsp;
                            <a href="<?php echo base_url("orders/remove_order_form/".$order_rec->id) ; ?>" onclick="return confirm('Are you sure to remove the file?');"><img title="Remove File" src="<?php echo base_url("gfx/icons/small/cross-script.png") ; ?>" /></a>
                </div>      
                
                <?php } else { ?>
                <h6>No Order File Uploaded.</h6>
				<?php } ?>
            </div>
            
            <div class="row">
				<label></label>
				<div class="right">
					<div style="float:right;">
                    	<a href="<?php echo base_url("orders/order_file/".$order_rec->id) ; ?>">Upload/Edit Order File</a>&nbsp;
                        <a href="#Top">Top</a>&nbsp;<a href="#Down">Down</a>
                    </div>
					<div class="clear"></div>
				</div>
			</div>
                
            <div clear="clear"></div><br /><br />
            
            <div class="row">
            	<form id="final_from" name="" action="<?php echo base_url("orders/submmit_order") ; ?>" method="post">
                <input type="hidden" id="order_id_final" name="order_id_final" value="<?php echo $order_rec->id ; ?>" />
				<?php if ($transport_charges) { ?><input type="hidden" id="transport_charges" name="transport_charges" value="<?php echo number_format(($transport_charges), 2 , ".", ",") ; ?>" /> <?php }?>
				
			<?php if ($temp_vat_tax) { ?>	<input type="hidden" id="total_cost" name="total_cost" value="<?php echo number_format(($temp_vat_tax  + $temp_sub_total + $transport_charges), 2, ".", ",") ; ?>" /> <?php }?>
				
				<?php if ($temp_vat_tax) { ?> <input type="hidden" id="vat_rat" name="vat_rat" value="<?php echo number_format(($temp_vat_tax), 2 , ".", ",") ; ?>" /> <?php }?>
				
				
                <center>
                	<button id="submit_order" type="button"><span>Submit Order</span></button>&nbsp;
                	<button id="cancel_form" type="button"><span>Cancel</span></button>
            	</center>
               	</form>
            </div>
            <a name="Down"></a>
			</div>
		</div>
	</div>
</div>

<script type="application/javascript">
$(function(){
	$("#submit_order").click(function(){
		$("#final_from").attr("action","<?php echo base_url("orders/submmit_order") ; ?>") ;
		$("#final_from").submit() ;
	}) ;
	
	$("#cancel_form").click(function(){ window.location.href = "<?php echo base_url("orders") ; ?>" ; }) ;

}) ;
</script>