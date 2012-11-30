<div id="main-content">
	<div class="container_12">
		<div class="grid_12"><h1>Product Groups</h1></div>
		<div class='grid_12'>
			<div class='block-border'>
				<div class='block-header'><h1>Product Group List</h1><span></span></div>
				<?php 
				if($msg)
				{
                	if($msg == 1)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Product Group added successfully</li></ul></div>' ;
					}
					if($msg == 2)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Product group removed successfully</li></ul></div>' ;
					}
					if($msg == 3)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to remove product group record</li></ul></div>' ;
					}
				}
                ?>
                <div class='block-content'>
					
                    <table id='table-example' class='table'>
						<thead>
                        	<tr>
                            	<th class='center'>Group Name</th>
                                <th class='center'>Creation Date</th>
                                <th class='center'>Update Date</th>
                                <th class='center'>Status</th>
                                <th class='center'>Action</th>
							</tr>
						</thead>
						<?php if($product_groups) { ?>
                        <tbody>
                        	<?php foreach($product_groups as $rec) : ?>
                            <tr class='gradeX'>
								<td class='center'><a href="#"><?php echo $rec->group_name ; ?></a></td>
                                <td class='center'><?php echo date("d/m/Y g:i a", strtotime($rec->creation_date)) ; ?></td>
								<td class='center'><?php echo date("d/m/Y g:i a", strtotime($rec->update_date)) ; ?></td>
                                <td class='center'><?php echo $rec->status ; ?></td>
								<td class='center'>
                                	&nbsp;<a href="<?php echo base_url("product/product_group_details/".$rec->id."/0") ; ?>"><img title="Edit Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/pencil.png") ; ?>" /></a>
                                    &nbsp;<a href="<?php echo base_url("product/remove_product_group/".$rec->id) ; ?>" onclick="return confirm('Are you sure to delete this record?')" ><img title="Remove Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
                              	</td>
							</tr>
                            <?php endforeach ; ?>
 						</tbody>
						<?php } ?>
                    </table>
                  </div>
			</div>
		</div>
		<div class="clear height-fix"></div>
	</div>
	
	<div class="container_12">
		<div class='grid_12'><h1>Add New Product Group</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>Product Group Information</h1><span></span></div>
                <?php
					if($msg)
					{
                		if($msg == 5) 
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul>'.validation_errors().'</ul></div>' ;
						}
						if($msg == 6)
						{
							echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
							echo '<div class="error_msg"><ul><li>Failed to Add Product Group</li></ul></div>' ;
						}
					}
				?>
                <form id="product_group_form" class="block-content form" action="<?php echo base_url("product/add_product_group") ; ?>" method="post">
                	<fieldset>
                    	<legend>Product Group Description</legend>
						
						<div class='_50'><p><label for="group_name">Product Group Name</label><input type="text" id="group_name" name="group_name" value="<?php echo set_value("product_group_name") ; ?>" /></p></div>
                        
						<div class='_50'><p><span class="product_group_status">Status</span><select id="product_group_status" name="product_group_status"><option value="Active" <?php echo set_select('status', 'Active', TRUE); ?>>Active</option><option value="Disable" <?php echo set_select('status', 'Disable'); ?>>Disable</option></select></p></div>
					
					</fieldset>
                    <div class='block-actions'>
						<ul class='actions-left'><li><a id="clear_form" class="close-toolbox button red" href="javascript:void(0);">Clear Form</a></li></ul>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Add Product Group</a></li>
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
	
	<script type="text/javascript">
	$(function(){
		
		$("#clear_form").click(function(){
			$("#group_name").val("") ;
			$("#product_group_status").val("Active") ;
			$("#uniform-product_group_status span").html("Active") ;
		}) ;
		
		$("#cancel_form").click(function(){
			window.location.href = "<?php echo base_url("product") ; ?>" ;
		}) ;
		
		$("#submit_form").click(function(){
			$("#product_group_form").submit() ;
		}) ;
		
	}) ;
	</script>
	
</div> <!-- end of #main-content -->