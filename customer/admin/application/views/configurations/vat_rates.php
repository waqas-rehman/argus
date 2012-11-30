<div id="main-content">
	<div class="container_12">
		<div class="grid_12"><h1>VAT Codes</h1></div>
		<div class='grid_12'>
			<div class='block-border'>
				<div class='block-header'><h1>VAT Code Rates</h1><span></span></div>
				<?php 
				if($msg)
				{
                	if($msg == 1)
					{
						echo '<script type="text/javascript">
							$(function(){
								$("#vat_code").val("") ;
								$("#vat_rate").val("") ;
								$("#vat_code_status").val("Active") ;
								$("#uniform-vat_code_status span").html("Active") ;
							}) ;
							setTimeout(function(){$(".success_msg").hide(); }, 5000);
							</script>';
						echo '<div class="success_msg"><ul><li>VAT Code added successfully</li></ul></div>' ;
					}
					if($msg == 2)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>VAT Code removed successfully</li></ul></div>' ;
					}
					if($msg == 3)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to remove vat code</li></ul></div>' ;
					}
				}
                ?>
                <div class='block-content'>
					
                    <table id='table-example' class='table'>
						<thead>
                        	<tr>
                            	<th class='center'>VAT Code</th>
                                <th class='center'>Rate</th>
                                <th class='center'>Status</th>
                                <th class='center'>Action</th>
							</tr>
						</thead>
						<?php if($vat_codes) { ?>
                        <tbody>
                        	<?php foreach($vat_codes as $rec) : ?>
                            <tr class='gradeX'>
								<td class='center'><?php echo $rec->vat_code ; ?></td>
                                <td class='center'><?php echo $rec->vat_rate ; ?></td>
                                <td class='center'><?php echo $rec->status ; ?></td>
								<td class='center'>&nbsp;<a href="<?php echo base_url("settings/remove_vat_rates/".$rec->id) ; ?>" onclick="return confirm('Are you sure to delete this record?')" ><img title="Remove Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a></td>
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
		<div class='grid_12'><h1>Add New VAT Rates</h1></div>
		<div class='grid_12'>
        	<div class='block-border'>
				<div class='block-header'><h1>VAT Rates</h1><span></span></div>
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
							echo '<div class="error_msg"><ul><li>Failed to Add VAT Code</li></ul></div>' ;
						}
					}
				?>
                <form id="vat_code_form" class="block-content form" action="<?php echo base_url("settings/add_vat_code") ; ?>" method="post">
                	<fieldset>
                    	<legend>VAT Code</legend>
						
						<div class='_50'><p><label for="vat_code">VAT Code</label><input type="text" id="vat_code" name="vat_code" value="<?php echo set_value("vat_code") ; ?>" /></p></div>
                        
                        <div class='_50'><p><label for="vat_rate">VAT Rate (%)</label><input type="text" id="vat_rate" name="vat_rate" value="<?php echo set_value("vat_rate") ; ?>" /></p></div>
                        
						<div class='_50'><p><span class="vat_code_status">Status</span><select id="vat_code_status" name="vat_code_status"><option value="Active" <?php echo set_select('vat_code_status', 'Active', TRUE); ?>>Active</option><option value="Disable" <?php echo set_select('vat_code_status', 'Disable'); ?>>Disable</option></select></p></div>
					
					</fieldset>
                    <div class='block-actions'>
						<ul class='actions-left'><li><a id="clear_form" class="close-toolbox button red" href="javascript:void(0);">Clear Form</a></li></ul>
                        <ul class='actions-right'>
                        	<li><a id="submit_form" class="close-toolbox button" href="javascript:void(0);">Add VAT Code</a></li>
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
			$("#vat_code").val("") ;
			$("#vat_rate").val("") ;
			$("#vat_code_status").val("Active") ;
			$("#uniform-vat_code_status span").html("Active") ;
		}) ;
		
		$("#cancel_form").click(function(){
			window.location.href = "<?php echo base_url("customer") ; ?>" ;
		}) ;
		
		$("#submit_form").click(function(){
			$("#vat_code_form").submit() ;
		}) ;
		
	}) ;
	</script>
	
</div> <!-- end of #main-content -->