<div id="right">
<?php
	$flag = 1 ;
	
	if($tatal_groups > 0)
	{ 
		for ($i=1; $i <= $tatal_groups; $i++)
		{
			$previous = "" ;
			
			foreach($products[$i] as $rec): 
			
			if($previous != $rec->group_name)
			{
?>
				<div class="section">
				<div class="box"><div class="title"><?php echo $rec->group_name ; ?><span class="hide"></span></div>
				<div class="content">
				<?php
					if(($rec->product_name == "") && ($rec->product_code == "") && ($rec->adl_code == "") && ($rec->new_price == "") && ($rec->product_price == "") && ($rec->product_manual == ""))
					$flag = 0 ;
					
					if($flag)
					{
				?>
                		<table cellspacing="0" cellpadding="0" border="0"> 
						<thead> 
							<tr>
                                <th>Product Name</th>
                                <th>Product Code</th>
                                <th>ADL Code</th>
                                <th>Price (&pound;)</th>
                                <th>Manual</th>
                            </tr>
                        </thead>
                        <tbody>
				<?php
					}
			}
			
			if($flag)
			{
			?>
            			<tr>
                            <td><?php echo $rec->product_name ; ?></td>
                            <td><?php echo $rec->product_code ; ?></td>
                            <td><?php echo $rec->adl_code ; ?></td>
                            <td><?php if($rec->new_price == "") { echo get_decimal_number_format($rec->product_price) ; } else { echo get_decimal_number_format($rec->new_price) ; } ?></td>
                            <?php if($rec->product_manual != "") { ?>
                            <td><a href="<?php echo base_url("products/download_manual/".$rec->product_id) ; ?>"><img title="Download Manual" src="<?php echo base_url("gfx/icons/small/drive-download.png") ; ?>" /></a></td>
                        	<?php } else { ?>
                            <td><a onclick="alert('Currently manual not available');" href="javascript:void(0);"><img title="Download Manual" src="<?php echo base_url("gfx/icons/small/drive-download.png") ; ?>" /></a></td>
                            <?php } ?>
                        </tr>
			<?php
			}
			
			$previous = $rec->group_name ;
			
			endforeach ;
			
			if($flag)
				echo '</tbody></table>' ;
			if($flag == 0)
				echo '<h5>There are no products in this category</h5>' ;
			 
    		echo '</div></div>' ;
	 		
			$falg = 1 ;
		}
	}
?>   
</div>