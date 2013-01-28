<?php $this->load->view("orders/tiny_mice") ; ?>
<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Order Details</h1></div>
		
        <div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Basic Information</h1><span></span></div>
                
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
							echo '<div class="error_msg"><ul><li>Failed to Send Email</li></ul></div>' ;
						}
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Email Sent Successfully</li></ul></div>' ;
						}
						
					}
				?>
                
                <form id="order_form" class="block-content form" action="<?php echo base_url("orders/insert_complete_order") ; ?>" method="post" enctype="multipart/form-data">
                	<input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_rec->id ?>" /> 
                    
                    <fieldset>
                    	<legend>Order Basic Information</legend>
                        
                        <div class='_50'><p><label for="purchase_order_number">Purchase Order Number</label><input type="text" id="purchase_order_number" name="purchase_order_number" value="<?php echo set_value("purchase_order_number") ; ?>" /></p></div>
                        
                        <div class='_100'><p><label for="invoice_address">Invoice Address</label><textarea id="invoice_address" name="invoice_address" rows="5" cols="40"><?php echo set_value("purchase_order_number", ($customer_rec->company_name."<br />".$customer_rec->address_line_1."<br />".$customer_rec->address_line_2."<br />".$customer_rec->city."<br />".$customer_rec->county."<br />".$customer_rec->post_code."<br />".$customer_rec->country)) ; ?></textarea></p></div>
                        
                        <div class='_100'><p><label for="delivery_address">Delivery Address</label><textarea id="delivery_address" name="delivery_address" rows="5" cols="40"><?php echo set_value("purchase_order_number", ($customer_rec->company_name."<br />".$customer_rec->address_line_1."<br />".$customer_rec->address_line_2."<br />".$customer_rec->city."<br />".$customer_rec->county."<br />".$customer_rec->post_code."<br />".$customer_rec->country)) ; ?></textarea></p></div>
                    </fieldset>
                    
					<?php $this->load->view("orders/jquery1") ; ?>
                    
                    <fieldset>
                    	<legend>Order Product Information</legend>
                                            
                    	<input type="hidden" id="vat_rate" name="vat_rate" value="<?php echo $vat_rec->vat_rate ; ?>" />
                    	<input type="hidden" id="maximum_limit" name="maximum_limit" value="<?php echo $customer_rec->maximum_limit ; ?>" />
   		            	<input type="hidden" id="transport_charges" name="transport_charges" value="<?php echo $customer_rec->transport_charges ; ?>" />
                    	
                        <input type="hidden" id="current_tr" name="current_tr" value="1" />
                		<input type="hidden" id="current_num" name="current_num" value="1" />
                        <table class='table'>
                        	<thead>
                                <tr>
                                    <th>Product Group</th>
                                    <th>Products</th>
                                    <th>Quantity</th>
                                    <th>Unit Price (&pound;)</th>
                                    <th>Total Price (&pound;)</th>
                                    <th>Action</th>
                                </tr>
							</thead>
						 	<tbody>
                        		<?php $temp_sub_total = 0 ; $temp_vat_tax = 0 ; ?>
                            	<tr id="tr_1">
                                	<td id="group_1">
                                    	<select id="product_group1" class="product_group" name="product_group[]" number="1">
                                        	<option value="">Select Group</option>
                                        		<?php if($product_groups) { foreach($product_groups as $rec): ?>
                                            		<option value="<?php echo $rec->id ; ?>"><?php echo $rec->group_name ; ?></option>
                                        		<?php endforeach ; } ?>
                                    	</select>
                                	</td>
                                	
                                    <td id="product_1">
                                    	<select id="products1" class="products_dropdown" name="products[]" number="1">
                                        	<option value="">Select Products</option>
                                    	</select>
                                	</td>
                                	
                                    <td id="quantity_1">
                                    	<input type="text" id="product_quantity1"  name="product_quantity[]" value="" class="product_quantity" number="1" />
                                	</td>
                                	
                                    <td id="unit_price_1">0.00</td>
                                	<td id="total_price_1">0.00</td>
                                	<td id="action_1">
                                    	<a id="1" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
                                	</td>
                            	</tr>
                           		
                                <tr id="last1"><td colspan="5"><a id="add_column" href="javascript:void(0);">Add another product</a></td><td></td></tr>
                           		
                                <tr id="last5">
                        			<td colspan="4" style="text-align:right !important;">Delivery Charges</td>
                           			<td id="sub_total_transpotation_charges"><?php echo number_format(( $customer_rec->transport_charges ), 2, ".", ",") ;  ?></td>
                            		<td></td>
                                </tr>
                           		
                                <tr id="last3">
                                	<td colspan="4" style="text-align:right !important;">Sub Total Amount: </td>
                                    <td id="sub_total">0.00</td>
                                    <td></td>
                                </tr>
                           		
                           		<tr id="last4">
                                	<td colspan="4" style="text-align:right !important;">VAT <?php echo "(".$vat_rec->vat_rate." %)" ;?></td>
                                    <td id="sub_total_vat"><?php echo number_format(($temp_vat_tax), 2 , ".", ",") ; ?></td>
                                    <td></td>
                                </tr>
                            	
                                <tr id="last6">
                                	<td colspan="4" style="text-align:right !important;">Total</td>
                                    <td id="total_plus_vat">0.00</td>
                                    <td></td>
                                </tr>
                        	</tbody>
                    	</table><br /><br />
                           <input type="hidden" id="sub_total_hidden" name="sub_total_hidden" value="" />
                           <input type="hidden" id="vat_total_hidden" name="vat_total_hidden" value="" />
                           <input type="hidden" id="freight_charges" name="freight_charges" value="0.00" />

                    </fieldset>

                    <fieldset>
                    	<legend>Order Basic Information</legend>
                    	<div class="_100"><p class="no-top-margin"><label for="message">Order Description</label><textarea id="order_description" name="order_description" rows="5" cols="40"><?php echo set_value("order_description") ; ?></textarea></p></div>
                    </fieldset>


                    <fieldset>
                    	<legend>Order File</legend>
                        
                        <div class='_50'>
                        	<p>
                            <label for="username">Upload Order File?</label>
                        	<input type="radio" id="upload_order_file_1" name="upload_order_file" value="Yes" <?php echo set_radio('upload_order_file', 'Yes'); ?> /> Yes
                         <input type="radio" id="upload_order_file_2" name="upload_order_file" value="No" <?php echo set_radio('upload_order_file', 'No', TRUE); ?> /> No
                            </p>
                        </div>
                        
                        
                        <div class='_50'>
                        	<p> <label for="order_file">Add/Update Order File</label> <input type="file" id="order_file" name="order_file" /> </p>
                        </div>
                        
                        
                        <div class='_50'>
                        	<p>
                            	<label for="username">Upload Invoice File?</label>
                      <input type="radio" id="upload_invoice_file_1" name="upload_invoice_file" value="Yes" <?php echo set_radio('upload_invoice_file', 'Yes'); ?> /> Yes
                   <input type="radio" id="upload_invoice_file_2" name="upload_invoice_file" value="No" <?php echo set_radio('upload_invoice_file', 'No', TRUE); ?> /> No
                            </p>
                        </div>
                        
                        <div class='_50'>
                        	<p><label for="order_file">Add/Update Invoice File</label><input type="file" id="invoice_file" name="invoice_file" /></p>
                        </div>
					
                    </fieldset>
                    
                    <fieldset>
                    	<legend>Order Status</legend>
                        <input type="hidden" id="temp_order_status" name="temp_order_status" value=""  />
                        <div class='_50'>
                        	<p>
                            	<span class="status">Status</span>
                                <select id="order_status" name="order_status">
                                	<option value="">Select Status</option>
                                    <option value="Pending" <?php echo set_select('status', 'Pending'); ?>>Pending</option>
                                    <option value="Ordered" <?php echo set_select('status', 'Ordered'); ?>>Ordered</option>
                                    <option value="Accepted" <?php echo set_select('status', 'Accepted'); ?>>Accepted</option>
                                    <option value="Shiped" <?php echo set_select('status', 'Shiped'); ?>>Shiped</option>
                                    <option value="Invoiced" <?php echo set_select('status', 'Invoiced'); ?>>Invoiced</option>
                                    <option value="Outstanding" <?php echo set_select('status', 'Outstanding'); ?>>Outstanding</option>
                                    <option value="Completed" <?php echo set_select('status', 'Completed'); ?>>Completed</option>
                                </select>
                            </p>
                        </div>
                        
                        <div id="order_status_dates">
                            <div id="dates_message" class="date-div">
                            	<div class='_100'><p style="font-size:12px; color:#F00 !important;"><h3>All Date Fields are required</h3></p></div>
                            </div>
                            
                            <div id="creation_date_div" class="date-div">
                            	<div class='_100'><p><label for="creation_date">Creation Date</label><input type="text" id="creation_date" name="creation_date" class="datepicker" value="<?php echo set_value("creation_date") ; ?>" /></p></div>
                            </div>
                            
                            <div id="order_date_div" class="date-div">
                            	<div class='_100'><p><label for="order_date">Order Date</label><input type="text" id="order_date" name="order_date" value="<?php echo set_value("order_date") ; ?>" class="datepicker" /></p></div>
                            </div>
                            
                            <div id="acceptance_date_div" class="date-div">
                            	<div class='_100'><p><label for="acceptance_date">Acceptance Date</label><input type="text" id="acceptance_date" name="acceptance_date" value="<?php echo set_value("acceptance_date") ; ?>" class="datepicker" /></p></div>
                            </div>
                            
                            <div id="shipment_date_div" class="date-div">
                            	<div class='_100'><p><label for="shipment_date">Shipment Date</label><input type="text" id="shipment_date" name="shipment_date" value="<?php echo set_value("shipment_date") ; ?>" class="datepicker" /></p></div>
                            </div>
                            
                            <div id="invoice_date_div" class="date-div">
                            	<div class='_100'><p><label for="invoice_date">Invoice Date</label><input type="text" id="invoice_date" name="invoice_date" value="<?php echo set_value("invoice_date") ; ?>" class="invoice_date_label" /></p></div>
                            </div>
                            
                            <div id="outstanding_date_div" class="date-div">
                            	<div class='_100'><p><label for="outstanding_date">Outstanding Date</label><input type="text" id="outstanding_date" name="outstanding_date" value="<?php echo set_value("outstanding_date") ; ?>" class="datepicker" /></p></div>
                            </div>
                            
                            <div id="compeletion_date_div" class="date-div">
                            	<div class='_100'><p><label for="compeletion_date">Completion Date</label><input type="text" id="compeletion_date" name="compeletion_date" value="<?php echo set_value("compeletion_date") ; ?>" class="datepicker" /></p></div>
                        	</div>
                        </div>
                              
                    </fieldset>
                    
                    <fieldset>
                    	<legend>Order Email</legend>
                    	<div class='_50'>
                        	<p>
                            <label for="username">Send Email?</label>
                        	<input type="radio" id="send_email1" name="send_email" value="Yes" <?php echo set_radio('send_email', 'Yes', TRUE) ; ?> /> Yes
                            <input type="radio" id="send_email2" name="send_email" value="No" <?php echo set_radio('send_email', 'No') ; ?> /> No
                            </p>
                        </div>
                    </fieldset>
                    
                    <div class='block-actions'>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Insert Order</a></li>
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
		if(validate_form() && valid_date()) $("#order_form").submit() ;
		else return false ;
	}) ;
	
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("customers") ; ?>" ;
	}) ;
	 
}) ;
</script>

