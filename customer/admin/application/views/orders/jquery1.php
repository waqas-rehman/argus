<style type="text/css">
	.date-div{ display:none; }
</style>

<script type="application/javascript">
$(function(){
	$(".datepicker").datepicker({
		inline: true,
		dateFormat: "dd/mm/yy"
	});
	
	$(".invoice_date_label").datepicker({
		inline: true,
		dateFormat: "dd/mm/yy",
    	onClose: function(dateText, inst)
		{ 
      		var invoice_date = dateText.replace("/","-") ;
			invoice_date = invoice_date.replace("/","-") ;
			
			var customer_id = $("#customer_id").val() ;
			
			var data1 = "invoice_date="+invoice_date+"&customer_id="+customer_id ;
			var html_data = "" ;
			
			$.ajax
			({
				type:"POST",
			   async:false,
				 url:"<?php echo base_url("invoices/get_outstanding_date") ; ?>",
				data:data1,
			 success:function(msg) { html_data = msg ; }
			});
			
			var order_status = $("#order_status").val() ;
			
			if(html_data != "fail" && (order_status == "Outstanding" || order_status == "Completed")) $("#outstanding_date").val(html_data) ;
			else { return true ; }
		}
	});
});

$(function(){
	$("#order_status").live('change', function(){
		var order_status = $("#order_status option:selected").val() ;
		$("#dates_message").css("display","block") ;
		
		if(order_status == "Pending")
		{
			$("#temp_order_status").val("Pending") ;
			$("#creation_date_div").css("display","block") ;
			$("#order_date_div").css("display","none") ;
			$("#acceptance_date_div").css("display","none") ;
			$("#shipment_date_div").css("display","none") ;
			$("#invoice_date_div").css("display","none") ;
			$("#outstanding_date_div").css("display","none") ;
			$("#compeletion_date_div").css("display","none") ;
		}
		
		if(order_status == "Ordered")
		{
			$("#temp_order_status").val("Ordered") ;
			$("#creation_date_div").css("display","block") ;
			$("#order_date_div").css("display","block") ;
			$("#acceptance_date_div").css("display","none") ;
			$("#shipment_date_div").css("display","none") ;
			$("#invoice_date_div").css("display","none") ;
			$("#outstanding_date_div").css("display","none") ;
			$("#compeletion_date_div").css("display","none") ;
		}
							
		if(order_status == "Accepted")
		{
			$("#temp_order_status").val("Accepted") ;
			$("#creation_date_div").css("display","block") ;
			$("#order_date_div").css("display","block") ;
			$("#acceptance_date_div").css("display","block") ;
			$("#shipment_date_div").css("display","none") ;
			$("#invoice_date_div").css("display","none") ;
			$("#outstanding_date_div").css("display","none") ;
			$("#compeletion_date_div").css("display","none") ;
		}
		
		if(order_status == "Shiped")
		{
			$("#temp_order_status").val("Shiped") ;
			$("#creation_date_div").css("display","block") ;
			$("#order_date_div").css("display","block") ;
			$("#acceptance_date_div").css("display","block") ;
			$("#shipment_date_div").css("display","block") ;
			$("#invoice_date_div").css("display","none") ;
			$("#outstanding_date_div").css("display","none") ;
			$("#compeletion_date_div").css("display","none") ;	
		}
							
		if(order_status == "Invoiced")
		{
			$("#temp_order_status").val("Invoiced") ;
			$("#creation_date_div").css("display","block") ;
			$("#order_date_div").css("display","block") ;
			$("#acceptance_date_div").css("display","block") ;
			$("#shipment_date_div").css("display","block") ;
			$("#invoice_date_div").css("display","block") ;
			$("#outstanding_date_div").css("display","none") ;
			$("#compeletion_date_div").css("display","none") ;
		}
		
		if(order_status == "Outstanding")
		{
			$("#temp_order_status").val("Outstanding") ;
			$("#creation_date_div").css("display","block") ;
			$("#order_date_div").css("display","block") ;
			$("#acceptance_date_div").css("display","block") ;
			$("#shipment_date_div").css("display","block") ;
			$("#invoice_date_div").css("display","block") ;
			$("#outstanding_date_div").css("display","block") ;
			$("#compeletion_date_div").css("display","none") ;
		}
							
		if(order_status == "Completed")
		{
			$("#temp_order_status").val("Completed") ;
			$("#creation_date_div").css("display","block") ;
			$("#order_date_div").css("display","block") ;
			$("#acceptance_date_div").css("display","block") ;
			$("#shipment_date_div").css("display","block") ;
			$("#invoice_date_div").css("display","block") ;
			$("#outstanding_date_div").css("display","block") ;
			$("#compeletion_date_div").css("display","block") ;
		}
	}) ;
}) ;
</script>