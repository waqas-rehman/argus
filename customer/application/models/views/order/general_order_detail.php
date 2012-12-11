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
					if($msg == 10) echo '<div class="message green"><span>Order Basic Details Updated Successfully</span></div>' ;
					if($msg == 11) echo '<div class="message green"><span>Product Details Updated Successfully</span></div>' ;
					if($msg == 12) echo '<div class="message green"><span>Order Description Updated Successfully</span></div>' ;
					if($msg == 13) echo '<div class="message green"><span>Order File Updated Successfully</span></div>' ;
				}
				?>
                <div class="row">
                	<h2>Order Status:</h2>
                    <h6><?php echo $order_rec->status ; ?></h6>
                </div>
                
                <div class="row">
                	<h2>Order Basic Details</h2>
                    <h6>Purchase Order Number:</h6>
					<p><?php echo $order_rec->purchase_order_number ; ?></p>
                    <h6>Delivery Address</h6>
                    <p><?php echo $customer_rec->company_name ; ?></p>
					<p><?php echo $customer_rec->address_line_1 ; ?></p>
					<p><?php echo $customer_rec->address_line_2 ; ?></p>
					<p><?php echo $customer_rec->city ; ?></p>
					<p><?php echo $customer_rec->county ; ?></p>
					<p><?php echo $customer_rec->post_code ; ?></p>
					<p><?php echo $customer_rec->country ; ?></p>
					
                    <h6>Invoice Address</h6>
                    <p><?php echo $order_rec->invoice_address ; ?></p>
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
							<td><?php echo $rec->product_code." - ".$rec->product_adl_code ; ?></td>
							<td><?php echo $rec->product_quantity ; ?></td>
                            <td><?php echo get_decimal_number_format($rec->product_price) ; ?></td>
                            <td>
							<?php
                            	echo get_decimal_number_format(($rec->product_price) * ($rec->product_quantity)) ;
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
										$transport_charges = $customer_rec->transport_charges ;
									echo get_decimal_number_format($transport_charges) ;
								?>
                            </td>
						</tr>
                        
                        <tr id="last2">
                        	<td colspan="4" style="text-align:right !important;">Sub Total Amount: </td>
                            <td id="sub_total"><?php echo get_decimal_number_format($temp_sub_total + $transport_charges) ; ?></td>
                      	</tr>
                        <!--
                        <tr id="last3">
                        	<td colspan="4" style="text-align:right !important;">VAT Code: </td>
                            <td id="vat-code"><?php // echo $vat_rec->vat_code ; ?></td>
                       	</tr>
                        -->
                        <?php
							$temp_vat_tax = $temp_vat_tax + ($transport_charges * (($rec->vat_rate)/100)) ;
						?>
                        <tr id="last4">
                        	<td colspan="4" style="text-align:right !important;">VAT (<?php echo $rec->vat_rate."%" ; ?>)</td>
                            <td id="sub_total_vat"><?php echo get_decimal_number_format($temp_vat_tax) ; ?></td>
                        </tr>
                        
                        <tr id="last6">
                        	<td colspan="4" style="text-align:right !important;">Total</td>
                            <td id="total_plus_vat"><?php echo get_decimal_number_format($temp_vat_tax  + $temp_sub_total + $transport_charges) ;  ?></td>
                        </tr>
                    </tbody>
				</table>
			<?php } else { ?>
            	<h6>No Product Added.</h6>
			<?php } ?>
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
                
            <div clear="clear"></div><br /><br />
            
            <div class="row">
            	<h2>Order File</h2>
                <?php if($order_rec->order_file != "") { ?>
                <label></label>
                <div class="right">
					<?php echo $order_rec->purchase_order_number.".".$file_ext ; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        	<a href="<?php echo base_url("orders/download_manual/".$order_rec->id) ; ?>"><img title="Download File" src="<?php echo base_url("gfx/icons/small/drive-download.png") ; ?>" /></a>
                </div>      
                
                <?php } else { ?>
                <h6>No Order File Uploaded.</h6>
				<?php } ?>
            </div>
                
            <div clear="clear"></div><br /><br />
            
            <div class="row">
                <center><button id="cancel_form" type="button"><span>&lt;&lt;&nbsp;Back</span></button></center>
            </div>
            <a name="Down"></a>
			</div>
		</div>
	</div>
</div>

<script type="application/javascript">
$(function(){
	$("#cancel_form").click(function(){ window.location.href = "<?php echo base_url("orders") ; ?>" ; }) ;

}) ;
</script>