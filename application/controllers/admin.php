<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	//var $Site_Url = "http://localhost/oofsl2/admin/";
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('iacsmodel');
		$this->load->model('excel_import_model');
		$this->load->model('General_model');
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('string');
		$this->load->library('email');
		$this->load->helper('text');
		$this->load->helper('xml');
		$this->load->library('excel');
	}
	
	public function index()
	{
		$data['__siteurl'] = base_url() . "admin/";
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			redirect(base_url() . "admin/"."home");
		}
	}

	public function forgot_password()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$this->load->view('forgot_password', $data);
	}
	
	public function forgot_invalid()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$this->load->view('forgot_invalid', $data);
	}
	
	function forgot_check()
	{
		$user = $this->input->post('txtuser');		
		$this->db->query('use ohip_master_db');
		$sql = "SELECT * FROM tbl_master WHERE email='"  . $user . "'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			$provider_no = $query->row('recid');
			$LastName = $query->row('LastName');
			$active_code = $provider_no . "".date('Ymdis');
			$sql_update = "UPDATE `tbl_master` SET active_code='". $active_code . "' where recid='".$query->row('recid')."'";
			$this->db->query($sql_update);
			$to = $user;
			$subject = "Forgot Passsword Link ";
			$txt = "Hello $LastName, ";
			$txt = $txt . " You request for rest the password please chick on this link.";
			$txt = $txt . " <a href='".base_url() . "admin/password_reset?code=$active_code'>Change Password </a>";
			$txt = $txt . "Thank !";
			echo $txt;
			$headers = "From: info@example.com";

			mail($to,$subject,$txt,$headers);

			$data['__siteurl'] = base_url() . "admin/";
			$this->load->view('forgot_send', $data);
		}else{
			redirect(base_url() . "admin/"."forgot_invalid");
		}
	}
	
	public function password_reset()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$this->load->view('password_reset', $data);
	}
	
	function password_change()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$txtNewPassword = md5($this->input->post('txtNewPassword'));
		$active_code = $this->input->post('active_code');
		$this->db->query('use ohip_master_db');
		$sql = "SELECT * FROM tbl_master WHERE active_code='" . $active_code . "'";
		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			$sql_update = "UPDATE `tbl_master` SET txtpassword='". $txtNewPassword . "' where recid='".$query->row('recid')."'";
			$this->db->query($sql_update);
			$this->load->view('password_reset_successfully', $data);
		}else{
			redirect(base_url() . "admin/password_reset");
		}
	}
	
	public function sign_up()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$this->load->view('sign_up', $data);
	}
	
	public function sign_up_save()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$_URL = base_url() . "admin/";
		$U = base64_encode($_URL);
		
		$this->db->query('use ohip_master_db');
		//$db_name = "ohip_".date('Ymdhis');
		$db_name = "ohip_".$this->input->post('txtpno');
		$sql_insert = "INSERT INTO `tbl_master`(`FirstName`, `LastName`, `Address`, `City`, `Province`, `PostalCode`, `phoneno`, `email`, 
		`txtpassword`, `provider_no`, `mricode`, `specialtycodes`, `db_name`, `opt_info`) 
		VALUES (
		 '" . $this->input->post('fname')  . "'
		,'"  . $this->input->post('lname')  . "','"  . $this->input->post('txtaddress') . "'
		,'"  . $this->input->post('txtcity') . "','"  . $this->input->post('cmbProvince') . "'
		,'"  . $this->input->post('txtPostalCode') . "'
		,'"  . $this->input->post('txtphone') . "'
		,'"  . $this->input->post('txtemail_new') . "'
		,'"  . md5($this->input->post('txtpassword_new')) . "'
		,'"  . $this->input->post('txtpno') . "','"  . $this->input->post('cmbmri_code') . "'
		,'"  . $this->input->post('cmbspecialtycodes') . "','"  . $db_name . "','"  . $this->input->post('question') . "')";
		$this->db->query($sql_insert);

		redirect(base_url() . "create_db.php?db=".$db_name."&u=".$U);
		//redirect(base_url() . "admin/"."sign_up_active");
	}
	
	public function sign_up_active()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$this->load->view('sign_up_active', $data);
	}
	
	public function login()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$this->load->view('login', $data);
	}
	
	public function alreadylogin()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$this->load->view('alreadylogin', $data);
	}
	
	public function email_address_check()
	{
		$txt_email = $this->input->post('txt_email');
		$this->db->query('use ohip_master_db');
		
		$sql = "SELECT * FROM tbl_master WHERE email='" . $txt_email. "'";
		$query=$this->db->query($sql);
		echo $query->num_rows();
		if($query->num_rows() < 0)
		{
			echo "ok";
		}else{
			echo "register";
		}
	}
	
	public function password_check($txtpassword)
	{
		$this->db->query('use ohip_master_db');
		$db_name = $this->session->userdata("db_name");
		$sql = "SELECT * FROM tbl_master WHERE db_name='" . $db_name. "' and txtpassword='".md5($txtpassword)."'";
		$query=$this->db->query($sql);
		//echo $query->num_rows();
		if($query->num_rows() == 0)
		{
			echo "wrong";
		}else{
			echo "ok";
		}
	}
	
	function change_password_update()
	{
		$this->db->query('use ohip_master_db');
		$db_name = $this->session->userdata("db_name");
		$txtpassword = $this->input->post('txtpassword_new');
		$sql_update = "update tbl_master set txtpassword='".md5($txtpassword) ."' WHERE db_name='" . $db_name. "'";
		
		$this->db->query($sql_update);
		redirect(base_url() . "admin/"."change_password_successfully");
		
	}
	
	public function logincheck()
	{
		$user = $this->input->post('txtuser');
		$pass = $this->input->post('txtpassword');
		$pass = md5($pass);
		
		$this->db->query('use ohip_master_db');
		//$sql = "SELECT fullname, accounttype,  username, compid FROM admin_login WHERE username='"  . $user . "' AND password='" . $pass ."' ";
		$sql = "SELECT * FROM tbl_master WHERE email='"  . $user . "' AND txtpassword='" . $pass ."' ";
		$query=$this->db->query($sql);
		if($query->num_rows()>0)
		{
			$username = $query->row('provider_no') . "-". $query->row('recid');
			$fullname = $query->row('FirstName') . " " . $query->row('LastName') ;
			
			$this->session->set_userdata("Login_id", $username);
			$this->session->set_userdata("user", $user);
			$this->session->set_userdata("recid", $query->row('recid'));
			$this->session->set_userdata("fullname", $fullname);
			$this->session->set_userdata("db_name", $query->row('db_name'));
			
			
			$OHIPBillingNumber_var = str_replace("ohip_","",$query->row('db_name'));
			$OHIPBillingNumber = $this->iacsmodel->ReturnRowValue("physicianinformation", "OHIPBillingNumber", "OHIPBillingNumber", $OHIPBillingNumber_var); 	
	
			if($OHIPBillingNumber == '')
			{
				$ActivationCode = $GroupNumber = $MOHOfficeCode = $LocationCode = '0';
				$_List = $this->iacsmodel->ReturnArrayValue_Master("tbl_master", "recid", $query->row('recid'), "recid", 'asc'); 	
				foreach($_List as $_ListRows)
				{
					$SUb_Query = "INSERT INTO `physicianinformation`
					(`FirstName`, `LastName`, `Address`, `City`, `Province`, `PostalCode`, `OHIPBillingNumber`, `LocationCode`, 
					`MOHOfficeCode`, `GroupNumber`,
					`Specialty`, `Diagnosis`, `OptIn`, `PhoneNumber`, `Email`, `ActivationCode`) 
					VALUES (
					'".$query->row('FirstName')."',
					'".$query->row('LastName')."',
					'".$query->row('Address')."',
					'".$query->row('City')."',
					'".$query->row('Province')."',
					'".$query->row('PostalCode')."',
					'".$OHIPBillingNumber_var."',
					'".$LocationCode."',
					'".$MOHOfficeCode."',
					'".$GroupNumber."',
					
					'".$query->row('specialtycodes')."',
					'".$query->row('Diagnosis')."',
					'".$query->row('opt_info')."',
					'".$query->row('phoneno')."',
					'".$query->row('email')."',
					'".$ActivationCode."')";
					
					$db_name = $this->session->userdata("db_name");
					$this->db->query('use '.$db_name.'');
					
					$this->db->query($SUb_Query);
					
					
				}
				
			}// Billing Number
					
			if($user == 'admin'){
				redirect(base_url() . "admin/"."home_admin");
			}else{
				redirect(base_url() . "admin/"."home");
			}
		}else{
			redirect(base_url() . "admin/"."invalidlogin");
		}
	}
	
	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . "admin/"."login");
	}
	
	function invalidlogin()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$this->load->view('invalidlogin', $data);
	}
	
	function home()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			$this->load->view('header', $data);
			$this->load->view('dashboard', $data);
			$this->load->view('footer', $data);
		}	
		
	}
	
	function home_admin()
	{
		$data['__siteurl'] = base_url() . "admin/";
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			$this->load->view('header', $data);
			$this->load->view('dashboard_admin', $data);
			$this->load->view('footer', $data);
		}	
		
	}
	
	public function change_password()
	{
		$page_url = $data['page_url'] = "change_password";
		$data['__siteurl'] = base_url() . "admin/";
	
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			$this->load->view('header', $data);
			$this->load->view('change_password', $data);
			$this->load->view('footer', $data);
		}
	}
	
	public function change_password_successfully()
	{
		$page_url = $data['page_url'] = "change_password";
		$data['__siteurl'] = base_url() . "admin/";
	
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			$this->load->view('header', $data);
			$this->load->view('change_password_successfully', $data);
			$this->load->view('footer', $data);
		}
	}
	
	
	public function setting()
	{
		$page_url = $data['page_url'] = "setting";
		$data['__siteurl'] = base_url() . "admin/";
	
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			$this->load->view('header', $data);
			$this->load->view('setting', $data);
			$this->load->view('footer', $data);
		}
	}
	
	public function setting_save()
	{
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			$this->db->query('use ohip_master_db');
			
			if($this->input->post('CVV') == ''){ $CVV ='0'; }else{ $CVV = $this->input->post('CVV'); }  
			
			$sql_insert = "UPDATE `tbl_master` SET 
				FirstName='". $this->input->post('fname') . "', 
				LastName='". $this->input->post('lname') . "', 
				Address='". $this->input->post('txtaddress') . "', 
				City='". $this->input->post('txtcity') . "', 
				Province='". $this->input->post('cmbProvince') . "', 
				PostalCode='". $this->input->post('txtPostalCode') . "', 
				phoneno='". $this->input->post('txtphone') . "', 
				provider_no='". $this->input->post('txtpno') . "', 
				mricode='". $this->input->post('cmbmri_code') . "', 
				specialtycodes='". $this->input->post('cmbspecialtycodes') . "', 
				opt_info='". $this->input->post('question') . "',
				card_holder_name='". $this->input->post('card_holder_name') . "', 
				credit_card_no='". $this->input->post('credit_card_no') . "', 
				card_type='". $this->input->post('card_type') . "', 
				Expiry_Date='". $this->input->post('Expiry_Date') . "',
				CVV='". $CVV . "' where recid='".$this->input->post('recid')."'";
			$this->db->query($sql_insert);
			/*
			email='". $this->input->post('txtemail_new') . "', 
				txtpassword='". md5($this->input->post('txtpassword_new')) . "', 
				*/
			$sql_Update = "UPDATE `physicianinformation` SET 
			`FirstName`='". $this->input->post('fname') . "',`LastName`='". $this->input->post('lname') . "',`Address`='". $this->input->post('txtaddress') . "', 
			`City`='". $this->input->post('txtcity') . "',`Province`='". $this->input->post('cmbProvince') . "',`PostalCode`='". $this->input->post('txtPostalCode') . "',
			`MOHOfficeCode`='". $this->input->post('cmbmri_code') . "',
			`PhoneNumber`='". $this->input->post('txtphone') . "',
			`OptIn`='". $this->input->post('question') . "',
			`Email`='". $this->input->post('txtemail_new') . "'
			WHERE OHIPBillingNumber='". $this->input->post('txtpno') . "'";
			
			$db_name = $this->session->userdata("db_name");
			
			$this->db->query('use '.$db_name.'');
			$this->db->query($sql_Update);
			
			redirect(base_url() . "admin/"."setting");
		}
		
	}
	
	function specialty_code($type='', $id='')
	{
		$page_url = "specialty_code";
		$data['page_url'] = "specialty_code";
		$data['__siteurl'] = base_url() . "admin/";
		
		//$db_name = $this->session->userdata("db_name");
		//$this->db->query('use '.$db_name.'');
		$this->db->query('use ohip_master_db');
		
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view('specialty_code/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "INSERT INTO `tblspecialtycodes`(`specialtycode`, `specialtydesc`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
			$this->db->query($sql_insert);
			
			redirect(base_url() . "admin/"."".$page_url);
			
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update')
		{
			
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txtid = $this->input->post('id');
			
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "UPDATE `tblspecialtycodes` SET specialtycode='". $txt1 . "', specialtydesc='". $txt2 . "' where recid='".$txtid."'";
			$this->db->query($sql_insert);
			
			redirect(base_url() . "admin/"."".$page_url);
			
		}
		
		if($type == 'delete')
		{
			$sql_insert = "delete from tblspecialtycodes Where recid='".$id."'";
			$this->db->query($sql_insert);
			
			 redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
		
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
		
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$txt1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$txt2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						
						$txt1=str_replace("'","\'",$txt1);
						$txt2=str_replace("'","\'",$txt2);

						
						$sql_insert = "INSERT INTO `tblspecialtycodes`(`specialtycode`, `specialtydesc`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
						$this->db->query($sql_insert);
						//$data[] = array('specialtycode'	=>	$t1,'specialtydesc'	=>	$t2);
					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}
	
	function province($type='', $id='')
	{
		$db_name = $this->session->userdata("db_name");
		if($db_name == 'ohip_master_db')
		{
			$data['_Tbl'] = $_Tbl = "tbldiagnosis";
			$data['_fl'] = $_f1 = "DiagnosisCode";
			$data['_f2'] = $_f2 = "DiagnosisDesc";
			$data['_f3'] = $_f3 = "DiagnosisId";
		}else{
			$data['_Tbl'] = $_Tbl = "tblprovince";
			$data['_fl'] = $_f1 = "ProvCode";
			$data['_f2'] = $_f2 = "ProvName";
			$data['_f3'] = $_f3 = "recid";			
		}
		
		
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$data['page_url'] = $page_url = "province";
		$data['__siteurl'] = base_url() . "admin/";
		
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');	
			
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
			$this->db->query($sql_insert);
			 redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update')
		{	
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txtid = $this->input->post('id');		
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "UPDATE `$_Tbl` SET $_f1='". $txt1 . "', $_f2='". $txt2 . "' where $_f3='".$txtid."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);	
		}
		
		if($type == 'delete')
		{
			$sql_insert = "delete from $_Tbl Where $_f3='".$id."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$txt1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$txt2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$txt1=str_replace("'","\'",$txt1);
						$txt2=str_replace("'","\'",$txt2);

						$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
						$this->db->query($sql_insert);

					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}
	
	function status($type='', $id='')
	{
		$data['_Tbl'] = $_Tbl = "tblstatus";
		$data['_fl'] = $_f1 = "statusCode";
		$data['_f2'] = $_f2 = "status_dec";
		$data['_f3'] = $_f3 = "statusID";
		
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$data['page_url'] = $page_url = "status";
		$data['__siteurl'] = base_url() . "admin/";
		
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');	
			
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
			$this->db->query($sql_insert);
			 redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update')
		{	
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txtid = $this->input->post('id');	
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);
			
			$sql_insert = "UPDATE `$_Tbl` SET $_f1='". $txt1 . "', $_f2='". $txt2 . "' where $_f3='".$txtid."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);	
		}
		
		if($type == 'delete')
		{
			$sql_insert = "delete from $_Tbl Where $_f3='".$id."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$txt1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$txt2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$txt1=str_replace("'","\'",$txt1);
						$txt2=str_replace("'","\'",$txt2);

						$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
						$this->db->query($sql_insert);

					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}
	
	function diagnosis($type='', $id='')
	{
		$db_name = $this->session->userdata("db_name");
		
		if($db_name == 'ohip_master_db')
		{
			$data['_Tbl'] = $_Tbl = "tbldiagnosis";
			$data['_fl'] = $_f1 = "DiagnosisCode";
			$data['_f2'] = $_f2 = "DiagnosisDesc";
			$data['_f3'] = $_f3 = "DiagnosisId";
		}else{
			$data['_Tbl'] = $_Tbl = "diagnosis";
			$data['_fl'] = $_f1 = "code";
			$data['_f2'] = $_f2 = "Description";
			$data['_f3'] = $_f3 = "ID";
			
		}
		
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$data['page_url'] = $page_url = "diagnosis";
		$data['__siteurl'] = base_url() . "admin/";
		
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');	
			
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
			$this->db->query($sql_insert);
			 redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update')
		{	
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txtid = $this->input->post('id');	
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);
			
			$sql_insert = "UPDATE `$_Tbl` SET $_f1='". $txt1 . "', $_f2='". $txt2 . "' where $_f3='".$txtid."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);	
		}
		
		if($type == 'delete')
		{
			$sql_insert = "delete from $_Tbl Where $_f3='".$id."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$txt1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$txt2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$txt1=str_replace("'","\'",$txt1);
						$txt2=str_replace("'","\'",$txt2);

						$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
						$this->db->query($sql_insert);

					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}
	
	function referral($type='', $id='')
	{
		$data['_Tbl'] = $_Tbl = "referral";
		$data['_fl'] = $_f1 = "Name";
		$data['_f2'] = $_f2 = "OHIP_Referral";
		$data['_f3'] = $_f3 = "id";
		
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$data['page_url'] = $page_url = "referral";
		$data['__siteurl'] = base_url() . "admin/";
		
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');	
			
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
			$this->db->query($sql_insert);
			 redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update')
		{	
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txtid = $this->input->post('id');	
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);
			
			$sql_insert = "UPDATE `$_Tbl` SET $_f1='". $txt1 . "', $_f2='". $txt2 . "' where $_f3='".$txtid."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);	
		}
		
		if($type == 'delete')
		{
			$sql_insert = "delete from $_Tbl Where $_f3='".$id."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$txt1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$txt2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$txt1=str_replace("'","\'",$txt1);
						$txt2=str_replace("'","\'",$txt2);

						$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
						$this->db->query($sql_insert);

					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}
	
	function mri_code($type='', $id='')
	{
		$data['_Tbl'] = $_Tbl = "tblmri";
		$data['_fl'] = $_f1 = "mri_code";
		$data['_f2'] = $_f2 = "mri_desc";
		$data['_f3'] = $_f3 = "mri_id";
		
		$data['page_url'] = $page_url = "mri_code";
		$data['__siteurl'] = base_url() . "admin/";
		
		//$db_name = $this->session->userdata("db_name");
		//$this->db->query('use '.$db_name.'');
		$this->db->query('use ohip_master_db');
		
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');	
			
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
			$this->db->query($sql_insert);
			 redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update')
		{	
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txtid = $this->input->post('id');	
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);
			
			$sql_insert = "UPDATE `$_Tbl` SET $_f1='". $txt1 . "', $_f2='". $txt2 . "' where $_f3='".$txtid."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);	
		}
		
		if($type == 'delete')
		{
			$sql_insert = "delete from $_Tbl Where $_f3='".$id."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$txt1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$txt2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$txt1=str_replace("'","\'",$txt1);
						$txt2=str_replace("'","\'",$txt2);

						$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`) VALUES  ('" . $txt1  . "','" . $txt2 . "')";
						$this->db->query($sql_insert);

					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}

	function services($type='', $id='')
	{
		$db_name = $this->session->userdata("db_name");
		if($db_name == 'ohip_master_db')
		{
			$data['_Tbl'] = $_Tbl = "tblservices";
			$data['_fl'] = $_f1 = "servicesCode";
			$data['_f2'] = $_f2 = "servicesDesc";
			$data['_f3'] = $_f3 = "servicesId";
			$data['_f4'] = $_f4 = "servicesFee";
		}else{
			$data['_Tbl'] = $_Tbl = "services";
			$data['_fl'] = $_f1 = "ServiceCode";
			$data['_f2'] = $_f2 = "Description";
			$data['_f3'] = $_f3 = "ID";
			$data['_f4'] = $_f4 = "servicefee";					
		}			
		
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$data['page_url'] = $page_url = "services";
		$data['__siteurl'] = base_url() . "admin/";
	
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			$txt1 = $this->input->post('txt1');/// Code
			$txt2 = $this->input->post('txt2');	 /// Desc
			$txt3 = $this->input->post('txt3');	/// servies Fee
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`, `$_f4`) VALUES  ('" . $txt1  . "','" . $txt2 . "','" . $txt3 . "')";
			$this->db->query($sql_insert);
			 redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update')
		{	
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txt3 = $this->input->post('txt3');
			
			$txtid = $this->input->post('id');	
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);
			
			$sql_insert = "UPDATE `$_Tbl` SET $_f1='". $txt1 . "', $_f2='". $txt2 . "', $_f4='". $txt3 . "' where $_f3='".$txtid."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);	
		}
		
		if($type == 'delete')
		{
			$sql_insert = "delete from $_Tbl Where $_f3='".$id."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$txt1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$txt2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$txt3 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$txt1=str_replace("'","\'",$txt1);
						$txt2=str_replace("'","\'",$txt2);
						if($txt3 == ''){ $txt3 = 0; } 
						$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`, `$_f4`) VALUES  ('" . $txt1  . "','" . $txt2 . "','" . $txt3 . "')";
						$this->db->query($sql_insert);

					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}
	
	function user_management($type='', $id='')
	{
		$data['_Tbl'] = $_Tbl = "tbluser_management";
		$data['_fl'] = $_f1 = "fullname";
		$data['_f2'] = $_f2 = "user";
		$data['_f3'] = $_f3 = "userid";
		$data['_f4'] = $_f4 = "password";
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$data['page_url'] = $page_url = "user_management";
		$data['__siteurl'] = base_url() . "admin/";
		
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			$txt1 = $this->input->post('txt1');/// Code
			$txt2 = $this->input->post('txt2');	 /// Desc
			$txt3 = $this->input->post('txt3');	/// servies Fee
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`, `$_f4`) VALUES  ('" . $txt1  . "','" . $txt2 . "','" . $txt3 . "')";
			$this->db->query($sql_insert);
			 redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update')
		{	
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txt3 = $this->input->post('txt3');
			
			$txtid = $this->input->post('id');	
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);
			
			$sql_insert = "UPDATE `$_Tbl` SET $_f1='". $txt1 . "', $_f2='". $txt2 . "', $_f4='". $txt3 . "' where $_f3='".$txtid."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);	
		}
		
		if($type == 'delete')
		{
			$sql_insert = "delete from $_Tbl Where $_f3='".$id."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$txt1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$txt2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$txt3 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$txt1=str_replace("'","\'",$txt1);
						$txt2=str_replace("'","\'",$txt2);

						$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`, `$_f4`) VALUES  ('" . $txt1  . "','" . $txt2 . "','" . $txt3 . "')";
						$this->db->query($sql_insert);

					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}
	
	function plan($type='', $id='')
	{
		$data['_Tbl'] = $_Tbl = "tblplan";
		$data['_fl'] = $_f1 = "planCode";
		$data['_f2'] = $_f2 = "planDesc";
		$data['_f3'] = $_f3 = "planid";
		$data['_f4'] = $_f4 = "provCode";
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$data['page_url'] = $page_url = "plan";
		$data['__siteurl'] = base_url() . "admin/";
		
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			$txt1 = $this->input->post('txt1');/// Code
			$txt2 = $this->input->post('txt2');	 /// Desc
			$txt3 = $this->input->post('txt3');	/// servies Fee
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);

			$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`, `$_f4`) VALUES  ('" . $txt1  . "','" . $txt2 . "','" . $txt3 . "')";
			$this->db->query($sql_insert);
			 redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update')
		{	
			$txt1 = $this->input->post('txt1');
			$txt2 = $this->input->post('txt2');
			$txt3 = $this->input->post('txt3');
			
			$txtid = $this->input->post('id');	
			$txt1=str_replace("'","\'",$txt1);
			$txt2=str_replace("'","\'",$txt2);
			
			$sql_insert = "UPDATE `$_Tbl` SET $_f1='". $txt1 . "', $_f2='". $txt2 . "', $_f4='". $txt3 . "' where $_f3='".$txtid."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);	
		}
		
		if($type == 'delete')
		{
			$sql_insert = "delete from $_Tbl Where $_f3='".$id."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$txt1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						$txt2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						$txt3 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						$txt1=str_replace("'","\'",$txt1);
						$txt2=str_replace("'","\'",$txt2);

						$sql_insert = "INSERT INTO `$_Tbl`(`$_f1`, `$_f2`, `$_f4`) VALUES  ('" . $txt1  . "','" . $txt2 . "','" . $txt3 . "')";
						$this->db->query($sql_insert);

					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}
	
	function patient($type='', $id='')
	{
		
		$data['page_url'] = $page_url = "patient";
		$data['__siteurl'] = base_url() . "admin/";
		
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
			
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/list', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'add')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/add', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'add_error')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/add_error', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'save')
		{
			
			if($this->input->post('hrno_result') == 'Ok')
			{
			
				
				
				$sql_insert = "INSERT INTO `tblpatient`
				(chartid, `hrno`, `version`, `lname`, `fname`, `gender`, `dob`, `province`, `plan`, `notes`, `home_no`, `mobile_no`, `email`, `address`) 
				VALUES 
				('" . $this->input->post('chartid')  . "','" . $this->input->post('hrno')  . "','" . $this->input->post('version') . "','" . $this->input->post('lname') . "',
				'" . $this->input->post('fname')  . "','" . $this->input->post('gender') . "','" . date('Y-m-d', strtotime($this->input->post('dob'))) . "',
				'" . $this->input->post('province')  . "','" . $this->input->post('plan') . "','" . $this->input->post('notes') . "',
				'" . $this->input->post('home_no')  . "','" . $this->input->post('mobile_no') . "','" . $this->input->post('email') . "',
				'" . $this->input->post('address')  . "')";
				$this->db->query($sql_insert);				
				redirect(base_url() . "admin/"."".$page_url);
			}else{
				
				$_URL = "chartid=".$this->input->post('chartid')."&hrno=" . $this->input->post('hrno') ."&version=" . $this->input->post('version') 
				. "&lname=" . $this->input->post('lname') . "&fname=" . $this->input->post('fname')  . "&gender=" . $this->input->post('gender') . "&dob=" . date('Y-m-d', strtotime($this->input->post('dob'))) . "',
				&province=" . $this->input->post('province')  . "&plan=" . $this->input->post('plan') . "&notes=" . $this->input->post('notes') . "',
				&home_no=" . $this->input->post('home_no')  . "&mobile_no=" . $this->input->post('mobile_no') . "&email=" . $this->input->post('email') . "',
				&address=" . $this->input->post('address');
				//echo "<br>";
				
				$UUU = base64_encode($_URL);
				
				redirect(base_url() . "admin/".$page_url."/add?msg=error&d=".$UUU);
			}
			
			
//			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'save_ajax')
		{
			$hrno = $this->input->post('hrno');
			$sql = "SELECT * FROM patients WHERE ohip='" . $hrno. "'";
			$query=$this->db->query($sql);
			if($query->num_rows() <= 0)
			{
				$sql_insert = "INSERT INTO `patients`
					(id, `ohip`, `version`, `lname`, `fname`, `sexe`, `dob`, `province`, `plan`, `notes`, `home_tel`, `mobile_tel`, 
					`email`, `address`)  
				VALUES 
				('" . $this->input->post('chartid')  . "','" . $this->input->post('hrno')  . "','" . $this->input->post('version') . "','" . $this->input->post('lname') . "',
				'" . $this->input->post('fname')  . "','" . $this->input->post('gender') . "','" . date('Y-m-d', strtotime($this->input->post('dob'))) . "',
				'" . $this->input->post('province')  . "','" . $this->input->post('plan') . "','" . $this->input->post('notes') . "',
				'" . $this->input->post('home_no')  . "','" . $this->input->post('mobile_no') . "','" . $this->input->post('email') . "',
				'" . $this->input->post('address')  . "')";
				$this->db->query($sql_insert);				
				echo "saved";			
			}else{
				echo "already";
			}
		}
		
		if($type == 'save_other_ajax')
		{
			$sql_insert = "INSERT INTO `patients`
			(id, `ohip`, `version`, `lname`, `fname`, `sexe`, `dob`, `province`, `plan`, `notes`, `home_tel`, `mobile_tel`, 
			`email`, `address`) 
			VALUES 
			('" . $this->input->post('chartid')  . "','" . $this->input->post('hrno')  . "','" . $this->input->post('version') . "','" . $this->input->post('lname') . "',
			'" . $this->input->post('fname')  . "','" . $this->input->post('gender') . "','" . date('Y-m-d', strtotime($this->input->post('dob'))) . "',
			'" . $this->input->post('province')  . "','" . $this->input->post('plan') . "','" . $this->input->post('notes') . "',
			'" . $this->input->post('home_no')  . "','" . $this->input->post('mobile_no') . "','" . $this->input->post('email') . "',
			'" . $this->input->post('address')  . "')";
			$this->db->query($sql_insert);				
			echo "saved";			
		}
		
		if($type == 'edit')
		{
			$data['id'] = $id;
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'update_ajax')
		{	
			$hrno = $this->input->post('hrno');
			$sql = "SELECT * FROM patients WHERE ohip='" . $hrno. "'";
			$query=$this->db->query($sql);
			if($query->num_rows() <= 0)
			{
				$sql_Del = "DELETE FROM patients WHERE id='".$this->input->post('chartid')."'";
				$this->db->query($sql_Del);
				
				$sql_insert = "INSERT INTO `patients`
					(id, `ohip`, `version`, `lname`, `fname`, `sexe`, `dob`, `province`, `plan`, `notes`, `home_tel`, `mobile_tel`, 
					`email`, `address`)
				VALUES 
				('" . $this->input->post('chartid')  . "','" . $this->input->post('hrno')  . "','" . $this->input->post('version') . "','" . $this->input->post('lname') . "',
				'" . $this->input->post('fname')  . "','" . $this->input->post('gender') . "','" . date('Y-m-d', strtotime($this->input->post('dob'))) . "',
				'" . $this->input->post('province')  . "','" . $this->input->post('plan') . "','" . $this->input->post('notes') . "',
				'" . $this->input->post('home_no')  . "','" . $this->input->post('mobile_no') . "','" . $this->input->post('email') . "',
				'" . $this->input->post('address')  . "')";
				$this->db->query($sql_insert);
				echo "saved";
			}else{
				echo "already";
			}
			//redirect(base_url() . "admin/"."".$page_url);	
		}
		
		if($type == 'update_other_ajax')
		{	
	
			$sql_insert = "update  `patients`
			set id = '" . $this->input->post('chartid')  . "',`ohip` = '" . $this->input->post('hrno')  . "',`version` = '" . $this->input->post('version')  . "',
			`lname` = '" . $this->input->post('lname')  . "',`fname` = '" . $this->input->post('fname')  . "',`sexe` = '" . $this->input->post('gender')  . "',
			`dob` = '" . date('Y-m-d', strtotime($this->input->post('dob')))  . "',
			`province` = '" . $this->input->post('province')  . "',
			`plan` = '" . $this->input->post('plan')  . "',
			`notes` = '" . $this->input->post('notes')  . "',
			`home_tel` = '" . $this->input->post('home_no')  . "',
			`mobile_tel` = '" . $this->input->post('mobile_no')  . "',
			`email`= '" . $this->input->post('email')  . "',
			`address` = '" . $this->input->post('address')  . "'
			Where id = '" . $this->input->post('chartid')  . "'";
			$this->db->query($sql_insert);
			
			//redirect(base_url() . "admin/"."".$page_url);	
		}
		
		
		
		if($type == 'delete')
		{
			$sql_insert = "delete from patients Where id='".$id."'";
			$this->db->query($sql_insert);
			redirect(base_url() . "admin/"."".$page_url);
		}
		
		if($type == 'import_data')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/import_data', $data);
				$this->load->view('footer', $data);
			}
		}
		
		if($type == 'import')
		{
			if(isset($_FILES["file"]["name"]))
			{
				$path = $_FILES["file"]["tmp_name"];
				$object = PHPExcel_IOFactory::load($path);
				foreach($object->getWorksheetIterator() as $worksheet)
				{
					$highestRow = $worksheet->getHighestRow();
					$highestColumn = $worksheet->getHighestColumn();
					for($row=2; $row<=$highestRow; $row++)
					{
						$sql_insert = "INSERT INTO `patients`
					(id, `ohip`, `version`, `lname`, `fname`, `sexe`, `dob`, `province`, `plan`, `notes`, `home_tel`, `mobile_tel`, 
					`email`, `address`)
						VALUES 
						('" . $worksheet->getCellByColumnAndRow(0, $row)->getValue() . "','" . $worksheet->getCellByColumnAndRow(1, $row)->getValue()  . "','" . $worksheet->getCellByColumnAndRow(2, $row)->getValue() . "',
						
						
						'" . $worksheet->getCellByColumnAndRow(3, $row)->getValue() . "','" . $worksheet->getCellByColumnAndRow(4, $row)->getValue()  . "','" . $worksheet->getCellByColumnAndRow(5, $row)->getValue() . "',
						'" . $worksheet->getCellByColumnAndRow(6, $row)->getValue() . "','" . $worksheet->getCellByColumnAndRow(7, $row)->getValue()  . "','" . $worksheet->getCellByColumnAndRow(8, $row)->getValue() . "',
						
						'" . $worksheet->getCellByColumnAndRow(9, $row)->getValue() . "','" . $worksheet->getCellByColumnAndRow(10, $row)->getValue()  . "','" . $worksheet->getCellByColumnAndRow(11, $row)->getValue() . "',
						'" . $worksheet->getCellByColumnAndRow(12, $row)->getValue() . "','" . $worksheet->getCellByColumnAndRow(13, $row)->getValue() . "')";
						$this->db->query($sql_insert);

					}
				}
				redirect(base_url() . "admin/"."".$page_url);
			}	
		}
	}
	
	function claim_entry($type='', $id='')
	{
		$data['page_url'] = $page_url = "claim_entry";
		$data['__siteurl'] = base_url() . "admin/";
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		if($type == '')
		{
			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/add', $data);
				$this->load->view('footer', $data);
			}
		}
		if($type == 'review')
		{
			$data['id'] = $id;
 			if($this->session->userdata("Login_id") == ""){
				redirect(base_url() . "admin/"."login");
			}else{
				$this->load->view('header', $data);
				$this->load->view($page_url.'/edit', $data);
				$this->load->view('footer', $data);
			}
		}
		
	}
	
	function Submission()
	{
		$data['page_url'] = $page_url = "Submission";
		$data['__siteurl'] = base_url() . "admin/";
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			$this->load->view('header', $data);
			$this->load->view('submission', $data);
			$this->load->view('footer', $data);
		}
	}

	function submission_files()
	{
		$data['page_url'] = $page_url = "Submission";
		$data['__siteurl'] = base_url() . "admin/";
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			$this->load->view('header', $data);
			$this->load->view('submission_files', $data);
			$this->load->view('footer', $data);
		}
	}
	
	function transaction_history($status=0)
	{
		$data['page_url'] = $page_url = "transaction_history";
		$data['__siteurl'] = base_url() . "admin/";
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		if($this->session->userdata("Login_id") == ""){
			redirect(base_url() . "admin/"."login");
		}else{
			$this->load->view('header', $data);
			if($status == 0) { $this->load->view('transaction_history', $data); }
			if($status == 2) { $this->load->view('transaction_history_2', $data); }
			$this->load->view('footer', $data);
		}
	}
	
	public function claim_body_save()
	{
		$db_name = $this->session->userdata("db_name");
		
		$this->db->query('use '.$db_name.'');
		$physID = 0;
		if($this->input->post('Physician')=='Select')
		{
			$physID = 0;
		}
		else
		{
			$physID = $this->input->post('Physician');
		}
		/*INSERT INTO `tblclaim_entry_body`(`claim_entry_id`, `session_id`, `Diagnosis`, `Physician`, `service_date`, `eb_status`, 
		`service_code`, `serviceqty`, `txtunitfee`, `txttotalfee`, `Facility`, `admission_date`, 
		service_location_indicator,manual_review,
		`lab_no`) 
		*/// patient_id
		$sql = "INSERT INTO `processed_service_record`(`source_id`, `patient_id`, `service_code`, `service_fee`, `referral`, `num_serv`, 
		`lc`, `dx`, `service_date`, `facility_num`, `adm_date`, 
		`status`, `Submitted_Fee`, `lab_num`)
		VALUES (
		'". $this->input->post('claim_entry_id')."',
		'". $this->input->post('patient_id')."',
		'". $this->input->post('service_code')."',
		'". $this->input->post('txtunitfee')."',
		'". $physID ."',
		'". $this->input->post('serviceqty')."',
		'". $this->input->post('service_location_indicator')."',
		'". $this->input->post('Diagnosis')."',
		'". date('Y-m-d', strtotime($this->input->post('service_date')))."',
		'". $this->input->post('Facility')."',
		'". date('Y-m-d', strtotime($this->input->post('admission_date')))."',
		'". $this->input->post('eb_status')."',
		'". $this->input->post('txttotalfee')."',
		'". $this->input->post('lab_no')."')";
		
		$this->db->query($sql);
		$insert_id = $this->db->insert_id();
		$Claims_id = $this->input->post('claim_entry_id');
		$Header_ID = $this->General_model->ReturnRowValue("claims", "p_id", "processed_srv_header_id", $Claims_id);
		
		if($Header_ID == ''){
			$total_services = $this->General_model->Claim_services_by_claimid($Claims_id);
			$total_submitted = $this->General_model->Claim_Value_by_claimid($Claims_id);;
			$total_paid = 0;
			$status = "1";
			$error_code = "";
			 $sql_claims="INSERT INTO `claims`(`p_id`, `service_date`, `total_services`, 
			 `total_submitted`, `total_paid`, `error_code`, `status`, `date_created`, 
			 `date_updated`, `processed_srv_header_id`) VALUES ('". $this->input->post('patient_id')."',
			  '". date('Y-m-d', strtotime($this->input->post('service_date')))."',
			  '".$total_services."','".$total_submitted."','".$total_paid."','".$error_code."','".$status."',
			  '". date('Y-m-d', strtotime($this->input->post('service_date')))."',
			  '". date('Y-m-d', strtotime($this->input->post('service_date')))."',
			  '".$this->input->post('claim_entry_id')."')";
			
			$this->db->query($sql_claims);	
		}else{
			$total_services = $this->General_model->Claim_services_by_claimid($Claims_id);
			$total_submitted = $this->General_model->Claim_Value_by_claimid($Claims_id);;
			$total_paid = 0;
			$status = "1";
			$error_code = "";
			 $sql_claims_update="update `claims` set 
			 `p_id`= '".$this->input->post('claim_entry_id')."', 
			 `service_date`= '". date('Y-m-d', strtotime($this->input->post('service_date')))."', 
			 `total_services` = '".$total_services."',
			 `total_submitted` = '".$total_submitted."', 
			 `total_paid`  = '".$total_paid."',
			 `error_code` =  '".$error_code."',
 			 `status` =  '".$status."', 
			 `date_updated`=  '". date('Y-m-d', strtotime($this->input->post('service_date')))."'
			 Where `processed_srv_header_id` = '".$Claims_id."'";
			 $this->db->query($sql_claims_update);
		}
	}
	
	public function claim_master_save()
	{
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$__chartid = $this->input->post('chartid');
		$chartid = $this->iacsmodel->ReturnRowValue("tblpatient", "chartid", "hrno", $__chartid); 
		 
		$sql = "INSERT INTO `tblclaim_entry_master`(`Claim_id`, `session_id_master`, `chartid`, `service_date`, `c_e_status`) 
		VALUES (
		'". $this->input->post('Claim_id')."',
		'". $this->input->post('session_id')."',
		'". $chartid."',
		'". date('Y-m-d', strtotime($this->input->post('service_date')))."',
		'0')";
		$this->db->query($sql);
		
		$sql_update = "UPDATE tblclaim_entry_body SET claim_entry_id='". $this->input->post('Claim_id')."'  WHERE session_id='". $this->input->post('session_id')."'";
		$this->db->query($sql_update);
		redirect(base_url() . "admin/home");
	}
	
	public function claim_master_save_ajax()
	{
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$__chartid = $this->input->post('chartid');
		$chartid = $this->iacsmodel->ReturnRowValue("tblpatient", "chartid", "hrno", $__chartid); 
		 
		$sql = "INSERT INTO `tblclaim_entry_master`(`Claim_id`, `session_id_master`, `chartid`, `service_date`, `c_e_status`) 
		VALUES (
		'". $this->input->post('Claim_id')."',
		'". $this->input->post('session_id')."',
		'". $chartid."',
		'". date('Y-m-d', strtotime($this->input->post('service_date')))."',
		'0')";
		$this->db->query($sql);
		
		//$sql_update = "UPDATE tblclaim_entry_body SET claim_entry_id='". $this->input->post('Claim_id')."'  WHERE session_id='". $this->input->post('session_id')."'";
		//$this->db->query($sql_update);
		//redirect(base_url() . "admin/home");
	}
	
	
	public function claim_master_update()
	{
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		/*
		$__chartid = $this->input->post('chartid');
		$chartid = $this->iacsmodel->ReturnRowValue("tblpatient", "chartid", "hrno", $__chartid); 
		
		$claim_entry_id = $this->input->post('claim_entry_id');
		
		$sql = "UPDATE `tblclaim_entry_master` set 
		`Claim_id` = '". $this->input->post('Claim_id')."',
		`session_id_master`='". $this->input->post('session_id')."',
		`chartid`='". $chartid ."',
		`service_date`= '". date('Y-m-d', strtotime($this->input->post('service_date')))."',
		`c_e_status`=0 Where claim_entry_id='".$claim_entry_id."'";
		
		$this->db->query($sql);
		*/
		redirect(base_url() . "admin/home");
	}
	
	public function claim_date_update()
	{
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		$sql = "UPDATE `processed_service_record` set `service_date`= '". date('Y-m-d', strtotime($this->input->post('service_date')))."'
		WHERE `source_id` = '". $this->input->post('claim_entry_id')."'";
		$this->db->query($sql);
		/*
		$sql_body = "UPDATE `tblclaim_entry_body` set `service_date`= '". date('Y-m-d', strtotime($this->input->post('service_date')))."'
		WHERE `claim_entry_id` = '". $this->input->post('claim_entry_id')."'";		
		$this->db->query($sql_body);
		*/
		echo "updated";
	}
	
	public function find($types='')
	{
		$data['__siteurl'] = base_url() . "admin/";
		$data['types'] = $types;
		
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		if($types == 'diagnosis'){
			$data['_Tbl'] = $_Tbl = "diagnosis";
			$data['_fl'] = $_f1 = "code";
			$data['_f2'] = $_f2 = "Description";
			$data['_f3'] = $_f3 = "ID";
		}
		if($types == 'services'){
			$data['_Tbl'] = $_Tbl = "available_services";
			$data['_fl'] = $_f1 = "servicecode";
			$data['_f2'] = $_f2 = "description";
			$data['_f3'] = $_f3 = "id";			
		}
		if($types == 'Patient'){
			$data['_Tbl'] = $_Tbl = "patients";
			$data['_fl'] = $_f1 = "id";
			$data['_f2'] = $_f2 = "lname";
			$data['_f3'] = $_f3 = "id";
		}
		
		$this->load->view('header', $data);
		$this->load->view('find_data', $data);
		$this->load->view('footer', $data);

	}

	public function find_edit($types='')
	{
		$data['__siteurl'] = base_url() . "admin/";
		$data['types'] = $types;
		
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		
		if($types == 'diagnosis'){
			$data['_Tbl'] = $_Tbl = "tbldiagnosis";
			$data['_fl'] = $_f1 = "DiagnosisCode";
			$data['_f2'] = $_f2 = "DiagnosisDesc";
			$data['_f3'] = $_f3 = "DiagnosisId";
		}
		if($types == 'services'){
			$data['_Tbl'] = $_Tbl = "tblservices";
			$data['_fl'] = $_f1 = "servicesCode";
			$data['_f2'] = $_f2 = "servicesDesc";
			$data['_f3'] = $_f3 = "servicesId";			
		}
		if($types == 'Patient'){
			$data['_Tbl'] = $_Tbl = "tblpatient";
			$data['_fl'] = $_f1 = "hrno";
			$data['_f2'] = $_f2 = "lname";
			$data['_f3'] = $_f3 = "chartid";
		}
		
		$this->load->view('header', $data);
		$this->load->view('find_data_edit', $data);
		$this->load->view('footer', $data);

	}

	public function load_plan($pid)
	{
		$db_name = $this->session->userdata("db_name");
		if($db_name == ''){ redirect(base_url() . "admin/"."login"); }
		$this->db->query('use '.$db_name.'');
		//$provCode = $this->input->post('prov_code');
		
		$provCode = $pid;
		//$List = $this->iacsmodel->ReturnArrayValue("tblplan", "provCode", "$provCode", "planCode", 'asc'); 	
		$sql="select * from tblplan where provCode = '$provCode'";
		$query=$this->db->query($sql);
		$List = $query->result_array();
		foreach($List as $ListRows){
			$planCode = $ListRows['planCode'];
			$plan_arr[] = array("id" => $planCode, "name" => $planCode);

		}
		echo json_encode($plan_arr);

	}
	
	public function load_Sidebar()
	{		
		$this->load->view('sidebar');	
	}
	public function load_Sidebar_ajax()
	{		
		$this->load->view('sidebar_ajax');	
	}
	
	
	function hrno_check($a)
	{
		//$a = "8108876957";
		$LastNumber = "";
		$Final_1 = $Final_2 =$Final_3 = $Final_4 = $Final_5 = $Final_6 = $Final_7 = $Final_8 = $Final_9 = 0;
		
		for ($i = 0; $i < strlen($a); $i++){
			if($i == 9){ $LastNumber = $a[$i]; }
			if($i == 0){ 
				$R_1 = strval($a[$i] * 2); 
				if($R_1 >= 10){ for ($ai = 0; $ai < strlen($R_1); $ai++){ $Final_1 = $Final_1 + $R_1[$ai]; } }else{ $Final_2 = $R_1;}
			}
			if($i == 2){ 
				$R_1 = strval($a[$i] * 2); 
				if($R_1 >= 10){ for ($ai = 0; $ai < strlen($R_1); $ai++){ $Final_2 = $Final_2 + $R_1[$ai];  } }else{ $Final_2 = $R_1;}
			}
			if($i == 4){ 
				$R_1 = strval($a[$i] * 2); 
				if($R_1 >= 10){ for ($ai = 0; $ai < strlen($R_1); $ai++){ $Final_3 = $Final_3 + $R_1[$ai];  } }else{ $Final_3 = $R_1;}
			}
			if($i == 6){ 
				$R_1 = strval($a[$i] * 2); 
				if($R_1 >= 10){ for ($ai = 0; $ai < strlen($R_1); $ai++){ $Final_4 = $Final_4 + $R_1[$ai];  } }else{ $Final_4 = $R_1; }
			}
			if($i == 8){ 
				$R_1 = strval($a[$i] * 2); 
				if($R_1 >= 10){ for ($ai = 0; $ai < strlen($R_1); $ai++){  $Final_5 = $Final_5 + $R_1[$ai]; } }else{ $Final_5 = $R_1; }
			}
			if($i == 1){ $Final_6 = $a[$i]; }
			if($i == 3){ $Final_7 = $a[$i]; }
			if($i == 5){ $Final_8 = $a[$i]; }
			if($i == 7){ $Final_9 = $a[$i]; }
			
			$Final_Total = $Final_1+$Final_2+$Final_3+$Final_4+$Final_5+$Final_6+$Final_7+$Final_8+$Final_9;
		}
			//echo $Final_1.":".$Final_6.":".$Final_2.":".$Final_7.":".$Final_3.":".$Final_8.":".$Final_4.":".$Final_9.":>>".$Final_5;
			
			$Final_Total = strval($Final_Total);
			for ($_ai = 0; $_ai < strlen($Final_Total); $_ai++)
			{ 
				if($_ai == 1){ $_FT = $Final_Total[$_ai]; }
			}
			//echo "___". $_FT;
			//echo "___";
			$_Process_5 = 10 - $LastNumber;
			
			if($_Process_5 == $_FT){ echo "Ok"; }else{ echo "Wrong"; }
			
	}

}