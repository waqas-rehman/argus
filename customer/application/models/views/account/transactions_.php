<div id="right">

    <div class="section">
		<div class="box"><div class="title">Customer Transactions<span class="hide"></span></div>
		<?php
			$global_amount = 0 ;
			if($orders)
			{
				foreach($orders as $rec1): ?>
            	<h2>&nbsp;&nbsp;&nbsp;&nbsp;Order Id: <?php echo $rec1->id ; ?>, Invoice Amount: <?php echo "&pound;".$rec1->invoice_amount ; $global_amount = $global_amount + $rec1->invoice_amount ; ?>, Order Status: <?php echo $rec1->status ; ?> </h2>
                <?php
					$transactions = $this->model2->get_customer_transactions($this->session->userdata("customer_id"), $rec1->id) ;
					$local_amount = 0 ;
				?>
                <div class="content">
                <table cellspacing="0" cellpadding="0" border="0"> 
                    <thead> 
                        <tr>
                            <th>Id</th>
                            <th>Order Id</th>
                            <th>PO Num.</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($transactions) { foreach($transactions as $rec):	 ?>
                    
                    <tr>
                        <td><?php echo $rec->id ; ?></td>
                        <td><a style="text-decoration:none;" href="<?php echo base_url("orders/general_order_details/".$rec->order_id) ; ?>"><?php echo $rec->order_id ; ?></a></td>
                        <td><?php echo $rec->purchase_order_number ; ?></td>
                        <td>
                            <?php
                                if($rec->transaction_type == "Credit_Note") { echo "Credit Note" ; $local_amount = $local_amount - $rec->transaction_amount ; }
                                elseif($rec->transaction_type == "Payment") { echo "Payment" ; $local_amount = $local_amount - $rec->transaction_amount ; }
                                elseif($rec->transaction_type == "Add_Back") { echo "Reversal" ; $local_amount = $local_amount + $rec->transaction_amount ; }
                            ?>
                        </td>
                        <td><?php echo "&pound;".$rec->transaction_amount ; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($rec->timestamp)) ; ?></td>
                    </tr>
                    <?php endforeach ; ?>
                    <tr><td colspan="4" style="text-align:right;"><?php echo '<h3>Net Amount Received: </h3> ' ; ?></td><td style="text-align:right;"><h3><?php echo "&pound;".(-1)*$local_amount ; $global_amount = $global_amount + $local_amount ; ?></h3></td><td></td></tr>
					<?php } else { ?>
                    <tr><td colspan="4" style="text-align:right;"><?php echo '<h3>Net Amount Received: </h3> ' ; ?></td><td style="text-align:right;"><h3><?php echo "&pound;".(-1)*$local_amount ; $global_amount = $global_amount + $local_amount ; ?></h3></td><td></td></tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            
        <?php
				endforeach ;
			}
		?>
	</div>
    
    <center><h1>Net Balance of Your Account: <?php echo "&pound;".$global_amount ; ?></h1></center>