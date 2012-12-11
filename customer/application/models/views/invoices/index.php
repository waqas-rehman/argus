<div id="right">
	<div class="section">
		<div class="box">
			<div class="title">Invoices<span class="hide"></span></div>
			<div class="content">
				<?php
					if($msg)
					{
						if($msg == 1) echo '<div class="message green"><span>Record Deleted Successfully</span></div>' ;
						if($msg == 2) echo '<div class="message red"><span>Failed to Deleted Records</span></div>' ;
					} 
				?>
				<?php if($orders) { ?>
                <table cellspacing="0" cellpadding="0" border="0" class="all"> 
					<thead> 
						<tr>
							<th>Purchase Order #</th>
							<th>Status</th>
							<th>Due Date</th>
                            <th>Action</th>
						</tr>
					</thead>
				    <tbody>
						<?php foreach($orders as $rec): ?>
						
                        <tr <?php if($rec->status == "Outstanding") { ?> style="background-color:#FF6A6A;" <?php } ?>>
							<td><?php echo $rec->purchase_order_number ; ?></td>
							<td><?php echo $rec->status ?></td>
							<td><?php date_func2($rec->invoice_date, $customer_rec->overdue_days) ; ?></td>
							<td>
								<a href="<?php echo base_url("invoices/download_manual/".$rec->id) ; ?>"><img title="Download File" src="<?php echo base_url("gfx/icons/small/drive-download.png") ; ?>" /></a>    
                            </td>
                        </tr>
                        <?php endforeach ; ?>
					</tbody>
				</table>
                <?php } else { ?>
                	<h4>No invoices are available to view. <a href="<?php echo base_url("orders/order_form") ; ?>">Click here</a> to create a new order.</h4>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php
	function date_func2($invoice_date, $overdue_days)
	{
		$overdue_date =  date("Y-m-d", strtotime($invoice_date . "+".(intval($overdue_days))." day")) ;
		$diff = intval(get_date_diff(date("Y-m-d"), $overdue_date)) ; 
		if ($diff <= 0)
			echo date("d/m/Y", strtotime($overdue_date)) ;
		if ($diff > 0 )
			echo "Overdue by ".$diff. " day(s)" ;
	}
?>