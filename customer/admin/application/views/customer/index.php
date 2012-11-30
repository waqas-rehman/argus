<div id="main-content">
	<div class="container_12">
		<div class="grid_12"><h1>Customers</h1></div>
		<div class='grid_12'>
			<div class='block-border'>
				<div class='block-header'><h1>Customer List</h1><span></span></div>
				<?php 
				if($msg)
				{
                	if($msg == 1)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Customer record removed successfully</li></ul></div>' ;
					}
					if($msg == 2)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".error_msg").hide();}, 5000);</script>';
						echo '<div class="error_msg"><ul><li>Failed to remove customer record</li></ul></div>' ;
					}
					if($msg == 3)
					{
						echo '<script type="text/javascript">setTimeout(function(){$(".success_msg").hide();}, 5000);</script>';
						echo '<div class="success_msg"><ul><li>Customer Products Prices updated successfully</li></ul></div>' ;
					}
				}
                ?>
                <div class='block-content'>
					
                    <table id='table-example' class='table'>
						<thead>
                        	<tr>
                            	<th width="20%" class='center'>Company Name</th>
                                <th width="20%" class='center'>Contact Person Name</th>
                                <th width="15%" class='center'>Telephone Number</th>
                                <th width="20%" class='center'>User Name</th>
                                <th width="10%" class='center'>Last Login</th>
                                <th width="15%" class='center'>Action</th>
							</tr>
						</thead>
						<?php if($customers) { ?>
                        <tbody>
                        	<?php foreach($customers as $rec) : ?>
                            <tr class='gradeX'>
                            	<td class='center'><a href="#"><?php echo $rec->company_name ; ?></a></td>
                                <td class='center'><?php echo $rec->contact_person_name ; ?></td>
                                <td class='center'><?php echo $rec->telephone_number ; ?></td>
                                <td class='center'><?php echo $rec->username ; ?></td>
                                <td class='center'><?php if($rec->last_login != "0000-00-00 00:00:00") echo date("d/m/Y g:i a", strtotime($rec->last_login)) ; ?></td>
								<td class='center'>
                                	&nbsp;<a href="<?php echo base_url("customer/product_prices_form/".$rec->id) ; ?>"><img title="Add/Update Product Prices" src="<?php echo base_url("img/icons/packs/fugue/16x16/block.png") ; ?>" /></a>
                                    &nbsp;<a href="<?php echo base_url("customer/email_form/".$rec->id) ; ?>"><img title="Send Email" src="<?php echo base_url("img/icons/packs/fugue/16x16/mail-send.png") ; ?>" /></a>
                                    &nbsp;<a href="<?php echo base_url("customer/customer_details/".$rec->id."/0") ; ?>"><img title="Edit Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/pencil.png") ; ?>" /></a>
                                    &nbsp;<a href="<?php echo base_url("customer/remove_customer/".$rec->id) ; ?>" onclick="return confirm('Are you sure to delete this record?')" ><img title="Remove Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
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