<script type="application/javascript">
function valid_date()
{
	var order_status = $("#order_status option:selected").val() ;
	if(order_status == "") { alert("Order Status is required") ; return false ; }
	
	var creation_date = $("#creation_date").val() ;
	var order_date = $("#order_date").val() ;
	var acceptance_date = $("#acceptance_date").val() ;
	var shipment_date = $("#shipment_date").val() ;
	var invoice_date = $("#invoice_date").val() ;
	var outstanding_date = $("#outstanding_date").val() ;
	var compeletion_date = $("#compeletion_date").val() ;
	
	if(order_status == "Pending")
	{
		if(creation_date == "") { alert("Creation Date is required") ; return false ; }
		else return true ;
	}
	
	if(order_status == "Ordered")
	{
		if(creation_date == "") { alert("Creation Date is required") ; return false ; }
		else if(order_date == "") { alert("Order Date is required") ; return false ; }
		else return true ;
	}
	
	if(order_status == "Accepted")
	{
		if(creation_date == "") { alert("Creation Date is required") ; return false ; }
		else if(order_date == "") { alert("Order Date is required") ; return false ; }
		else if(acceptance_date == "") { alert("Accceptance Date is required") ; return false ; }
		else return true ;
	}
	
	if(order_status == "Shiped")
	{
		if(creation_date == "") { alert("Creation Date is required") ; return false ; }
		else if(order_date == "") { alert("Order Date is required") ; return false ; }
		else if(acceptance_date == "") { alert("Accceptance Date is required") ; return false ; }
		else if(shipment_date == "") { alert("Shipment Date is required") ; return false ; }
		else return true ;
	}
	
	if(order_status == "Invoiced")
	{
		if(creation_date == "") { alert("Creation Date is required") ; return false ; }
		else if(order_date == "") { alert("Order Date is required") ; return false ; }
		else if(acceptance_date == "") { alert("Accceptance Date is required") ; return false ; }
		else if(shipment_date == "") { alert("Shipment Date is required") ; return false ; }
		else if(invoice_date == "") { alert("Invoice Date is required") ; return false ; }
		else return true ;
	}
	
	if(order_status == "Outstanding")
	{
		if(creation_date == "") { alert("Creation Date is required") ; return false ; }
		else if(order_date == "") { alert("Order Date is required") ; return false ; }
		else if(acceptance_date == "") { alert("Accceptance Date is required") ; return false ; }
		else if(shipment_date == "") { alert("Shipment Date is required") ; return false ; }
		else if(invoice_date == "") { alert("Invoice Date is required") ; return false ; }
		else if(outstanding_date == "") { alert("Outstanding Date is required") ; return false ; }
		else return true ;
	}
	
	if(order_status == "Completed")
	{
		if(creation_date == "") { alert("Creation Date is required") ; return false ; }
		else if(order_date == "") { alert("Order Date is required") ; return false ; }
		else if(acceptance_date == "") { alert("Accceptance Date is required") ; return false ; }
		else if(shipment_date == "") { alert("Shipment Date is required") ; return false ; }
		else if(invoice_date == "") { alert("Invoice Date is required") ; return false ; }
		else if(outstanding_date == "") { alert("Outstanding Date is required") ; return false ; }
		else if(compeletion_date == "") { alert("Outstanding Date is required") ; return false ; }
		else return true ;
	}
}
</script>

