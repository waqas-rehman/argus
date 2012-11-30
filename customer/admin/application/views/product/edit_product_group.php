<div id="main-content">
	<div class="container_12">
		<div class='grid_12'><h1>Product Group Details</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Product Group Information</h1><span></span></div>
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
							echo '<div class="error_msg"><ul><li>Failed to update product group record</li></ul></div>' ;
						}
						if($msg == 3)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
							echo '<div class="success_msg"><ul><li>Product Group record updated successfully</li></ul></div>' ;
						}
					}
				?>
                <form id="product_group_update_form" class="block-content form" action="<?php echo base_url("product/update_group_details") ; ?>" method="post">
					<input type="hidden" name="product_id" id="product_id" value="<?php echo $product_rec->id ; ?>" />
                	<fieldset>
                    	<legend>Product Group Description</legend>
						<input type="hidden" id="product_group_id" name="product_group_id" value="<?php echo $product_rec->id ; ?>" />
						<div class='_50'><p><label for="group_name">Product Group Name</label><input type="text" id="group_name" name="group_name" value="<?php echo $product_rec->group_name ; ?>" /></p></div>
                        
						<div class='_50'><p><span class="product_group_status">Status</span><select id="product_group_status" name="product_group_status"><option value="Active" <?php if($product_rec->status == "Active") echo 'selected="selected"'; ?>>Active</option><option value="Disable" <?php if($product_rec->status == "Disable") echo 'selected="selected"'; ?>>Disable</option></select></p></div>
					
					</fieldset>
					
                    <div class='block-actions'>
						<ul class='actions-left'><li><a id="clear_form" class="close-toolbox button red" href="javascript:void(0);">Clear Form</a></li></ul>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Update Product Group</a></li>
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
			$("#group_name").val("") ;
			$("#product_group_status").val("Active") ;
			$("#uniform-product_group_status span").html("Active") ;
		}) ;
		
		$("#cancel_form").click(function(){
			window.location.href = "<?php echo base_url("product/product_group") ; ?>" ;
		}) ;
		
		$("#submit_form").click(function(){
			$("#product_group_update_form").submit() ;
		}) ;
		
	}) ;
</script>