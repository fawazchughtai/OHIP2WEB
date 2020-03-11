<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	var $Site_Url = "http://localhost/orcal_db/user/";
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('iacsmodel');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('string');
		$this->load->library('email');
		$this->load->helper('text');
		$this->load->helper('xml');
	}
	
	public function index()
	{
		redirect($this->Site_Url."home");
	}
	
	
	function home()
	{
		$sql="select * from xx_hr_emp_reg_reporting_to ";
		$query=$this->db->query($sql);
		$List_Result = $query->result_array();
		foreach($List_Result as $_ListRows)
		{
			$EMPLOYEE_ID = $_ListRows['EMPLOYEE_ID'];
			$REPORTING_EMP_ID = $_ListRows['REPORTING_EMP_ID'];
			$REPORTING_LEVEL_ID = $_ListRows['REPORTING_LEVEL_ID'];
			$ORG_ID = $_ListRows['ORG_ID'];
			$ORGANIZATION_ID = $_ListRows['ORGANIZATION_ID'];
			$LAST_UPDATE_DATE = $_ListRows['LAST_UPDATE_DATE'];
			$LAST_UPDATED_BY = $_ListRows['LAST_UPDATED_BY'];
			
			$CREATION_DATE = $_ListRows['CREATION_DATE'];
			$CREATED_BY = $_ListRows['CREATED_BY'];
			$LAST_UPDATE_LOGIN = $_ListRows['LAST_UPDATE_LOGIN'];
			$EMP_ORACLE_USER_ID = $_ListRows['EMP_ORACLE_USER_ID'];
			
			echo $Insert_SQL = "INSERT INTO `xx_hr_emp_reg_reporting_to`(`EMPLOYEE_ID`, `REPORTING_EMP_ID`, `REPORTING_LEVEL_ID`, `ORG_ID`, `ORGANIZATION_ID`, 
			`LAST_UPDATE_DATE`, `LAST_UPDATED_BY`, `CREATION_DATE`, `CREATED_BY`, `LAST_UPDATE_LOGIN`, `EMP_ORACLE_USER_ID`) 
			VALUES ('$EMPLOYEE_ID', '$REPORTING_EMP_ID', '$REPORTING_LEVEL_ID', '$ORG_ID', '$ORGANIZATION_ID', '$LAST_UPDATE_DATE', '$LAST_UPDATED_BY',
			'$CREATION_DATE', '$CREATED_BY', '$LAST_UPDATE_LOGIN', '$EMP_ORACLE_USER_ID');
			
			";
			echo "<br><br><br>";
			$this->legacy_db = $this->load->database(db_mysql, true);

			//$db_mysql = $this->load->database(db_mysql, TRUE);
			
			$this->legacy_db->query($Insert_SQL);
		}
			
		
	}	
	
}