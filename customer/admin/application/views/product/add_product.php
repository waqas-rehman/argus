 <div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Add New Product</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Product Information</h1><span></span></div>
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
						if($msg == 2)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to Add Staff</li></ul></div>' ;
						}
					}
				?>
                <form id="product_form" class="block-content form" action="<?php echo base_url("product/add_product") ; ?>" method="post" enctype="multipart/form-data">
                	<fieldset>
                    	<legend>Product Description</legend>
						
						<div class='_50'><p><label for="product_name">Product Name</label><input type="text" id="product_name" name="product_name" value="<?php echo set_value("product_name") ; ?>" /></p></div>
                        
						<div class='_50'><p><label for="product_code">Product Code</label><input type="text" id="product_code" name="product_code" value="<?php echo set_value("product_code") ; ?>" /></p></div>
                        
						<div class='_50'><p><label for="adl_code">ADL Code</label><input type="text" id="adl_code" name="adl_code" value="<?php echo set_value("adl_code") ; ?>" /></p></div>
						
                        <div class='_50'><p><label for="product_price">Product Price (&pound;)</label><input type="text" id="product_price" name="product_price" value="<?php echo set_value("product_price") ; ?>" /></p></div>
						
                        <div class='_50'>
							<p>
								<span class="product_group">Product Group</span>
								<select id="product_group" name="product_group">
									<option value="">Select Group</option>
									<?php
										if($product_groups)
										{
											foreach($product_groups as $rec):
												echo '<option value="'.$rec->id.'" '.set_select("product_group", $rec->id).'>'.$rec->group_name.'</option>' ;
											endforeach ; 
										}
									?>
								</select>
							</p>
						</div>
						
                        <div class='_100'>
							<p><label for="product_description">Product Description</label><textarea id="product_description" name="product_description" rows="5" cols="40"><?php echo set_value("product_description") ; ?></textarea></p>
  						</div>
						
                        <div class='_50'><p><span class="status">Status</span><select id="status" name="status"><option value="Active" <?php echo set_select('status', 'Active', TRUE); ?>>Active</option><option value="Disable" <?php echo set_select('status', 'Disable'); ?>>Disable</option></select></p></div>
						
					</fieldset>
                 
                    <div class='block-actions'>
						<ul class='actions-left'><li><a id="clear_form" class="close-toolbox button red" href="javascript:void(0);">Clear Form</a></li></ul>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Add Product</a></li>
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
	$("#clear_form").click(function(){
		$("#product_name").val("") ;
		$("#product_code").val("") ;
		$("#adl_code").val("") ;
		$("#product_price").val("") ;
		$("#status").val("Active") ;
		$("#uniform-status span").html("Active") ;
		$("#product_group").val("Active") ;
		$("#uniform-product_group span").html("Select Group") ;
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#submit_form").click(function(){
		$("#product_form").submit() ;
	}) ;
}) ;
</script>

<script type="text/javascript">
$(function(){
	$("#cancel_form").click(function(){
		window.location.href = "<?php echo base_url("product") ; ?>" ;
	}) ;
}) ;
</script>