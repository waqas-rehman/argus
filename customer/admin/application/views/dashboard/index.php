<?php
	
	?>
<div id="main-content">
	<div class="container_12">
		<div class="grid_12"><h1>Dashboard</h1></div>
		<div class='grid_12'>
			<div class='block-border'>
				<div class='block-header'><h1>Current Orders</h1><span></span></div>
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
						<?php if($orders) { ?>
                        <tbody>
                        	<?php foreach($orders as $rec) : ?>
                            <tr class='gradeX'>
                            	<td class='center'><a href="<?php echo base_url("orders/order_details/".$rec->id) ; ?>"><?php echo $rec->purchase_order_number ; ?></a></td>
                                <td class='center'><?php echo $rec->status ; ?></td>
                                <td class='center'><?php echo date("d/m/Y", strtotime($rec->order_date)) ; ?></td>
                                <td class='center'>
                                	&nbsp;<a href="<?php echo base_url("orders/edit_status/".$rec->id."/0") ; ?>"><img title="Edit Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/pencil.png") ; ?>" /></a>
                                    &nbsp;<a href="<?php echo base_url("product/remove_product/".$rec->id) ; ?>" onclick="return confirm('Are you sure to delete this record?')" ><img title="Remove Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
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


		
		<div class='grid_12'>
			<div class='block-border'>
				<div class='block-header'><h1>Overdue Invoices</h1><span></span></div>
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

            	<div class='block-content'>
					<table id='table-example' class='table'>
						<thead>
                        	<tr>
                            	<th width="20%" class='center'>Purchase Order Number</th>
								<th width="20%" class='center'>Company Name</th>
                                <th width="20%" class='center'>Status</th>
                                <th width="30%" class='center'>Due Date</th>
                                <th width="20%" class='center'>Action</th>
							</tr>
						</thead>
						<?php if($Invoices) { ?>
                        <tbody>
                        	<?php foreach($Invoices as $rec) : ?>
							<?php 
								$date_diff = date_func2($rec->invoice_date,  $rec->overdue_days) ;
								if($date_diff > 0){
							 ?>
                            <tr class='gradeX'>
                            	<td class='center'><?php echo $rec->purchase_order_number ; ?></a></td>
								<td class='center'><?php echo $rec->company_name ; ?></td>
                                <td class='center'><?php echo $rec->status ; ?></td>
                                <td><?php date_func($rec->invoice_date,  $rec->overdue_days) ; ?></td>
                                <td class='center'>
                                	&nbsp;<a href="<?php echo base_url("orders/edit_status/".$rec->id."/0") ; ?>"><img title="Edit Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/pencil.png") ; ?>" /></a>
                                    &nbsp;<a href="<?php echo base_url("product/remove_product/".$rec->id) ; ?>" onclick="return confirm('Are you sure to delete this record?')" ><img title="Remove Record" src="<?php echo base_url("img/icons/packs/fugue/16x16/cross-script.png") ; ?>" /></a>
                              	</td>
							</tr>
                            <?php } endforeach ; ?>
 						</tbody>
						<?php } ?>
                
				</table>
			<div class="block-actions">
			<div class="dataTables_info1" id="table-example_info">Showing 1 to 2 of 2 entries</div>
			<div class="dataTables_paginate1 paging_full_numbers" id="table-example_paginate">
			<span class="first paginate_button paginate_button_disabled" id="table-example_first">First</span>
			<span class="previous paginate_button paginate_button_disabled" id="table-example_previous">Previous</span>
			<span><span class="paginate_active">1</span></span>
			<span class="next paginate_button paginate_button_disabled" id="table-example_next">Next</span>
			<span class="last paginate_button paginate_button_disabled" id="table-example_last">Last</span>
			</div>
			</div>		
                </div>
				
			</div>
		
		
		
		</div>
		
		<div class="clear height-fix"></div>
	

		<div class='grid_12'>
			<div class='block-border'>
				<div class='block-header'><h1>Customers List</h1><span></span></div>
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
                                <th width="10%" class='center'>Account Balance</th>
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
                                <td class='center'><?php echo abs($rec->balance) ; ?></td>
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
					<div class="block-actions">
			<div class="dataTables_info1" id="table-example_info">Showing 1 to 2 of 2 entries</div>
			<div class="dataTables_paginate1 paging_full_numbers" id="table-example_paginate">
			<span class="first paginate_button paginate_button_disabled" id="table-example_first">First</span>
			<span class="previous paginate_button paginate_button_disabled" id="table-example_previous">Previous</span>
			<span><span class="paginate_active">1</span></span>
			<span class="next paginate_button paginate_button_disabled" id="table-example_next">Next</span>
			<span class="last paginate_button paginate_button_disabled" id="table-example_last">Last</span>
			</div>
			</div>
                  </div>
				  
			</div>
		</div>
		<div class="clear height-fix"></div>
		
		
		
		</div>
	</div> <!--! end of #main-content -->


<?php
	function date_func($invoice_date, $overdue_days)
	{
		$overdue_date =  date("Y-m-d", strtotime($invoice_date . "+".(intval($overdue_days))." day")) ;
		echo date("d/m/Y", strtotime($overdue_date)) ;
		$diff = intval(get_date_diff(date("Y-m-d"), $overdue_date)) ; 
		
		if($diff == 0)
			echo "" ;
		elseif($diff > 0)
			echo "<br />Overdue by ".$diff." day(s)" ;
		//elseif($diff < 0)
			//echo "Overdue since".($diff * (-1))." day(s)" ;
	}
	
	function date_func2($invoice_date, $overdue_days)
	{
		 $overdue_date =  date("Y-m-d", strtotime($invoice_date . "+".(intval($overdue_days))." day"))."<br />" ;
		//$overdue_date = "2012-11-01";
		$diff = intval(get_date_diff(date("Y-m-d"), $overdue_date)) ; 
		
		return $diff;
	}

?>