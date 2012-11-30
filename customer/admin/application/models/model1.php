<?php

/******* This Model (Model 1 contains the general functions) ********/

class Model1 extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }
	
	/****** Insert Record *******/
	public function insert_rec($params,$tablename)
	{	
		$this->db->insert($tablename, $params); 
		return mysql_insert_id();
	}
	
	/****** Update Record *******/
	public function update_rec($params,$cond,$tablename)
	{
		$fields = '' ;
		foreach($params as $key=>$value)
		{
			$value = mysql_real_escape_string($value) ;
			$fields .= $key." = '".$value."', " ;
		}
		
		$fields = trim($fields, ", ") ;

		$i = 0 ;
		$conditions = '' ;
		foreach($cond as $key=>$value)
		{
			if($i > 0)
				$conditions .= " AND " ;
				$conditions .= $key." = '".$value."' " ;
				$i++ ;
		}
		
		$q = "UPDATE ".$tablename." SET ".$fields." WHERE ".$conditions."" ;
		
		$query = $this->db->query($q) ;
		return $query ;
	}
	
	/****** Delete Record *******/
	public function delete_rec($cond,$tablename)
	{
		$i = 0;
		$conditions = '' ;
		foreach($cond as $key => $value)
		{
			if($i>0)
				$conditions .= " AND " ;
				$conditions .= $key." = '".$value."'" ;
				$i++ ;
		}
		
		$q = "DELETE FROM ".$tablename." WHERE ".$conditions."" ;

		$query = $this->db->query($q);
		return $query;
	}
	
	/****** Get One Rec *******/
	public function get_one($cond,$tablename)
	{
		$i = 0 ;
		$conditions = '' ;
		foreach($cond as $key => $value)
		{
			$value = mysql_real_escape_string($value);
			if($i > 0)
				$conditions .= " AND " ;
				$conditions .= $key." = '".$value."' " ;
				$i++;
		}
		
		$q = "SELECT * FROM ".$tablename." WHERE ".$conditions."" ;
		
		$query = $this->db->query($q);
		
		if ($query->num_rows() > 0)
		{		
			$query = $query->result() ;
			return array_pop($query) ;
		}
		else 
			 return 0 ;
	}
	
	/****** Get One Rec By Order *******/
	public function get_one_by_order($cond,$tablename,$attribute,$order_by)
	{
		$i = 0 ;
		$conditions = '' ;
		foreach($cond as $key => $value)
		{
			$value = mysql_real_escape_string($value) ;
			if($i > 0)
				$conditions .= " AND " ;
				$conditions .= $key." = '".$value."' " ;
				$i++ ;
		}
		
		$q = "SELECT * FROM ".$tablename." WHERE ".$conditions." ORDER BY ".$attribute." ".$order_by."" ;
		
		$query = $this->db->query($q) ;
		if ($query->num_rows() > 0)
		{		
			$query = $query->result() ;
			return array_pop($query) ;
		}
		else 
			 return 0 ;
	}
	
	/****** Get All Recs *******/
	public function get_all($tablename)
	{
		$query = $this->db->get($tablename) ;
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row ;
			}
			return $data ;
		}
		
		else 
			 return 0 ;
	}
	
	/****** Get All Recs with Order By *******/
	public function get_all_orderby($tablename, $order_by_attribute, $order)
	{
		$q = "SELECT * FROM ".$tablename." WHERE 1 ORDER BY ".$order_by_attribute." ".$order."" ;
		
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
	
	/****** Get All Recs with cond *******/
	public function get_all_cond($cond,$tablename)
	{
		$i = 0 ;
		$conditions = '' ;
		foreach($cond as $key => $value)
		{
			$value = mysql_real_escape_string($value) ;
			if($i > 0)
				$conditions .= " AND " ;
			
			$conditions .= $key." = '".$value."' " ;
			$i++;
		}
		
		$q = "SELECT * FROM $tablename WHERE $conditions" ;
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
	
	/****** Get All Recs with condition and order *******/
	public function get_all_cond_orderby($cond, $tablename, $order_by_attribute, $order)
	{
		$i = 0 ;
		$conditions = '' ;
		foreach($cond as $key => $value)
		{
			$value = mysql_real_escape_string($value) ;
			if($i > 0)
				$conditions .= " AND ";
			$conditions .= $key." = '".$value."'" ;
			$i++ ;
		}
		
		$q = "SELECT * FROM ".$tablename." WHERE ".$conditions." ORDER BY ".$order_by_attribute." ".$order."" ;
		
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
	
	/****** Get All Recs with condition and limit *******/
	public function get_all_cond_limit($tablename, $cond, $offset, $limit)
	{	
		$i = 0;
		$conditions = "" ;
		foreach($cond as $key => $value)
		{
			$value = mysql_real_escape_string($value);
			if($i > 0)
				$conditions .= " AND " ;
				$conditions .= $key." = '".$value."' " ;
				$i++ ;
		}
		
		$q = "SELECT * FROM $tablename WHERE ".$conditions." LIMIT ".$offset.", ".$limit."";
		
		$query = $this->db->query($q);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] =  $row;
			}
			return $data;
		}
		else 
			 return 0;
	}
	
	/****** Get All Recs with condition and limit *******/
	public function get_all_cond_order_by_limit($tablename, $cond, $order_by_attribute, $order, $offset, $limit)
	{	
		$i = 0 ;
		$conditions = "" ;
		foreach($cond as $key => $value)
		{
			$value = mysql_real_escape_string($value);
			if($i > 0)
				$conditions .= " AND " ;
				$conditions .= $key." = '".$value."' " ;
				$i++ ;
		}
		
		$q = "SELECT * FROM ".$tablename." WHERE ".$conditions." ORDER BY ".$tablename.$order_by_attribute." ".$order." LIMIT ".$offset.", ".$limit."";
		
		$query = $this->db->query($q);
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$data[] =  $row;
			}
			return $data;
		}
		else 
			 return 0;
	}
	
	/****** INNER JOIN with conds and Limit *******/
	public function inner_join_limit($attribute1, $attribute2, $cond1, $cond2, $join_cond_1, $join_cond_2, $tablename1, $tablename2, $offset = "0", $limit = "ALL")
	{
		$i = 0 ;
		$conditions = "1" ;
		if($cond1)
		{
			$conditions = "" ;
			foreach($cond1 as $key1 => $value1):
				$value1 = mysql_real_escape_string($value1) ;
				if($i > 0) $conditions .= " AND " ;
				$conditions .= $tablename1.".".$key1." = '".$value1."' " ;
				$i++ ;
			endforeach ;
		}
		
		if($cond2)
		{
			if($conditions == "1") $conditions = "" ;
			foreach($cond2 as $key2 => $value2):
				$value2 = mysql_real_escape_string($value2) ;
				if($i > 0) $conditions .= " AND " ;
				$conditions .= $tablename2.".".$key2." = '".$value2."' " ;
				$i++ ;
			endforeach ;
		}
		
		$j = 0 ;
		$attributes = "*" ;
		if($attribute1)
		{
			$attributes = "" ;
			foreach($attribute1 as $key3):
				$key3 = mysql_real_escape_string($key3) ;
				if($j > 0) $attributes .= ", " ;
				$attributes .= $tablename1.".".$key3 ;
				$j++ ;
			endforeach ;
		}
		
		if($attribute2)
		{
			if(!(is_array($attribute1)))
				$attributes = "" ;
			foreach($attribute2 as $key4):
				$key4 = mysql_real_escape_string($key4) ;
				if($j > 0) $attributes .= ", " ;
				$attributes .= $tablename2.".".$key4 ;
				$j++ ;
			endforeach ;
		}
		
		$q = "SELECT ".$attributes." FROM ".$tablename1." INNER JOIN ".$tablename2." ON ".$tablename1.".".$join_cond_1." = ".$tablename2.".".$join_cond_2." WHERE ".$conditions." LIMIT ".$offset.", ".$limit."" ;
		
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
	
	/****** INNER JOIN with conds, order by and Limit *******/
	public function inner_join_orderby_limit($attribute1, $attribute2, $cond1, $cond2, $join_cond_1, $join_cond_2, $tablename1, $tablename2, $order_by_attribute, $order, $offset = "0", $limit = "18446744073709551615")
	{
		$i = 0 ;
		$conditions = "1" ;
		if($cond1)
		{
			$conditions = "" ;
			foreach($cond1 as $key1 => $value1):
				$value1 = mysql_real_escape_string($value1) ;
				if($i > 0) $conditions .= " AND " ;
				$conditions .= $tablename1.".".$key1." = '".$value1."' " ;
				$i++ ;
			endforeach ;
		}
		
		if($cond2)
		{
			if($conditions == "1") $conditions = "" ;
			foreach($cond2 as $key2 => $value2):
				$value2 = mysql_real_escape_string($value2) ;
				if($i > 0) $conditions .= " AND " ;
				$conditions .= $tablename2.".".$key2." = '".$value2."' " ;
				$i++ ;
			endforeach ;
		}
		
		$j = 0 ;
		$attributes = "*" ;
		if($attribute1)
		{
			$attributes = "" ;
			foreach($attribute1 as $key3):
				$key3 = mysql_real_escape_string($key3) ;
				if($j > 0) $attributes .= ", " ;
				$attributes .= $tablename1.".".$key3 ;
				$j++ ;
			endforeach ;
		}
		
		if($attribute2)
		{
			if(!(is_array($attribute1)))
				$attributes = "" ;
			foreach($attribute2 as $key4):
				$key4 = mysql_real_escape_string($key4) ;
				if($j > 0) $attributes .= ", " ;
				$attributes .= $tablename2.".".$key4 ;
				$j++ ;
			endforeach ;
		}
		
		$q = "SELECT ".$attributes." FROM ".$tablename1." INNER JOIN ".$tablename2." ON ".$tablename1.".".$join_cond_1." = ".$tablename2.".".$join_cond_2." WHERE ".$conditions." ORDER BY ".$order_by_attribute." ".$order." LIMIT ".$offset.", ".$limit."" ;
		
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
	
	/****** Count records of a table *******/
	public function count_rec($tablename)
	{	
		$q = "SELECT Count(*) As Total_Rec FROM ".$tablename." WHERE 1" ;
		$query = $this->db->query($q) ;
		if ($query->num_rows() > 0)
		{		
			$query = $query->result() ;
			return array_pop($query) ;
		}
		else 
			 return 0 ;
	}
	/****** Count Records with conditions *******/
	public function count_rec_cond($cond,$tablename)
	{	
		$i = 0;
		$conditions = '';
		foreach($cond as $key => $value)
		{
			if($i > 0)
				$conditions .= " AND " ;
			
			$conditions .= $key." = '".$value."'" ;
			$i++ ;
		}
		
		$q = "SELECT Count(*) As Total_Rec FROM ".$tablename." WHERE ".$conditions."" ; 
		
		$query = $this->db->query($q);
		
		if ($query->num_rows() > 0)
		{		
			$query = $query->result();
			$rec = array_pop($query);
			return $rec->Total_Rec;
		}
		else 
			 return 0;
	}
}
