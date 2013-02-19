<div id="right">
	<div class="section">
    	<div class="box"><div class="title">Customer Transactions<span class="hide"></span></div>
			<?php
				$global_amount = 0 ;
				$last_timestamp = "" ;
				if($orders)
				{
			?>
			<div class="content">
            <table cellspacing="0" cellpadding="0" border="0"> 
            	<thead> 
                	<tr>
                    	<th>Invoice No.</th>
                        <th>PO Num.</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
				<?php	
					foreach($orders as $rec1): 
					$global_amount = $global_amount + $rec1->invoice_amount ;
					$amount_rec = $this->model2->get_large_payments($this->session->userdata("customer_id"), $rec1->invoice_date, $last_timestamp) ;
					large_amount($amount_rec) ;
					$last_timestamp = $rec1->invoice_date ;
				?>
					<tr>
                        
                        <td><a style="text-decoration:none;" href="<?php echo base_url("invoices") ; ?>"><?php echo $rec1->id ; ?></a></td>
                        <td><?php echo $rec1->purchase_order_number ; ?></td>
                        <td>Invoice</td>
                        <td><?php echo "&pound;".get_decimal_number_format($rec1->invoice_amount) ; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($rec1->invoice_date)) ; ?></td>
                        <td><?php echo "&pound;".get_decimal_number_format($global_amount) ; ?></td>
                    </tr>
				<?php
					$transactions = $this->model2->get_customer_transactions($this->session->userdata("customer_id"), $rec1->id) ;
					if($transactions) { foreach($transactions as $rec):
					
					$amount_rec = $this->model2->get_large_payments($this->session->userdata("customer_id"), $rec->timestamp, $last_timestamp) ;
					large_amount($amount_rec) ;
					$last_timestamp = $rec->timestamp ;
				?>
                    <tr>
                        
                        <td><a style="text-decoration:none;" href="<?php echo base_url("orders/general_order_details/".$rec->order_id) ; ?>"><?php echo $rec->order_id ; ?></a></td>
                        <td><?php echo $rec->purchase_order_number ; ?></td>
                        <td>
                            <?php
                                if($rec->transaction_type == "Credit_Note") { echo "Credit Note" ; $global_amount = $global_amount - $rec->transaction_amount;}
                                elseif($rec->transaction_type == "Payment") { echo "Payment" ; $global_amount = $global_amount - $rec->transaction_amount ; }
                                elseif($rec->transaction_type == "Add_Back") { echo "Reversal" ; $global_amount = $global_amount + $rec->transaction_amount ; }
                            ?>
                        </td>
                        <td><?php echo "&pound;".get_decimal_number_format($rec->transaction_amount) ; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($rec->timestamp)) ; ?></td>
                        <td><?php echo "&pound;".get_decimal_number_format($global_amount) ; ?></td>
                    </tr>
                    
                    <?php
					endforeach ;
				}
			endforeach ;
			
		echo '</tbody></table></div>' ;  }
	?>
	</div>
    
    <center><h1>Net Balance of Your Account: <?php echo "&pound;".get_decimal_number_format($global_amount) ; ?></h1></center>
    
    <?php
		function large_amount($amount_rec)
		{
			if($amount_rec)
			{
				foreach($amount_rec as $rec2):
	?>	
    	<tr>
        	<td></td>
            <td></td>
            <td>Large Amount</td>
            <td><?php echo "&pound;".get_decimal_number_format($rec2->transaction_amount) ; ?></td>
            <td><?php echo date("d/m/Y", strtotime($rec2->timestamp)) ; ?></td>
            <td></td>
		</tr>
                    
	<?php
				endforeach ;
			}
		}
	?>