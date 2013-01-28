<div id="main-content">
	<div class="container_12">
    	<div class="grid_12"><h1>Quotation Details</h1></div>
        <div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Quotation Details - Quotation Number <?php echo $order_rec->purchase_order_number ; ?></h1><span></span></div>
				<form id='form' class="block-content form" action="" method='post'>
				<fieldset>
					<legend>Order Basic Details</legend>
					<div class='_50'><p><b>Quotation Number: </b><?php echo $order_rec->purchase_order_number ; ?></p></div>
				</fieldset>
				
                <div class="block-actions">
                    <ul class="actions-left"><li><a class="close-toolbox button red cancel_form" href="javascript:void(0);">&lt;&lt; Back</a></li></ul>
                </div>
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
											$transport_charges = $customer_rec->transport_charges ;
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
                </div>
                
                <fieldset>
                	<legend>Other Notes</legend>
                    	<?php if($order_rec->order_description == "") { ?>
							<div class='_100'><p><b>Other Notes:</b></p><p>No notes added</p></div>
                        <?php } else { ?>
                        	<div class='_100'><p><b>Other Notes:</b></p><p><?php echo $order_rec->order_description ; ?></p></div>
                        <?php } ?>
                        
                </fieldset>
                <div class="block-actions">
                    <ul class="actions-left"><li><a class="close-toolbox button red cancel_form" href="javascript:void(0);">&lt;&lt; Back</a></li></ul>
                </div>
                
            </form> 
                
			</div>
	</div>
   	</div>
    <div class="clear height-fix"></div>
</div> <!-- end of #main-content -->
<script type="application/javascript">
$(function(){
	$(".cancel_form").click(function(){ window.location.href = "<?php echo base_url("quotations") ; ?>" ; }) ;
}) ;
</script>