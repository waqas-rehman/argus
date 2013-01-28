<?php
class Model2 extends CI_Model
{
	public function get_products_ajax($group_id, $customer_id)
	{
		$q1 = "(SELECT products.id as product_id, products.group_id as group_id, products.product_name as product_name, products.product_code as product_code, products.adl_code as adl_code, products.product_price as product_price, products.product_manual as product_manual, products.product_description as product_description, products.creation_date as creation_date, products.update_date as update_date, products.status as status, product_groups.group_name as group_name 
		FROM product_groups INNER JOIN products ON product_groups.id = products.group_id 
		WHERE product_groups.id = ".$group_id." AND products.status = 'Active') AS Group_Products" ;
		
		$q2 = "(SELECT customer_products.customer_id as customer_id, customer_products.product_id as product_id, customer_products.product_price as new_product_price FROM customer_products WHERE customer_products.customer_id = ".$customer_id.") AS Customer_Products" ;
		
		$q = "SELECT Group_Products.product_id as product_id, Group_Products.group_id as group_id, Group_Products.product_name as product_name, Group_Products.product_code as product_code, Group_Products.adl_code as adl_code, Group_Products.product_price as product_price, Group_Products.product_manual as product_manual, Group_Products.product_description as product_description, Group_Products.creation_date as creation_date, Group_Products.update_date as update_date, Group_Products.status as status, Group_Products.group_name as group_name, Customer_Products.new_product_price as new_product_price FROM ".$q1." LEFT JOIN ".$q2." ON Group_Products.product_id = Customer_Products.product_id WHERE 1" ;
		
