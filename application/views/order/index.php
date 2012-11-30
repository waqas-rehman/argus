<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Orders<span class="hide"></span></div>
			<div class="content">
				<?php
					if($msg)
					{
						if($msg == 1)
							echo '<div class="message green"><span>Record Deleted Successfully</span></div>' ;
						if($msg == 2)
							echo '<div class="message red"><span>Failed to Deleted Records</span></div>' ;
					} 
				?>
				<?php if($orders) { ?>
                <table cellspacing="0" cellpadding="0" border="0" class="all"> 
					<thead> 
						<tr>
							<th>Purchase Order #</th>
							<th>Status</th>
							<th>Creation Date</th>
                            <th>Action</th>
						</tr>
					</thead>
				    <tbody>
						<?php foreach($orders as $rec): ?>
                        <tr>
							<td><?php echo $rec->purchase_order_number ; ?></td>
							<td><?php echo $rec->status ?></td>
							<td><?php echo date("d/m/Y g:i a", strtotime($rec->creation_date)) ; ?></td>
							<td>
                            	<?php if($rec->status == "Pending") { ?>
                                	<a href="<?php echo base_url("orders/order_detail/".$rec->id) ; ?>">View</a>&nbsp;
                           			<a onclick="return confirm('Are you sure to remove this order completely?');" href="<?php echo base_url("orders/delete_order/".$rec->id) ; ?>">Remove</a>
								<?php } else { ?>
                                	<a href="<?php echo base_url("orders/general_order_details/".$rec->id) ; ?>">View</a>&nbsp;
                                <?php } ?>
                                
                            </td>
                        </tr>
                        <?php endforeach ; ?>
					</tbody>
				</table>
                <?php } else { ?>
                	<h4>Currently No Order is added by you. <a href="<?php echo base_url("orders/order_form") ; ?>">Click here</a> to add.</h4>
				<?php } ?>
			</div>
		</div>
	</div>
</div>