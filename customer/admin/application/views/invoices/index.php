<div id="main-content">
	<div class="container_12">
		<div class="grid_12"><h1>Order Invoices</h1></div>
		<div class='grid_12'>
			<div class='block-border'>
				<div class='block-header'><h1>Invoiced Orders List</h1><span></span></div>
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
                <form class="block-content form">
				<fieldset>
					<legend>Important Information</legend>
                    	<br />
						<b>Click on the Edit Icon to change order invoices</b></p></div>
				</fieldset>
                </form>
            	<div class='block-content'>
					<table id='table-example' class='table'>
						<thead>
                        	<tr>
                            	<th width="20%" class='center'>Purchase Order Number</th>
                                <th width="20%" class='center'>Status</th>
                                <th width="30%" class='center'>Submission Date</th>
                                <th width="20%" class='center'>Action</th>
							</tr>
						</thead>
						<?php if($invoices) { ?>
                        <tbody>
                        	<?php foreach($invoices as $rec) : ?>
                            <tr class='gradeX'>
                            	<td class='center'><?php echo $rec->purchase_order_number ; ?></td>
                                <td class='center'><?php echo $rec->status ; ?></td>
                                <td class='center'><?php echo date("d/m/Y", strtotime($rec->order_date)) ; ?></td>
                                <td class='center'>
                                	&nbsp;<a href="<?php echo base_url("invoices/upload_invoice/".$rec->id."/0") ; ?>">
                                    		<img title="Edit Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/pencil.png") ; ?>" />
                                          </a>
                                    &nbsp;<a href="<?php echo base_url("invoices/download_manual/".$rec->id."/index") ; ?>">
                                    		<img title="Download Invoice" src="<?php echo base_url("img/icons/packs/fugue/16x16/drive-download.png") ; ?>" />
                                          </a>
                                	&nbsp;<a href="<?php echo base_url("invoices/remove_order_invoice/".$rec->id."/index") ; ?>" onclick="return confirm('Are you sure to remove this invoice?')" ><img title="Delete Invoice" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
                              	
                                
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
</div> <!--! end of #main-content -->