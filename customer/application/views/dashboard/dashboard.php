<div id="right">
	<div class="section">
		<div class="third">
			<div class="box">
				<div class="title">Account Balance<span class="hide"></span></div>
				<div class="content">
					<?php
                        $flag1 = 0 ;
						$flag2 = 0 ;
						if($orders)
                        {
                            foreach($orders as $rec) :
                                $date_dffierece = date_func2($rec->invoice_date,  $customer_rec->overdue_days) ;
                                if($date_dffierece > 0) { echo '<h6 style="color:#FF0000"> &pound; '.get_decimal_number_format(abs($customer_rec->balance)).'</h6>' ; $flag1 = 1 ; break ; }
                                else { echo '<h6 style="color:#000000"> &pound; '.get_decimal_number_format(abs($customer_rec->balance)).'</h6>' ; $flag2 = 1 ; }
                            endforeach ;
                        }
						if(!$flag1 && !$flag2)
							echo '<h6 style="color:#000000"> &pound; '.get_decimal_number_format(abs($customer_rec->balance)).'</h6>' ;
                    ?>
				</div>
			</div>
		</div>
		<div class="third">
			<div class="box">
				<div class="title">Credit Limit<span class="hide"></span></div>
				<div class="content">
					<h6 style="color:#000000">&pound; <?php echo $customer_rec->maximum_limit ; ?></h6></div>
				</div>
			</div>
		</div>
	
    <div class="section">
		<div class="box"><div class="title">Current Orders<span class="hide"></span></div>
		<div class="content">
			<table cellspacing="0" cellpadding="0" border="0"> 
				<thead> 
					<tr>
						<th>Purchase Order #</th>
						<th>Order Date</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php if($order_rec) { foreach($order_rec as $rec): ?>
					<tr>
						<td><?php echo $rec->purchase_order_number ; ?></a></td>
						<td><?php echo date("d/m/Y", strtotime($rec->order_date)) ; ?></td>
						<td><?php echo $rec->status ; ?></td>
					</tr>
					<?php endforeach ; } else { ?>
					<tr><td colspan="3" align="center">No record found.</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
    
    <div class="section">
		<div class="box"><div class="title">Outstanding Invoices<span class="hide"></span></div>
		<div class="content">
			<table cellspacing="0" cellpadding="0" border="0"> 
				<thead> 
					<tr>
						<th>Purchase Order#</th>
						<th>Invoiced Date</th>
						<th>Due Date</th>
						<th>Status</th>
						<th>Invoice Amount(&pound) </th>
                        <th>Due Amount(&pound) </th>
					</tr>
				</thead>
				<tbody>
				<?php if($invoice_rec) { foreach($invoice_rec as $rec):	 
				$overdue_date =  date("Y-m-d", strtotime($rec->invoice_date . "+".(intval($customer_rec->overdue_days))." day")) ;
				$t_diff = intval(get_date_diff(date("Y-m-d"),$overdue_date)) ; 
				?>
				<tr <?php if($t_diff > 0) { ?> style="background-color:#FF6A6A;" <?php } ?>>
					<td><?php echo $rec->purchase_order_number ; ?></td>
					<td><?php echo date("d/m/Y", strtotime($rec->invoice_date)); ?></td>
					<td><?php if($t_diff > 0) echo "Overdue by ".$t_diff. " day(s)" ; else echo date("d/m/Y", strtotime($overdue_date)) ; ?></td>
					<td><?php echo $rec->status ; ?></td>
					<td><?php echo get_decimal_number_format($rec->invoice_amount) ; ?></td>
                    <td><?php echo get_decimal_number_format(floatval(get_due_amount($rec->id, $rec->customer_id))) ; ?></td>
				</tr>
				<?php endforeach ; } else { ?>
				<tr><td colspan="6" align="center">No record found.</td></tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
    
    <div class="section">
		<div class="box"><div class="title">Completed Orders<span class="hide"></span></div>
		<div class="content">
			<table cellspacing="0" cellpadding="0" border="0"> 
				<thead> 
					<tr>
						<th>Purchase Order#</th>
						<th>Invoiced Date</th>
						<th>Compeletion Date</th>
						<th>Shipment Date</th>
						<th>Invoice Amount</th>
						
					</tr>
				</thead>
				<tbody>
					<?php if($invoice_complet_rec) { foreach($invoice_complet_rec as $rec):	 ?>
				
				<tr>
					<td><?php echo $rec->purchase_order_number ; ?></td>
					<td><?php echo date("d/m/Y", strtotime($rec->invoice_date)); ?></td>
					<td><?php echo date("d/m/Y", strtotime($rec->compeletion_date)) ; ?></td>
					<td><?php echo date("d/m/Y", strtotime($rec->shipment_date)) ; ?></td>
					<td><?php echo get_decimal_number_format($rec->invoice_amount) ; ?></td>
				</tr>
				<?php endforeach ; } else { ?>
				<tr><td colspan="5" align="center">No record found.</td></tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
    
    
<?php
	function date_func2($invoice_date, $overdue_days)
	{
		$overdue_date =  date("Y-m-d", strtotime($invoice_date . "+".(intval($overdue_days))." day"))."<br />" ;
		//$overdue_date = "2012-11-01";
		$diff = intval(get_date_diff(date("Y-m-d"), $overdue_date)) ; 
		
		return $diff;
	}

		
?>