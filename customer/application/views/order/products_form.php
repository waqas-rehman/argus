
<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Order - Add Products<span class="hide"></span></div>
			<div class="content">
				<form id="dynamic_products_form" action="" method="post">
                
                <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_id ; ?>" />
                <input type="hidden" id="current_tr" name="current_tr" value="1" />
                <input type="hidden" id="current_num" name="current_num" value="1" />
                <input type="hidden" id="vat_rate" name="vat_rate" value="<?php echo floatval($vat_rec->vat_rate) ; ?>" />
                
                <input type="hidden" id="maximum_limit" name="maximum_limit" value="<?php echo $customer_rec->maximum_limit ; ?>" />
                <input type="hidden" id="transport_charges" name="transport_charges" value="<?php echo $customer_rec->transport_charges ; ?>" />
                
                <table cellspacing="0" cellpadding="0" border="0"> 
					<thead> 
						<tr>
							<th>Product Group</th>
							<th>ADL Code - Product Code</th>
							<th>Quantity</th>
							<th>Unit Price (&pound;)</th>
                            <th>Total Price (&pound;)</th>
							<th>Action</th>
                        </tr>
					</thead>
					<tbody>
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
                            	<select id="products1" class="products_dropdown big1" name="products[]" number="1">
                                	<option value="">Select Products</option>
                                </select>
                            </td>
							<td id="quantity_1">
                            	<input type="text" id="product_quantity1"  name="product_quantity[]" value="" class="product_quantity" number="1" />
                            </td>
							<td id="unit_price_1">0.00</td>
                            <td id="total_price_1">0.00</td>
                            <td id="action_1">
                            	<a id="1" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="<?php echo base_url("gfx/icons/small/cancel.png") ; ?>" /></a>
                            </td>
						</tr>
                        
                       <tr id="last1"><td colspan="5"><a id="add_column" href="javascript:void(0);">Add another product</a></td><td></td></tr>
                       
                       <tr id="last5"><td colspan="4" style="text-align:right !important;">Delivery Charges</td><td id="sub_total_transpotation_charges">0.00</td><td></td></tr>
                       
                       <tr id="last2"><td colspan="4" style="text-align:right !important;">Sub Total Amount: </td><td id="sub_total">0.00</td><td></td></tr>
                       <!--<tr id="last3"><td colspan="4" style="text-align:right !important;">VAT Code: </td><td id="vat-code"><?php // echo $vat_rec->vat_code ; ?></td><td></td></tr> -->
                        <tr id="last4"><td colspan="4" style="text-align:right !important;">VAT (<?php echo floatval($vat_rec->vat_rate)."%" ; ?>)</td><td id="sub_total_vat">0.00</td><td></td></tr>
                        <tr id="last6"><td colspan="4" style="text-align:right !important;">Total</td><td id="total_plus_vat">0.00</td><td></td></tr>
                    </tbody>
				</table>
                <br />
                <input type="hidden" id="sub_total_hidden" name="sub_total_hidden" value="0.00" />
                <input type="hidden" id="vat_total_hidden" name="vat_total_hidden" value="0.00" />
                <input type="hidden" id="freight_charges" name="freight_charges" value="0.00" />
                <input type="hidden" id="next_step" name="next_step" value="" />
                
                <div class="row">
                	<button id="add_description" type="button"><span>Next &gt;&gt;</span></button>&nbsp;
                    <button id="save_and_submit" type="button"><span>Save</span></button>&nbsp;
                    <button id="cancel_products" type="button"><span>Cancel</span></button>&nbsp;&nbsp;
                    <a href="<?php echo base_url("orders/order_detail/".$order_id) ; ?>">Order Details</a>
                </div>
                </form>
			</div>
		</div>
	</div>
</div>

<script type="application/javascript">
$(function(){
	
	$("#add_description").click(function(){
		if(validate_form()) {
			$("#dynamic_products_form").attr("action","<?php echo base_url("orders/products") ; ?>") ;
			$("#next_step").val("add_description") ;
			$("#dynamic_products_form").submit() ;
		} else 
			return false ;
	});
	
	$("#save_and_submit").click(function(){
		if(validate_form()) {
			$("#dynamic_products_form").attr("action","<?php echo base_url("orders/products") ; ?>") ;
			$("#next_step").val("save") ;
			$("#dynamic_products_form").submit() ;
		} else
			return false ;
	});
	
	$("#cancel_products").click(function(){ window.location.href = "<?php echo base_url("orders") ; ?>" ; });
	
});
</script>

<script type="application/javascript">
function validate_form()
{
	var flag = 0 ;
	
	$(".product_quantity").each(function(){
		
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
	}) ;
	
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
			
			$("select#product_group"+(parseInt(current_tr) + 1)).selectmenu({style: 'dropdown', transferClasses: true, width: null}) ;
			$("select#products"+(parseInt(current_tr) + 1)).selectmenu({style: 'dropdown', transferClasses: true, width: null}) ;
		}) ;
	});
</script>

<script type="application/javascript">
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
				$("#product_"+num).css("background-color", '#FFFFFF') ;
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
				
	if( !(isNaN(curr_quantity)) && unit_price != 0) { $("#total_price_"+num).html(cur_total) ;  $("#quantity_"+num).css("background-color", '#FFFFFF') ; }
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