<script type="application/javascript">
function validate_form()
{
	var flag = 0 ;
	
	$(".product_quantity").each(function(){
	
		var type = $(this).attr("type") ;
		
		if(type != "hidden")
		{
			var number = $(this).attr("number") ;
			issue_num = number ;
			var group_val = parseInt($("#product_group"+number+" option:selected").val().length) ;
			
			if(!(group_val))
			{
				$("#group_"+number).css("background-color", '#FF6A6A') ;
				flag = 1 ;
			}
			
			var product_val = parseInt( $("#products"+number+" option:selected").val().length ) ;
			if( !(product_val) )
			{
				$("#product_"+number).css("background-color", '#FF6A6A') ;
				flag = 2 ;
			}
			
			var quantity = parseInt($(this).val()) ;
			if( isNaN(quantity) ) {
				$("#quantity_"+number).css("background-color", '#FF6A6A') ;
				flag = 3 ;
			}
		}
		/**/
	}) ;
	
	falg = 2 ;
	if(flag) return false ;
	else return true ;
}
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
				 url:"<?php echo base_url() ; ?>orders/get_td_ajax",
				data:data1,
			 success:function(msg) { html_data = msg ; }
			});
			
			$("#last1").before(html_data) ;
			
			$("#current_tr").val(parseInt(current_tr) + 1) ;
			$("#current_num").val(parseInt(current_num) + 1) ;
			
			$("select#product_group"+(parseInt(current_tr) + 1)).uniform() ;
			$("select#products"+(parseInt(current_tr) + 1)).uniform() ;
		}) ;
	});
