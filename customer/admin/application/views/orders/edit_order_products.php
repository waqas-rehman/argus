<div id="main-content">
	<div class="container_12">
		<div class="grid_12"><h1>Order Details</h1></div>
		<div class='grid_12'>
			<div class='block-border'>
				<div class='block-header'><h1>Order Products List</h1><span></span></div>
				<?php 
				if($msg)
				{
                	if($msg == 1)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Product record removed successfully</li></ul></div>' ;
					}
					if($msg == 2)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to remove Product record</li></ul></div>' ;
					}
				}
                ?>
                <!-- <form class="block-content form">
				<fieldset><legend>Important Information</legend><div class='_50'><p><b>Click on the Purchase Order Number to View Order Details</b></p></div></fieldset>
                </form> -->         	
                <div class='block-content'>
                <br />
                	<form id="dynamic_products_form" action="<?php echo base_url("orders/update_products") ; ?>" method="post">
                    
                    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $customer_rec->id ?>" /> 
                    
                    <input type="hidden" id="order_id" name="order_id" value="<?php echo $order_id ; ?>" />
                    <input type="hidden" id="current_tr" name="current_tr" value="<?php echo intval($total_products) + 1 ; ?>" />
                    <input type="hidden" id="current_num" name="current_num" value="<?php echo intval($total_products) + 1 ; ?>" />
                    <input type="hidden" id="vat_rate" name="vat_rate" value="<?php echo floatval($vat_rec->vat_rate) ; ?>" />
                    
                    <input type="hidden" id="maximum_limit" name="maximum_limit" value="<?php echo $customer_rec->maximum_limit ; ?>" />
   		           
                   <table><tbody><tr><td align="center" valign="middle">Transport Charges:&nbsp;&nbsp;&nbsp;</td><td align="center" valign="middle"><input type="text" id="transport_charges"  name="transport_charges" value="<?php echo $order_rec->transport_charges ; ?>" class="ttransport_charges" /></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table>
                    
                    <table class='table'> <!-- id='table-example' -->
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
                        	<?php
							$temp_sub_total = 0 ;
							$temp_vat_tax = 0 ; 
							if($products_rec) { $x = 1 ; foreach($products_rec as $rec): ?>
                            <tr id="tr_<?php echo $x ; ?>">
                                <td id="group_<?php echo $x ; ?>">
                                    <input type="hidden" id="product_group<?php echo $x ; ?>" name="product_group[]" value="<?php echo $rec->product_group_id ; ?>"  class="product_group"  number="<?php echo $x ; ?>" />
                                    <?php echo $rec->product_group ; ?>			
                                </td>
                                <td id="product_<?php echo $x ; ?>">
                                    <input type="hidden" id="products<?php echo $x ; ?>" name="products[]" value="<?php echo $rec->product_id."|".$rec->product_price ; ?>"  class="products_dropdown"  number="<?php echo $x ; ?>" />
                                    <?php echo $rec->product_name ; ?>
                                </td>
                                <td id="quantity_<?php echo $x ; ?>">
                                    <input type="hidden" id="product_quantity<?php echo $x ; ?>"  name="product_quantity[]" value="<?php echo $rec->product_quantity ; ?>" class="product_quantity" number="<?php echo $x ; ?>" />
                                    <?php echo $rec->product_quantity ; ?>
                                </td>
                                <!-- number_format ( float $number , int $decimals = 0 , string $dec_point = '.' , string $thousands_sep = ',' ) -->
                                <td id="unit_price_<?php echo $x ; ?>"><?php echo number_format($rec->product_price, 2 , ".", ",") ; ?></td>
                                <td id="total_price_<?php echo $x ; ?>">
                                    <?php
                                        echo number_format (($rec->product_price) * ($rec->product_quantity), 2 , ".", ",") ;
                                        $temp_sub_total = $temp_sub_total + floatval(($rec->product_price) * ($rec->product_quantity)) ;
                                    $temp_vat_tax = $temp_vat_tax + floatval((($rec->vat_rate)/100) * ($rec->product_price) * ($rec->product_quantity)) ;
                                    ?>
                                </td>
                                <td id="action_<?php echo $x ; ?>">
                                    <a id="<?php echo $x ; ?>" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
                                </td>
                            </tr>
                            <?php $x = $x + 1 ; endforeach ; } ?>
                            
                            <tr id="tr_<?php echo intval($total_products) + 1 ; ?>">
                                <td id="group_<?php echo intval($total_products) + 1 ; ?>">
                                    <select id="product_group<?php echo intval($total_products) + 1 ; ?>" class="product_group" name="product_group[]" number="<?php echo intval($total_products) + 1 ; ?>">
                                        <option value="">Select Group</option>
                                        <?php if($product_groups) { foreach($product_groups as $rec): ?>
                                            <option value="<?php echo $rec->id ; ?>"><?php echo $rec->group_name ; ?></option>
                                        <?php endforeach ; } ?>
                                    </select>
                                </td>
                                <td id="product_<?php echo intval($total_products) + 1 ; ?>">
                                    <select id="products<?php echo intval($total_products) + 1 ; ?>" class="products_dropdown" name="products[]" number="<?php echo intval($total_products) + 1 ; ?>">
                                        <option value="">Select Products</option>
                                    </select>
                                </td>
                                <td id="quantity_<?php echo intval($total_products) + 1 ; ?>">
                                    <input type="text" id="product_quantity<?php echo intval($total_products) + 1 ; ?>"  name="product_quantity[]" value="" class="product_quantity" number="<?php echo intval($total_products) + 1 ; ?>" />
                                </td>
                                <td id="unit_price_<?php echo intval($total_products) + 1 ; ?>">0.00</td>
                                <td id="total_price_<?php echo intval($total_products) + 1 ; ?>">0.00</td>
                                <td id="action_1">
                                    <a id="<?php echo intval($total_products) + 1 ; ?>" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
                                </td>
                            </tr>
                            
                           <tr id="last1"><td colspan="5"><a id="add_column" href="javascript:void(0);">Add another product</a></td><td></td></tr>
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
                            <td></td></tr>
                            
                           <tr id="last2"><td colspan="4" style="text-align:right !important;">Sub Total Amount: </td><td id="sub_total"><?php echo number_format(($temp_sub_total + $transport_charges), 2 , ".", ",") ; ?></td><td></td></tr>
                           
                           <tr id="last3"><td colspan="4" style="text-align:right !important;">VAT Code: </td><td id="vat-code"><?php echo $vat_rec->vat_code ; ?></td><td></td></tr>
                           <?php $temp_vat_tax = $temp_vat_tax + ($transport_charges * (floatval($vat_rec->vat_rate)/100)) ; ?>
                           <tr id="last4"><td colspan="4" style="text-align:right !important;">VAT</td><td id="sub_total_vat"><?php echo number_format(($temp_vat_tax), 2 , ".", ",") ; ?></td><td></td></tr>
                            
                            <tr id="last6"><td colspan="4" style="text-align:right !important;">Total</td><td id="total_plus_vat"><?php echo number_format(( $temp_vat_tax  + $temp_sub_total + $transport_charges ), 2, ".", ",") ;  ?></td><td></td></tr>
                        </tbody>
                    </table><br /><br />
       <input type="hidden" id="sub_total_hidden" name="sub_total_hidden" value="<?php echo number_format(($temp_sub_total), 2 , ".", ",") ; ?>" />
       <input type="hidden" id="vat_total_hidden" name="vat_total_hidden" value="<?php echo number_format(($temp_vat_tax), 2 , ".", ",") ; ?>" />
       <input type="hidden" id="freight_charges" name="freight_charges" value="0.00" />
                <div class="block-actions">
                    <ul class="actions-left"><li><a id="back" class="close-toolbox button red cancel_form" href="javascript:void(0);">&lt;&lt; Back</a></li></ul>
                    <ul class="actions-right"><li><a id="update_products" class="close-toolbox button" href="javascript:void(0);">Update Products &gt;&gt;</a></li></ul>
                </div>
                </form>
                
                </div>
			</div>
		</div>
		<div class="clear height-fix"></div>
	</div>
</div> <!--! end of #main-content -->


<script type="application/javascript">
$(function(){
	
	$("#update_products").click(function(){
		if(validate_form())
			$("#dynamic_products_form").submit() ;
		else 
			return false ;
	});
	
	$("#back").click(function(){ window.location.href = "<?php echo base_url("orders/order_details/".$order_id) ; ?>" ; });
	
});
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
	
	$(".ttransport_charges").live('blur', function(){
		vat_and_total() ;
	}) ;
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