		$query = $this->db->query($q) ;
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
				$data[] =  $row ;
			return $data ;
		}
		else 
			 return 0 ;
	}
	
	public function get_group_product_name1($group_id, $product_id)
	{
		$q = "SELECT product_groups.group_name, products.product_name, products.product_code, products.adl_code FROM product_groups INNER JOIN products ON product_groups.id = products.group_id WHERE product_groups.id = ".$group_id." AND products.id = ".$product_id."" ;
		
		$query = $this->db->query($q);
		
		if ($query->num_rows() > 0)
		{		
			$query = $query->result() ;
			return array_pop($query) ;
		}
		else 
			 return 0 ;
	}

	public function get_group_product_name($group_id, $product_id)
	{
		$q = "SELECT product_groups.group_name, products.product_name FROM product_groups INNER JOIN products ON product_groups.id = products.group_id WHERE product_groups.id = ".$group_id." AND products.id = ".$product_id."" ;
		
		$query = $this->db->query($q);
		
		if ($query->num_rows() > 0)
		{		
			$query = $query->result() ;
			return array_pop($query) ;
		}
		else 
			 return 0 ;
	}
	
	public function products($group_id)
	{
		$q = "SELECT * FROM products INNER JOIN product_groups ON products.group_id = product_groups.id WHERE products.status = 'Active' AND product_groups.id = ".$group_id."" ;
		
		$query = $this->db->query($q) ;
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
				$data[] =  $row ;
			return $data ;
		}
		else 
			 return 0 ;
	}
	
	public function customer_products($customer_id, $group_id)
	{	
		$q1 = "(SELECT products.id as id, products.group_id as group_id, products.product_name as product_name, products.product_code as product_code, products.adl_code as adl_code, products.product_price as product_price, products.product_manual as product_manual FROM products WHERE  products.status = 'Active') Product_Table" ;
		
		$q = "SELECT 
				Product_Table.id as product_id, Product_Table.group_id as group_id, Product_Table.product_name as product_name, Product_Table.product_code as product_code, Product_Table.adl_code as adl_code, Product_Table.product_price as product_price, Product_Table.product_manual as product_manual, product_groups.group_name as group_name, customer_products.product_price as new_price
				FROM product_groups LEFT JOIN ".$q1." ON product_groups.id = Product_Table.group_id 
				LEFT JOIN customer_products ON customer_products.product_id = Product_Table.id
				WHERE product_groups.id = ".$group_id."" ;
				
		$query = $this->db->query($q) ;
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
				$data[] =  $row ;
			return $data ;
		}
		else 
			 return 0 ;
	}
	
	public function get_other_products($customer_id)
	{
		$q = "SELECT products.id as product_id, products.group_id as group_id, products.product_name as product_name, products.product_code as product_code, products.adl_code as adl_code, products.product_price as product_price, products.product_manual as product_manual, products.creation_date as creation_date, products.update_date as update_date, products.status as status, product_groups.group_name as group_name FROM products INNER JOIN product_groups ON products.group_id = product_groups.id WHERE products.id NOT IN(SELECT product_id FROM customer_products WHERE customer_products.customer_id = ".$customer_id.")" ;
		
		$query = $this->db->query($q) ;
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] =  $row ;
			}
			return $data ;
		}
		else 
			 return 0 ;
	
	}
	
	public function get_current_products($customer_id)
	{
		$q1 = "(SELECT products.id as product_id, products.group_id as group_id, products.product_name as product_name, products.product_code as product_code, products.adl_code as adl_code, products.product_price as product_price, products.product_manual as product_manual, products.creation_date as creation_date, products.update_date as update_date, products.status as status, product_groups.group_name as group_name FROM products INNER JOIN product_groups ON products.group_id = product_groups.id WHERE 1) AS Product_Table" ;

		$q2 = "(SELECT customers.id as customer_id, customers.company_name as company_name, customers.contact_person_name as contact_person_name, customers.email_address as email_address, customers.telephone_number as telephone_number, customers.address_line_1 as address_line_1, customers.address_line_2 as address_line_2, customers.city as city, customers.country as country, customers.post_code as post_code, customers.special_prices as special_prices, customers.creation_date as creation_date, customers.update_date as update_date, customers.status as status, customer_products.product_id as product_id, customer_products.product_price as new_product_price FROM customers INNER JOIN customer_products ON customers.id = customer_products.customer_id WHERE customers.id = ".$customer_id.") AS Customer_Products" ;
		
		$q = "SELECT * FROM ".$q1." INNER JOIN ".$q2." ON Product_Table.product_id = Customer_Products.product_id WHERE 1" ;
		
		$query = $this->db->query($q) ;
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] =  $row ;
			}
			return $data ;
		}
		else 
			 return 0 ;		
	}
	public function get_orders()
	{
		$q = "(SELECT * FROM orders WHERE type = 'order' AND status = 'Pending' ORDER BY orders.creation_date DESC LIMIT 5) UNION (SELECT * FROM orders WHERE type = 'order' AND status = 'Accepted' ORDER BY orders.acceptance_date DESC LIMIT 5) UNION (SELECT * FROM orders WHERE type = 'order' AND status = 'Ordered' ORDER BY orders.order_date DESC LIMIT 5) UNION (SELECT * FROM orders WHERE type = 'order' AND status = 'Shipped' ORDER BY orders.shipment_date DESC LIMIT 5)" ;
		
		$query = $this->db->query($q) ;
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
				$data[] =  $row ;
			return $data ;
		}
		else return 0 ;
	}
	
	public function get_invoices()
	{
		$q = "(SELECT * FROM orders WHERE type = 'order'  AND status = 'Outstanding' ORDER BY orders.outstanding_date DESC) UNION (SELECT * FROM orders WHERE type = 'order'  AND status = 'Invoiced' ORDER BY orders.invoice_date DESC)" ;
		
		$query = $this->db->query($q) ;
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
				$data[] =  $row ;
			return $data ;
		}
		else 
			 return 0 ;
	}
	
	public function get_customer_invoice()
	{
	
		$q = "(SELECT orders.status as status, orders.id as id, orders.invoice_date as invoice_date, orders.purchase_order_number as purchase_order_number, customers.company_name as company_name, customers.contact_person_name as contact_person_name, customers.email_address as email_address , customers.balance as balance, customers.overdue_days as overdue_days FROM orders INNER JOIN customers ON orders.customer_id = customers.id WHERE orders.status = 'Outstanding'   ORDER BY orders.outstanding_date DESC) UNION (SELECT orders.status as status, orders.id as id, orders.invoice_date as invoice_date, orders.purchase_order_number as purchase_order_number, customers.company_name as company_name, customers.contact_person_name as contact_person_name, customers.email_address as email_address, customers.balance as balance, customers.overdue_days as overdue_days FROM orders INNER JOIN customers ON orders.customer_id = customers.id WHERE orders.status = 'Invoiced' ORDER BY orders.invoice_date DESC)" ;
		
		$query = $this->db->query($q) ;
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
				$data[] =  $row ;
			return $data ;
		}
		else 
			 return 0 ;
	}
	
	public function get_date_diff($date1,$date2)
	{	
		$q = "SELECT DATEDIFF('".$date1."','".$date2."') AS DiffDate" ;
		
		$query = $this->db->query($q);
		
		if ($query->num_rows() > 0)
		{		
			$query = $query->result() ;
			return array_pop($query) ;
		}
		else 
			 return 0 ;
	}
}
?>