</script>

<script type="application/javascript">
$(function(){
	$(".product_group").live('change', function(){
		
		var num = $(this).attr("number") ;
		var group = "#product_group"+num+" option:selected" ;
		var group_id = $(group).val() ;
		var customer_id = $("#customer_id").val() ;
		
		$("#group_"+num).css("background-color", '#F2F2F2') ;
		
		var data1 = "group_id="+group_id+"&number="+num+"&customer_id="+customer_id ;
		
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
		$("select#products"+num).uniform() ;
		
		if(group_id == "") 
		{
			var str1 = "#product_quantity"+num ;
			$(str1).val("") ;
			$("#unit_price_"+num).html("0.00") ;
			$("#total_price_"+num).html("0.00") ;
		}
		vat_and_total() ;
	}) ;
}) ;
</script>

<script type="application/javascript">
	$(function(){
		$(".products_dropdown").live('change', function(){
			var num = $(this).attr("number") ;
			var str = "#products"+num+" option:selected" ;
			var option_val = $(str).val() ;
			
			if(option_val != "")
			{
				var arr = new Array ;
				arr = option_val.split("|") ;
				$("#unit_price_"+num).html(arr[1]) ;
				$("#product_"+num).css("background-color", '#F2F2F2') ;
			} else {
				var str1 = "#product_quantity"+num ;
				$(str1).val("") ;
				$("#unit_price_"+num).html("0.00") ;
				$("#total_price_"+num).html("0.00") ;
			}
			product_quantity(num) ;
			vat_and_total() ;
			return true ;
		}) ;
	}) ;
