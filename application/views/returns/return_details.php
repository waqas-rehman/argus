

<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Online Returns<span class="hide"></span></div>
			<div class="content">
				
				<?php if($msg ==  1) { ?>
                	<div class="message red"><span><ul><?php echo validation_errors() ; ?></ul></span></div>
				<?php } elseif($msg ==  3) { ?>
					<div class="message green"><span><ul><li>Record Updated successfully</li></ul></span></div>
				<?php } elseif($msg ==  4) { ?>
					<div class="message red"><span><ul><li>Failed to update record</li></ul></span></div>
				<?php } ?>
                <form  id="return_form_1" action="<?php echo base_url("returns/update_return") ; ?>" method="post">
               	
				<input type="hidden" id="return_id" name="return_id" value="<?php echo $return_rec->id ; ?>" />
				
				<div class="row">
					<?php
						$open = FALSE ; $submit = FALSE ; $close = FALSE ;
						if($return_rec->status == "Open") $open = TRUE ;
						if($return_rec->status == "Submit") $submit = TRUE ;
						// if($return_rec->status == "Close") $close = TRUE ;
					?>
					<label for="">Status</label>
					<div class="right">
						<select id="status" name="status">
							<option value="Open" <?php echo set_select('status', 'Open', $open); ?>>Open</option>
							<option value="Submit" <?php echo set_select('status', 'Submit', $submit); ?>>Submit</option>
							<!-- <option value="Close" <?php /* echo set_select('status', 'Close', $close); /**/ ?>>Close</option> -->
						</select>
					</div>
				</div>
				
				<div class="row">
					<label for="rma_number">RMA Number</label>
					<div class="right"><input type="text" id="rma_number" value="<?php echo set_value("rma_number", $return_rec->rma_number) ; ?>" name="rma_number" /></div>
				</div>
                    
                <div class="row">
					<label for="customer_representative">Customer's Representative</label>
					<div class="right"><input type="text" id="customer_representative" value="<?php echo set_value("customer_representative",  $return_rec->customer_representative) ; ?>" name="customer_representative" /></div>
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
						<input type="radio" name="credit_required" id="radio-1" value="Yes" <?php echo set_radio("credit_required", "Yes", $yes) ; ?> />
						<label for="radio-1">Yes</label>
                        <input type="radio" name="credit_required" id="radio-2" value="No" <?php echo set_radio("credit_required", "No", $no) ; ?> /> 
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
                        <input type="radio" name="repair_required" id="radio-3" value="Yes" <?php echo set_radio("repair_required", "Yes", $yes) ; ?> /> 
						<label for="radio-3">Yes</label>
                        <input type="radio" name="repair_required" id="radio-4" value="No" <?php echo set_radio("repair_required", "No", $no) ; ?> /> 
						<label for="radio-4">No</label>
					</div>
				</div>
                
                <div class="row">
					<label for="invoice_number">Invoice Number to Credit Against</label>
					<div class="right">
                    	<input type="text" id="invoice_number" value="<?php echo set_value("invoice_number", $return_rec->invoice_number) ; ?>" name="invoice_number" />
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
						<input type="radio" name="report_required" id="radio-5" value="Yes" <?php echo set_radio("report_required", "Yes", $yes) ; ?> /> 
						<label for="radio-5">Yes</label>
                        <input type="radio" name="report_required" id="radio-6" value="No" <?php echo set_radio("report_required", "No", $no) ; ?> /> 
						<label for="radio-6">No</label>
					</div>
				</div>
                
                <div class="row">
					<label for="site_address">Site Address</label>
					<div class="right"><input type="text" id="site_address" value="<?php echo set_value("site_address", $return_rec->site_address) ; ?>" name="site_address" /></div>
                </div>
                
                <div class="row">
					<label for="installation_details">Installation Details</label>
					<div class="right"><textarea id="installation_details" name="installation_details" rows="8" cols="" class="wysiwyg"><?php echo set_value("installation_details", $return_rec->installation_details) ; ?></textarea></div>
				</div>
                <!--
                <div class="row">
					<label for="product_details">List of products being returned and their individual date codes</label>
					<div class="right"><textarea id="product_details" name="product_details" rows="8" cols="" class="wysiwyg"><?php /* echo set_value("product_details", $return_rec->product_details) ; /**/ ?></textarea></div>
				</div>
                -->
				
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
									<th>Action</th>
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
									<td id="action_<?php echo $i ; ?>"><a id="<?php echo $i ; ?>" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="<?php echo base_url("gfx/icons/small/cancel.png") ; ?>" /></a></td>
								</tr>
								<?php $i = $i + 1 ; endforeach ; } ?>
								
								<!--
								<tr id="tr_<?php // echo $i + 1 ; ?>">
									<td id="group_<?php // echo $i + 1 ; ?>">
										<select id="product_group<?php // echo $i + 1 ; ?>" class="product_group" name="product_group[]" number="<?php // echo $i + 1 ; ?>">
											<option value="">Select Group</option>
											<?php // if($product_groups) { foreach($product_groups as $rec): ?>
												<option value="<?php // echo $rec->id ; ?>"><?php // echo $rec->group_name ; ?></option>
											<?php // endforeach ; } ?>
										</select>
									</td>
									<td id="product_<?php // echo $i + 1 ; ?>">
										<select id="products<?php // echo $i + 1 ; ?>" class="products_dropdown" name="products[]" number="<?php // echo $i + 1 ; ?>">
											<option value="">Select Products</option>
										</select>
									</td>
									<td id="quantity_<?php // echo $i + 1 ; ?>"><input type="text" id="product_quantity<?php // echo $i + 1 ; ?>"  class="product_quantity" name="product_quantity[]" value="" number="<?php // echo $i + 1 ; ?>" /></td>
									<td id="datecode_<?php // echo $i + 1 ; ?>"><input type="text" id="date_code<?php // echo $i + 1 ; ?>"  name="date_code[]" value="" number="<?php // echo $i + 1 ; ?>" /></td>
									<td id="action_<?php // echo $i + 1 ; ?>"><a id="<?php // echo $i + 1 ; ?>" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="<?php // echo base_url("gfx/icons/small/cancel.png") ; ?>" /></a></td>
								</tr> -->
								
								<tr id="last1"><td colspan="4"><a id="add_column" href="javascript:void(0);">Add another product</a></td><td></td></tr>
							</tbody>
						</table>
