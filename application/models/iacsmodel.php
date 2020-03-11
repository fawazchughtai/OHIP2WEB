<?php
class Iacsmodel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function insert_import($table_name, $data)
	{
		$this->db->insert_batch('tblspecialtycodes', $data);
	}
	
	public function ReturnRowValue($table, $FieldName, $WhereFields, $WhereValue)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select $FieldName from $table where $WhereFields='$WhereValue' ";
		$query=$this->db->query($sql);
		
		if($query->num_rows>0)
    	{	
			return $query->row($FieldName);
    	}else{
			return "";
		}
		
	}
	
	public function check_company_info($FieldName)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select Account from master_table where Account='$FieldName' ";
		$query=$this->db->query($sql);
		if($query->num_rows>0)
    	{	
			return $query->row($FieldName);
    	}else{
			return "";
		}
	}
	
	public function RV_Setting($table, $FieldName, $WhereFields, $WhereValue, $compid)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select $FieldName from $table where $WhereFields='$WhereValue' AND compid='$compid'";
		$query=$this->db->query($sql);
		if($query->num_rows>0)
    	{	
			return $query->row($FieldName );
    	}else{
			return "";
		}
	}

	public function GetMaxRow($Table, $FieldName, $WhereFields, $WhereValue)
	{
		
		//$sql="select isnull(max($FieldName)+1) as Max_ID from $Table where $WhereFields='$WhereValue'";
		$sql="select IFNULL(max($FieldName), 0)+1 as Max_ID from $Table where  $WhereFields='$WhereValue' ";
		$query=$this->db->query($sql);
		return $query->row('Max_ID');
	}
	
	public function GetMaxRow_withOUtComp($Table, $FieldName, $WhereFields, $WhereValue)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
		$sql="select isnull(max($FieldName)+1) as Max_ID from $Table where $WhereFields='$WhereValue'";
		//$sql="select IFNULL(max($FieldName), 0)+1 as Max_ID from $Table where  $WhereFields='$WhereValue' ";
		$query=$this->db->query($sql);
		return $query->row('Max_ID');
	}
	
	public function Count_Rows($Table, $FieldName, $WhereFields, $WhereValue)
	{
		
		$sql="select count($FieldName) as Counter from $Table where  $WhereFields='$WhereValue' ";
		$query=$this->db->query($sql);
		return $query->row('Counter');
	}
	
	public function Sum_Rows($Table, $FieldName, $WhereFields, $WhereValue, $vPtype)
	{
		
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select sum($FieldName) as Counter from $Table where  $WhereFields='$WhereValue' ";
		$query=$this->db->query($sql);
		return $query->row('Counter');
	}	
	
	
	public function GetMaxRow_Register($Table, $FieldName, $WhereFields, $WhereValue)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select IFNULL(max($FieldName), 0)+1 as Counter from $Table where $WhereFields='$WhereValue' ";
		$query=$this->db->query($sql);
		return $query->row('Counter');
	}
	
	
	public function Count_Rows_Is_Not_Empty($Table, $FieldName, $WhereFields, $WhereValue)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
		$sql="select count($FieldName) as Counter from $Table where  $WhereFields<>'$WhereValue'";
		$query=$this->db->query($sql);
		return $query->row('Counter');
	}
	
	public function ReturnArrayValue($table, $WhereFields, $WhereValue, $orderby_value, $ASC_DES)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
		$sql="select * from $table where  $WhereFields='$WhereValue'  Order by $orderby_value $ASC_DES";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	public function ReturnPhysicianEmail()
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
		$sql="SELECT IFNULL(`Email`,'-') as physemail FROM `physicianinformation` ";
		$query=$this->db->query($sql);
		return $query->row('physemail');
	}
	
	public function ReturnArrayValue_Master($table, $WhereFields, $WhereValue, $orderby_value, $ASC_DES)
	{
		$this->db->query('use ohip_master_db');
		
		$sql="select * from $table where  $WhereFields='$WhereValue'  Order by $orderby_value $ASC_DES";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	public function ReturnArrayValueSetting($table, $WhereFields, $WhereValue, $orderby_value, $ASC_DES, $LIMIT)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
		$sql="select * from $table where $WhereFields='$WhereValue'  Order by $orderby_value $ASC_DES LIMIT 0 , $LIMIT";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
}
?>