</script>


<script type="application/javascript">
	$(function(){
		$(".product_quantity").live('keyup', function(){
			var num = $(this).attr("number") ;
			product_quantity(num) ;
		}) ;
	}) ;

function product_quantity(num)
{
	var str1 = "#product_quantity"+num ;
	var curr_quantity = parseInt($(str1).val()) ;

	var str2 = "#products"+num+" option:selected" ;
	var option_val = $(str2).val() ;
	var unit_price = 0 ;

	if(option_val != "")
	{
		var arr1 = new Array ;
		arr1 = option_val.split("|") ;
		unit_price = parseFloat(arr1[1]) ;
	}
			
	var cur_total = parseFloat(curr_quantity * unit_price) ;
	cur_total = cur_total.toFixed(2) ; 
				
	if( !(isNaN(curr_quantity)) && unit_price != 0) { $("#total_price_"+num).html(cur_total) ; $("#quantity_"+num).css("background-color", '#F2F2F2') ; }
	else $("#total_price_"+num).html("0.00") ; 
			
	vat_and_total() ;
}
	
</script>

<script type="application/javascript">
$(function(){
	$(".remove_record").live("click", function(){
		if(confirm('Are you sure want to remove this record'))
		{
			var id = $(this).attr("id") ;
			$("#tr_"+id).remove() ;
			
			var current_num = parseInt($("#current_num").val()) - 1 ;
			$("#current_num").val(current_num) ;
			vat_and_total() ;
		}
	});
}) ;
</script>

<script type="application/javascript">
function vat_and_total()
{
	var current_tr = parseInt($("#current_tr").val()) ;
	var vat_rate = parseFloat($("#vat_rate").val()) / 100 ;
	
	var sub_total = 0 ;
	var vat_total = 0 ;
	var total = 0 ;
	
	var unit_price = 0 ;
	var quantity = 0 ;
	
	$(".product_quantity").each(function(){
		
		//var is_element_input = $(this).is("input"); 
		
		unit_price = 0 ;
		quantity = 0 ;
		
		var quantity = parseInt($(this).val()) ;
		
		if( !(isNaN(quantity)) )
		{
			var number = $(this).attr("number") ;
			var option_val = $("#products"+number).val() ;
			
			if(option_val != "")
			{
				var arr = new Array ;
				arr = option_val.split("|") ;
				unit_price = parseFloat(arr[1]) ;
			}
			sub_total = sub_total + (unit_price * quantity) ;
		}
	}) ;
	
	var transpotation_charges = freigh_charges(sub_total) ;
	sub_total = transpotation_charges + sub_total ;
	vat_total = vat_rate * sub_total ;
	total = sub_total + vat_total ;
	
	if( !(isNaN(sub_total)) )
	{
		$("#sub_total").html(sub_total.toFixed(2)) ;
		$("#sub_total_hidden").val(sub_total.toFixed(2)) ;
	} else {
		$("#sub_total").html("0.00") ;
		$("#sub_total_hidden").val("0.00") ;
	}
	
	if( !(isNaN(vat_total)) )
	{
		$("#sub_total_vat").html(vat_total.toFixed(2)) ;
		$("#vat_total_hidden").val(vat_total.toFixed(2)) ;
	} else {
		$("#sub_total_vat").html("0.00") ;
		$("#vat_total_hidden").val("0.00") ;
	}
	
	if( !(isNaN(total)) ) $("#total_plus_vat").html(total.toFixed(2)) ;
	else $("#total_plus_vat").html("0.00") ;
}

function freigh_charges(sub_total)
{
	var maximum_limit = parseFloat($("#maximum_limit").val()) ;
	var transport_charges = parseFloat($("#transport_charges").val()) ;
	
	if( !(isNaN(sub_total)) )
	{
		if((sub_total <= maximum_limit) && (sub_total > 0))
		{
			$("#sub_total_transpotation_charges").html(transport_charges.toFixed(2)) ;	
			return transport_charges ;
		}
		else
		{
			$("#sub_total_transpotation_charges").html("0.00") ;	
			return 0 ;
		}
	} 
	else
		return 0 ;
}
</script>