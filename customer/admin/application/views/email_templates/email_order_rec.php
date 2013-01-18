<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Argus Distribution</title>
	</head>

	<body>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
            	<td align="center" valign="top"  style="background-color:white;">
            		<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    	<tr>
               				<td width="73%" align="left" valign="middle" style="padding:10px;"><h1></h1></td>
                    		<td width="27%" align="left" valign="middle" style="padding:10px;"><img src="<?php echo base_url() ; ?>gfx/logo_argus.png" width="204" height="13%" align="right" style="display:block"></div></td>
                    	</tr>
                  	</table>
                  	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-bottom:15px;">
                    	<tr>
                      		<td width="656" height="auto" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#4e4e4e; font-size:13px; padding:10px;">
                            <strong>Dear <?php echo $contact_person_name; ?>,</strong>
                            <p>Order Ref: <?php echo $po_number; ?>. Thank you for your order. We are now processing it and you will receive another email to confirm that it has been accepted.</p>
                            </td>
                        </tr>
                    </table>
                    
                    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="margin-bottom:60px;">
            			<thead>
							<tr>
                                <th>Purchase Order No.</th>
                                <th>Company Name</th>
                                <th>Submission Date</th>
                                <th>Delivery Address</th>
                			</tr>
						</thead>
						
                        <tbody>
							<tr>
                                <td align="center"><?php echo $po_number; ?></td>
                                <td align="center"><?php echo $client_name; ?></td>
                                <td align="center"><?php echo date("d/m/Y", strtotime($creation_date)); ?></td>
                                <td align="justify"><?php echo $delivery_address; ?></td>
                            </tr>
						</tbody>
              		</table>
			  
			  
			  
			  <!-- Start from here -->
                    <table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" style="margin-bottom:60px;">
                    	<thead> 
							<tr>
								<th>Product Group</th>
                                <th>ADL Code - Product Code</th>
                                <th>Quantity</th>
                                <th>Unit Price (&pound;)</th>
                                <th>Total Price (&pound;)</th>
                            </tr>
                        </thead>
						<tbody>
							<?php
								$temp_sub_total = 0 ;
								$temp_vat_tax = 0 ; 
								if($products_rec) { $x = 1 ; foreach($products_rec as $rec):
							?>
                        <tr>
							<td><?php echo $rec->product_group ; ?></td>
							<td><?php echo $rec->product_name. " - ".$rec->product_code. " - ".$rec->product_adl_code ; ?></td>
							<td><?php echo $rec->product_quantity ; ?></td>
                            <td><?php echo number_format($rec->product_price, 2 , ".", ",") ; ?></td>
                            <td>
								<?php
									echo number_format(($rec->product_price) * ($rec->product_quantity), 2 , ".", ",") ;
									$temp_sub_total = $temp_sub_total + floatval(($rec->product_price) * ($rec->product_quantity)) ;
									$temp_vat_tax = $temp_vat_tax + floatval((($rec->vat_rate)/100) * ($rec->product_price) * ($rec->product_quantity)) ;
								?>
                            </td>
						</tr>
						<?php $x = $x + 1 ; endforeach ; } ?>
                        
                        <tr id="last5">
                        	<td colspan="4" style="text-align:right !important;">Delivery Charges</td>
                            <td id="sub_total_transpotation_charges">
								<?php
									$transport_charges = floatval(0.00) ;
									if($temp_sub_total <= $customer_rec->maximum_limit)
										$transport_charges = $customer_rec->transport_charges ;
										
									echo number_format(($transport_charges), 2 , ".", ",") ;
								?>
                            </td>
                        </tr>
                            
                        <tr id="last2"><td colspan="4" style="text-align:right !important;">Sub Total Amount: </td><td id="sub_total"><?php echo number_format(($temp_sub_total + $transport_charges), 2 , ".", ",") ; ?></td></tr>
                        <tr id="last3"><td colspan="4" style="text-align:right !important;">VAT Code: </td><td id="vat-code"><?php echo $vat_rec->vat_code ; ?></td></tr>
                        <?php $temp_vat_tax = $temp_vat_tax + ($transport_charges * (floatval($vat_rec->vat_rate)/100)) ; ?>
                        <tr id="last4"><td colspan="4" style="text-align:right !important;">VAT</td><td id="sub_total_vat"><?php echo number_format(($temp_vat_tax), 2 , ".", ",") ; ?></td></tr>
                        
                        <tr id="last6"><td colspan="4" style="text-align:right !important;">Total</td><td id="total_plus_vat"><?php echo  number_format(($temp_vat_tax + $temp_sub_total + $transport_charges), 2 , ".", ",")  ; ?></td></tr>
                    </tbody>
				</table>

             <!-- End here -->
				<table width="100%" border="0" align="Right" cellpadding="0" cellspacing="0" style="margin-bottom:15px;">
            		<tr>
              			<td width="656" height="auto" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#4e4e4e; font-size:13px; padding:10px;"><strong>Kind regards,</strong><p>Argus Distribution Limited</p></td>
                        <td width="172" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; color:#4e4e4e; font-size:13px; padding:10px;"></td>
             		</tr>
            		
                    <tr>
              			<td height="80" colspan="2" align="left" valign="middle" style="font-family:Arial, Helvetica, sans-serif; color:#000000; font-size:13px; padding:10px; text-align: center;margin:0;">
                        	<p>
                            	<strong>Argus Distribution Limited, Unit 12, Canal Bridge Enterprise Centre, Meadow Lane, Ellesmere Port CH65 4EH</strong>
                                <br/>
                                <strong><span style="color:#333;"> Tel: +44(0)844 678 0088  Fax: +44(0)844 678 0077  Email: <a href="mailto:sales@argusdistribution.co.uk">sales@argusdistribution.co.uk</a> Web: <a href="http://www.argusdistribution.co.uk/" target="_blank">www.argusdistribution.co.uk</a></span></strong>
                                <br/>
              					<span style="color:#333333;">Incorporated in England and Wales Number 07001769     VAT Registration Number GB 10139365<br/>Registered Address: Dunvegan, Chester High Road, Neston, Cheshire CH64 3TH</span>
                          	</p>
                  		</td>
            		</tr>
				</table>
          </td>
      </tr>
      </table>
   </td>
  </tr>
</table>
</body>
</html>
