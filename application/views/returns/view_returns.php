

<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Online Returns<span class="hide"></span></div>
			<div class="content">
		        <form  id="return_form_1">
               	
				<div class="row">
					<label for="rma_number">Status</label>
					<div class="right"><input type="text" id="status" value="<?php echo set_value("status", $return_rec->status) ; ?>" name="status" disabled="disabled" /></div>
				</div>
				
				<div class="row">
					<label for="rma_number">RMA Number</label>
					<div class="right"><input type="text" id="rma_number" value="<?php echo set_value("rma_number", $return_rec->rma_number) ; ?>" name="rma_number" disabled="disabled" /></div>
				</div>
                    
                <div class="row">
					<label for="customer_representative">Customer's Representative</label>
					<div class="right"><input type="text" id="customer_representative" value="<?php echo set_value("customer_representative",  $return_rec->customer_representative) ; ?>" name="customer_representative" disabled="disabled" /></div>
                    <br />
				</div>
                    
                <div class="row">
                	<label for="credit_required">Credit Required</label>
					<div  class="right">
                    	<?php
							$yes = FALSE ; $no = FALSE ; 
							if($return_rec->credit_required == "Yes") $yes = TRUE ;
							else $no = TRUE ;
						?>
						<input type="radio" name="credit_required" id="radio-1" value="Yes" <?php echo set_radio("credit_required", "Yes", $yes) ; ?> disabled="disabled" />
						<label for="radio-1">Yes</label>
                        <input type="radio" name="credit_required" id="radio-2" value="No" <?php echo set_radio("credit_required", "No", $no) ; ?>  disabled="disabled" /> 
						<label for="radio-2">No</label>
					</div>
				</div>
                
                <div class="row">
                	<label for="repair_required">Repair Required</label>
					<div class="right">
						<?php
							$yes = FALSE ; $no = FALSE ; 
							if($return_rec->repair_required == "Yes") $yes = TRUE ;
							else $no = TRUE ;
						?>
                        <input type="radio" name="repair_required" id="radio-3" value="Yes" <?php echo set_radio("repair_required", "Yes", $yes) ; ?> disabled="disabled" /> 
						<label for="radio-3">Yes</label>
                        <input type="radio" name="repair_required" id="radio-4" value="No" <?php echo set_radio("repair_required", "No", $no) ; ?>  disabled="disabled" /> 
						<label for="radio-4">No</label>
					</div>
				</div>
                
                <div class="row">
					<label for="invoice_number">Invoice Number to Credit Against</label>
					<div class="right">
                    	<input type="text" id="invoice_number" value="<?php echo set_value("invoice_number", $return_rec->invoice_number) ; ?>" name="invoice_number" disabled="disabled" />
                    </div>
					<br />
                </div>
                
                <div class="row">
                	<label for="report_required">Report Required</label>
					<div class="right">
                    	<?php
							$yes = FALSE ; $no = FALSE ; 
							if($return_rec->report_required == "Yes") $yes = TRUE ;
							else $no = TRUE ;
						?>
						<input type="radio" name="report_required" id="radio-5" value="Yes" <?php echo set_radio("report_required", "Yes", $yes) ; ?> disabled="disabled" /> 
						<label for="radio-5">Yes</label>
                        <input type="radio" name="report_required" id="radio-6" value="No" <?php echo set_radio("report_required", "No", $no) ; ?>  disabled="disabled" /> 
						<label for="radio-6">No</label>
					</div>
				</div>
                
                <div class="row">
					<label for="site_address">Site Address</label>
					<div class="right"><input type="text" id="site_address" value="<?php echo set_value("site_address", $return_rec->site_address) ; ?>" name="site_address" disabled="disabled" /></div>
                </div>
                
                <div class="row">
					<label for="installation_details">Installation Details</label>
					<div class="right"><textarea id="installation_details" name="installation_details" rows="8" cols="" class="wysiwyg" disabled="disabled" ><?php echo set_value("installation_details", $return_rec->installation_details) ; ?></textarea></div>
				</div>
                
                <!--<div class="row">
					<label for="product_details">List of products being returned and their individual date codes</label>
					<div class="right"><textarea id="product_details" name="product_details" rows="8" cols="" class="wysiwyg" disabled="disabled" ><?php // echo set_value("product_details", $return_rec->product_details) ; ?></textarea></div>
				</div>-->
				
								
				<input type="hidden" id="current_tr" name="current_tr" value="<?php echo $total_products + 1; ?>" />
				<input type="hidden" id="current_num" name="current_num" value="<?php echo $total_products + 1 ; ?>" />
				<div class="row">
					List of products being returned and their individual date codes
					<br /><br />
						<table cellspacing="0" cellpadding="0" border="0">
							<thead>
								<tr>
									<th>Product Group</th>
									<th>Products</th>
									<th>Quantity</th>
									<th>Date-Code</th>
								</tr>
							</thead>
							<tbody>
								<?php if($returns_products) { $i = 1 ; foreach($returns_products as $rec): ?>
								<tr id="tr_1">
									<td id="group_<?php echo $i ; ?>">
										<?php echo $rec->group_name ; ?>
										<input type="hidden" name="product_group[]" id="product_group<?php echo $i ; ?>" value="<?php echo $rec->group_id ; ?>" number="<?php echo $i ; ?>" />
									</td>
									<td id="product_<?php echo $i ; ?>">
										<?php echo $rec->product_name ; ?>
										<input type="hidden" name="products[]" id="products<?php echo $i ; ?>" value="<?php echo $rec->product_id ; ?>" number="<?php echo $i ; ?>" />
									</td>
									<td id="quantity_<?php echo $i ; ?>">
										<?php echo $rec->product_quantity ; ?>
										<input type="hidden" name="product_quantity[]" id="product_quantity<?php echo $i ; ?>" value="<?php echo $rec->product_quantity ; ?>" number="<?php echo $i ; ?>" />
									</td>
									<td id="datecode_<?php echo $i ; ?>">
										<?php echo $rec->date_code ; ?>
										<input type="hidden" name="date_code[]" id="date_code<?php echo $i ; ?>" value="<?php echo $rec->date_code ; ?>" number="<?php echo $i ; ?>" /></td>
								</tr>
								<?php $i = $i + 1 ; endforeach ; } ?>
							</tbody>
						</table>
				</div>
				
				<div class="row">
					<label for="environmental_conditions">Description of Faults and Environmental Conditions</label>
					<div class="right"><textarea id="environmental_conditions" name="environmental_conditions" rows="8" cols="" class="wysiwyg" disabled="disabled"><?php echo set_value("environmental_conditions", $return_rec->environmental_conditions) ; ?></textarea></div>
                </div>
                
                <div class="row">
					<label for="installation_date">Date of Installation</label>
					<div class="right"><input type="text" id="installation_date" name="installation_date" class="datepicker" placeholder="dd/mm/yyyy" disabled="disabled" value="<?php echo date("d/m/Y", strtotime($return_rec->installation_date)) ; ?>" /></div>
                </div>
                <div class="row">
					<label for="last_maintaince_date">Date of Last Maintaince</label>
					<div class="right"><input type="text" id="last_maintaince_date" name="last_maintaince_date" class="datepicker" placeholder="dd/mm/yyyy" disabled="disabled" value="<?php echo date("d/m/Y", strtotime($return_rec->last_maintaince_date)) ; ?>" /></div>
					<br />
                </div>
                
                <div class="row">
					<label for="">Additional Information</label>
					<div class="right"><textarea id="additional_description" name="additional_description" rows="8" cols="" class="wysiwyg" disabled="disabled" ><?php echo set_value("additional_description", $return_rec->additional_description) ; ?></textarea></div>
				</div>

                <div class="row">
					<label></label><div class="right"><button id="cancel_form" type="button"><span>&lt;&lt; Back</span></button></div>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

<script type="application/javascript">
$(function(){
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("returns") ; ?>" ;
	}) ;
}) ;
</script>