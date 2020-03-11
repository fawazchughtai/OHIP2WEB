<?php
class General_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function Claim_Counter($type)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
		$sql="select count(*) as tt from tblclaim_entry_master where c_e_status=$type";
		$sql="select count(*) as tt from processed_service_record where status=$type";
		$sql="select DISTINCT(source_id)  as tt from processed_service_record where status=$type";
		$query=$this->db->query($sql);
		
		if($query->num_rows>0)
    	{	
			//return $query->row('tt');
			return $query->num_rows;
    	}else{
			return "";
		}
		
	}
	
	public function Claim_services_by_claimid($source_id)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select sum(num_serv)  as tt from processed_service_record where source_id=$source_id";
		$query=$this->db->query($sql);
		
		if($query->num_rows>0)
    	{	
			return $query->row('tt');
			//return $query->num_rows;
    	}else{
			return "";
		}
		
	}
	
	public function Claim_Value_by_claimid($source_id)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select sum(Submitted_Fee) as tf from processed_service_record  where source_id=$source_id";
		$query=$this->db->query($sql);
		
		if($query->num_rows>0)
    	{	
			return $query->row('tf');
    	}else{
			return "";
		}
		
	}
	
	public function Claim_Value($type)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
		$sql="select sum(txttotalfee) as tf from tblclaim_entry_body where eb_status=$type";
		$sql="select sum(Submitted_Fee) as tf from processed_service_record  where status=$type";
		$query=$this->db->query($sql);
		
		if($query->num_rows>0)
    	{	
			return $query->row('tf');
    	}else{
			return "";
		}
		
	}
	
	public function Claim_Value_date($type, $dates)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select sum(txttotalfee) as tf from tblclaim_entry_body where eb_status=$type AND service_date='".$dates."' AND claim_entry_id<>0";
		$sql="select sum(Submitted_Fee) as tf from processed_service_record where status=$type AND service_date='".$dates."' ";
		
		$query=$this->db->query($sql);
		
		if($query->num_rows>0)
    	{	
			return $query->row('tf');
    	}else{
			return "";
		}
		
	}
	
	
	public function ReturnRowValue($table, $FieldName, $WhereFields, $WhereValue)
	{
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
		
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select IFNULL(max($FieldName), 0)+1 as Max_ID from $Table where  $WhereFields='$WhereValue' ";
		$query=$this->db->query($sql);
		return $query->row('Max_ID');
	}
	
	public function GetMinRow($Table, $FieldName, $WhereFields, $WhereValue)
	{
		
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select IFNULL(min($FieldName), 0) as Max_ID from $Table where  $WhereFields='$WhereValue' ";
		$query=$this->db->query($sql);
		return $query->row('Max_ID');
	}

	public function GetMax_Row($Table, $FieldName, $WhereFields, $WhereValue)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
		$sql="select IFNULL(max($FieldName), 0) as Max_ID from $Table where  $WhereFields='$WhereValue' ";
		$query=$this->db->query($sql);
		return $query->row('Max_ID');
	}
	
	public function Count_Rows($Table, $FieldName, $WhereFields, $WhereValue)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		
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
		
	
	public function MasterArrayValue($CompId, $WhereFields, $WhereValue, $orderby_value, $ASC_DES)
	{
		$db_name = $this->session->userdata("db_name");
		$this->db->query('use '.$db_name.'');
		$sql="select * from mastertable where compid='$CompId' AND $WhereFields='$WhereValue' Order by $orderby_value $ASC_DES";
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