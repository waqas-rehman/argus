<script type="text/javascript" src="<?php echo base_url() ; ?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
});
</script>
<!-- /TinyMCE -->
<link type="text/css" href="<?php echo base_url() ; ?>css/ui-lightness/jquery-ui-1.8.23.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url() ; ?>js/jquery-ui-1.8.23.custom.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$(".datepicker").datepicker({
				inline: true,
				dateFormat: "mm/dd/yy"
			});
		});
		</script>
	
<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Order Details</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Basic Information</h1><span></span></div>
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
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Record updated successfully</li></ul></div>' ;
						}
						if($msg == 4)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to update record</li></ul></div>' ;
						}
						
						
					}
				?>
                <form id="return_form" class="block-content form" action="<?php echo base_url("returns/update_return") ; ?>" method="post">
                	<input type="hidden" id="return_id" name="return_id" value="<?php echo $return_rec->id ; ?>" />
                    <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $return_rec->customer_id ; ?>" /> 
                    
                    <!-- <fieldset>
						<legend>Important Information</legend>
						<div class='_100'><p><b>For Multiple Recipients: </b>Use Comma(,) Separated Email Addresses (e.g. email_address_1, email_address_2, email_address_3)</p></div>
					</fieldset> -->
					
                    <fieldset>
                    	<legend>Order Basic Information</legend>
                        
						<div class='_100'>
							<?php
								$open = FALSE ; $submit = FALSE ; $close = FALSE ;
								if($return_rec->status == "Open") $open = TRUE ;
								if($return_rec->status == "Submit") $submit = TRUE ;
								if($return_rec->status == "Close") $close = TRUE ;
							?>
							<p>
								<label for="">Status</label>
								<select id="status" name="status">
									<option value="Open" <?php echo set_select('status', 'Open', $open); ?>>Open</option>
									<option value="Submit" <?php echo set_select('status', 'Submit', $submit); ?>>Submit</option>
									<option value="Close" <?php echo set_select('status', 'Close', $close); ?>>Close</option>
								</select>
							</p>
						</div>
						
                        <div class='_100'>
							<p>
								<label for="">RMA Number</label>
									<input type="text" id="rma_number" name="rma_number" value="<?php echo set_value("rma_number",  $return_rec->rma_number) ; ?>" />
							</p>
						</div>
                        
						<div class='_100'>
                        	<p>
                            	<label for="">Customer Representative</label>
                                <input type="text" id="customer_representative" name="customer_representative" value="<?php echo set_value("customer_representative", $return_rec->customer_representative) ; ?>" />
							</p>
						</div>
						
						<?php
							$yes = FALSE ; $no = FALSE ;
							if($return_rec->credit_required == "Yes") $yes = TRUE ;
							else $no = TRUE ;
						?>
						<div class='_100'>
                        	<p>
                            	<label for="credit_required">Credit Required</label>
                        		<input type="radio" id="credit_required" name="credit_required" value="Yes" <?php echo set_radio('credit_required', 'Yes', $yes) ; ?> /> Yes
                                <input type="radio" id="credit_required" name="credit_required" value="No" <?php echo set_radio('credit_required', 'No', $no) ; ?> /> No
                            </p>
                        </div>
						
						<?php
							$yes = FALSE ; $no = FALSE ;
							if($return_rec->repair_required == "Yes") $yes = TRUE ;
							else $no = TRUE ;
						?>
						<div class='_100'>
                        	<p>
                            	<label for="">Repair Required</label>
                        		<input type="radio" id="repair_required" name="repair_required" value="Yes" <?php echo set_radio('repair_required', 'Yes', $yes) ; ?> /> Yes
                                <input type="radio" id="repair_required" name="repair_required" value="No" <?php echo set_radio('repair_required', 'No', $no) ; ?> /> No
                            </p>
                        </div>
						
						<div class='_100'>
                        	<p>
                            	<label for="invoice_number">Invoice Number to Credit Against</label>
                                <input type="text" id="invoice_number" name="invoice_number" value="<?php echo set_value("invoice_number", $return_rec->invoice_number) ; ?>" />
							</p>
						</div>
						
						<?php
							$yes = FALSE ; $no = FALSE ;
							if($return_rec->report_required == "Yes") $yes = TRUE ;
							else $no = TRUE ;
						?>
						<div class='_100'>
                        	<p>
                            	<label for="report_required">Report Required</label>
                        		<input type="radio" id="report_required" name="report_required" value="Yes" <?php echo set_radio('report_required', 'Yes', $yes) ; ?> /> Yes
                                <input type="radio" id="report_required" name="report_required" value="No" <?php echo set_radio('report_required', 'No', $no) ; ?> /> No
                            </p>
                        </div>
						
						<div class='_100'>
                        	<p>
                            	<label for="site_address">Site Address</label>
                                <input type="text" id="site_address" name="site_address" value="<?php echo set_value("site_address", $return_rec->site_address) ; ?>" />
							</p>
						</div>
						
						
                        <div class='_100'><p><label for="installation_details">Intallation Details</label><textarea id="installation_details" name="installation_details" rows="5" cols="40"><?php echo set_value("installation_details", $return_rec->installation_details) ; ?></textarea></p></div>
   <!-- 
                        <div class='_100'><p><label for="product_details">List of products being returned and their individual date codes</label><textarea id="product_details" name="product_details" rows="5" cols="40"><?php // echo set_value("product_details", $return_rec->product_details) ; ?></textarea></p></div> -->
					<br /><br />
					<input type="hidden" id="current_tr" name="current_tr" value="<?php echo intval($total_products) ; ?>" />
                    <input type="hidden" id="current_num" name="current_num" value="<?php echo intval($total_products) ; ?>" />
                    <label for="product_details">List of products being returned and their individual date codes</label>
                    <table class='table'> <!-- id='table-example' -->
						<thead>
                        	<tr>
                            	<th>Product Group</th>
                                <th>Products</th>
                                <th>Quantity</th>
                                <th>Date Code</th>
								<th>Action</th>
                        	</tr>
						</thead>
						
						<tbody>
						 	<?php if($products_rec) { $x = 1 ; foreach($products_rec as $rec): ?>
                            <tr id="tr_<?php echo $x ; ?>">
								<td id="group_<?php echo $x ; ?>">
									<input type="hidden" id="product_group<?php echo $x ; ?>" name="product_group[]" value="<?php echo $rec->group_id ; ?>"  class="product_group"  number="<?php echo $x ; ?>" />
                                    <?php echo $rec->group_name ; ?>			
                                </td>
                                <td id="product_<?php echo $x ; ?>">
                                    <input type="hidden" id="products<?php echo $x ; ?>" name="products[]" value="<?php echo $rec->product_id ; ?>"  class="products_dropdown"  number="<?php echo $x ; ?>" />
                                    <?php echo $rec->product_name ; ?>
                                </td>
                                <td id="quantity_<?php echo $x ; ?>">
                                    <input type="hidden" id="product_quantity<?php echo $x ; ?>"  name="product_quantity[]" value="<?php echo $rec->product_quantity ; ?>" class="product_quantity" number="<?php echo $x ; ?>" />
                                    <?php echo $rec->product_quantity ; ?>
                                </td>
                                
								<td id="quantity_<?php echo $x ; ?>">
                                    <input type="hidden" id="date_code<?php echo $x ; ?>"  name="date_code[]" value="<?php echo $rec->date_code ; ?>" class="date_code" number="<?php echo $x ; ?>" />
                                    <?php echo $rec->date_code ; ?>
                                </td>
                                <td id="action_<?php echo $x ; ?>">
                                    <a id="<?php echo $x ; ?>" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
                                </td>
                            </tr>
                            <?php $x = $x + 1 ; endforeach ; } ?>
                            <!--
							<tr id="tr_<?php // echo intval($total_products) + 1 ; ?>">
                                <td id="group_<?php // echo intval($total_products) + 1 ; ?>">
                                    <select id="product_group<?php // echo intval($total_products) + 1 ; ?>" class="product_group" name="product_group[]" number="<?php // echo intval($total_products) + 1 ; ?>">
                                        <option value="">Select Group</option>
                                        <?php // if($product_groups) { foreach($product_groups as $rec): ?>
                                            <option value="<?php // echo $rec->id ; ?>"><?php // echo $rec->group_name ; ?></option>
                                        <?php // endforeach ; } ?>
                                    </select>
                                </td>
                                <td id="product_<?php // echo intval($total_products) + 1 ; ?>">
                                    <select id="products<?php // echo intval($total_products) + 1 ; ?>" class="products_dropdown" name="products[]" number="<?php // echo intval($total_products) + 1 ; ?>">
                                        <option value="">Select Products</option>
                                    </select>
                                </td>
                                <td id="quantity_<?php // echo intval($total_products) + 1 ; ?>">
                                    <input style="height:13px;" type="text" id="product_quantity<?php // echo intval($total_products) + 1 ; ?>"  name="product_quantity[]" value="" class="product_quantity" number="<?php // echo intval($total_products) + 1 ; ?>" />
                                </td>
                                <td id="unit_price_<?php // echo intval($total_products) + 1 ; ?>">0.00</td>
                                <td id="action_1">
                                    <a id="<?php // echo intval($total_products) + 1 ; ?>" class="remove_record" href="javascript:void(0);"><img title="Remove Product" src="<?php // echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
                                </td>
                            </tr>-->
                            
                           <tr id="last1"><td colspan="4"><a id="add_column" href="javascript:void(0);">Add another product</a></td><td></td></tr>
                        </tbody>
                    </table><br /><br />
       
		
						
						<div class='_100'><p><label for="environmental_conditions">Description of Faults and Environmental Conditions</label><textarea id="environmental_conditions" name="environmental_conditions" rows="5" cols="40"><?php echo set_value("environmental_conditions", $return_rec->environmental_conditions) ; ?></textarea></p></div>
						
						<!--   insert_date update_date -->
						
						<div class='_100'>
							<p>
								<label for="installation_date">Date of Installation</label>
									<input type="text" id="installation_date" name="installation_date" value="<?php echo set_value("installation_date", date("d/m/Y", strtotime($return_rec->installation_date))) ; ?>" class="datepicker" />
							</p>
						</div>
						
						<div class='_100'>
							<p>
								<label for="last_maintaince_date">Date of Last Maintaince</label>
									<input type="text" id="last_maintaince_date" name="last_maintaince_date" value="<?php echo set_value("last_maintaince_date", date("d/m/Y", strtotime($return_rec->last_maintaince_date))) ; ?>"  class="datepicker" />
							</p>
						</div>
						
						<div class='_100'><p><label for="additional_description">Additional Information</label><textarea id="additional_description" name="additional_description" rows="5" cols="40"><?php echo set_value("additional_description", $return_rec->additional_description) ; ?></textarea></p></div>
						
						
						
						
						
                    </fieldset>
                	
                    <div class='block-actions'>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Update Info</a></li>
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
	$("#submit_form").click(function(){	$("#return_form").submit() ; }) ;
	$("#cancel_form").click(function(){ window.location.href = "<?php echo base_url("returns") ; ?>" ; }) ;
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
			
		$("select#product_group"+(parseInt(current_tr) + 1)).uniform() ;
		$("select#products"+(parseInt(current_tr) + 1)).uniform() ;
		
	}) ;
});

$(function(){
	
	$(".product_group").live('change', function(){
		
		var num = $(this).attr("number") ;
		var group = "#product_group"+num+" option:selected" ;
		var group_id = $(group).val() ;
		
		$("#group_"+num).css("background-color", '#F2F2F2') ;
		
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
		$("select#products"+num).uniform() ;
		
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