</div>
				
				
                <div class="row">
					<label for="environmental_conditions">Description of Faults and Environmental Conditions</label>
					<div class="right"><textarea id="environmental_conditions" name="environmental_conditions" rows="8" cols="" class="wysiwyg"><?php echo set_value("environmental_conditions", $return_rec->environmental_conditions) ; ?></textarea></div>
                </div>
                
                <div class="row">
					<label for="installation_date">Date of Installation</label>
					<div class="right"><input type="text" id="installation_date" name="installation_date" class="datepicker" placeholder="mm/dd/yyyy" value="<?php echo set_value("installation_date", date("d/m/Y", strtotime($return_rec->installation_date))) ; ?>" /></div>
                </div>
                <div class="row">
					<label for="last_maintaince_date">Date of Last Maintaince</label>
					<div class="right"><input type="text" id="last_maintaince_date" name="last_maintaince_date" class="datepicker" placeholder="mm/dd/yyyy" value="<?php echo set_value("last_maintaince_date",  date("d/m/Y", strtotime($return_rec->last_maintaince_date))) ; ?>" /></div>
					<br />
                </div>
                
                <div class="row">
					<label for="">Additional Information</label>
					<div class="right"><textarea id="additional_description" name="additional_description" rows="8" cols="" class="wysiwyg"><?php echo set_value("additional_description", $return_rec->additional_description) ; ?></textarea></div>
				</div>
				
				<div class="row">
					<label></label>
					<div class="right">
                    	<button id="insert_return" type="button"><span>Update</span></button>&nbsp;
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
	$("#insert_return").click(function(){
		$("#return_form_1").submit() ;
	}) ;
	
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("returns") ; ?>" ;
	}) ;
}) ;
</script>

<script type="application/javascript">
$(function(){
	$("#add_column").click(function(){
		
		var current_tr = $("#current_tr").val() ;
        var current_num = parseInt($("#current_num").val()) ;
        var data1 = "tr_number="+(parseInt(current_tr) + 1) ;
        var html_data = "" ;
		
        $.ajax
        ({
			type:"POST",
	       async:false,
			url:"<?php echo base_url() ; ?>returns/get_td_ajax",
		   data:data1,
        success:function(msg) { html_data = msg ; }
        });
			
        $("#last1").before(html_data) ;
		$("#current_tr").val(parseInt(current_tr) + 1) ;
        $("#current_num").val(parseInt(current_num) + 1) ;
		
		$("select#product_group"+(parseInt(current_tr) + 1)).selectmenu({style: 'dropdown', transferClasses: true, width: null}) ;
        $("select#products"+(parseInt(current_tr) + 1)).selectmenu({style: 'dropdown', transferClasses: true, width: null}) ;
	}) ;
});

$(function(){
	$(".product_group").live('change', function(){
		var num = $(this).attr("number") ;
		$("#group_"+num).css("background-color", '#FFFFFF') ;
		
		var group = "#product_group"+num+" option:selected" ;
		var group_id = $(group).val() ;
		var data1 = "group_id="+group_id+"&number="+num ;
		var html_data = "" ;
		
		$.ajax
		({
			type:"POST",
		   async:false,
			 url:"<?php echo base_url() ; ?>orders/get_products_ajax",
			data:data1,
		 success:function(msg) { html_data = msg ; }
		});
		
		$("#product_"+num).html("") ;
		$("#product_"+num).html(html_data) ;
		$("select#products"+num).selectmenu({style: 'dropdown', transferClasses: true, width: null}) ;
		
		if(group_id == "") 
		{
			var str1 = "#product_quantity"+num ;
			$(str1).val("") ;
			$("#unit_price_"+num).html("0.00") ;
			$("#total_price_"+num).html("0.00") ;
		}
	}) ;
}) ;

$(function(){
	$(".product_quantity").live('keyup', function(){
		var num = $(this).attr("number") ;
        var str1 = "#product_quantity"+num ;
        var curr_quantity = parseInt($(str1).val()) ;
        
		if( !(isNaN(curr_quantity)) ) return true ;
        else $(str1).val("") ;
    }) ;
}) ;

$(function(){
	$(".remove_record").live("click", function(){
		if(confirm('Are you sure want to remove this record'))
		{
			var id = $(this).attr("id") ;
            $("#tr_"+id).remove() ;
            
			var current_num = parseInt($("#current_num").val()) - 1 ;
            $("#current_num").val(current_num) ;
		}
    });
}) ;
</script>