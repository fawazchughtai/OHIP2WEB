<?php		
$chartid = 0;
$_chartid= 0;
$_chartid=isset($_GET['pid']) ? $_GET['pid'] : '0';
if($_chartid == 0)
{
	$_chartid = '';
}else{
	$_chartid = $this->General_model->ReturnRowValue("patients", "id", "id", "$_chartid"); 
}

$sd_t = isset($_GET['sd_t']) ? $_GET['sd_t'] : '0';
$sd = isset($_GET['sd']) ? $_GET['sd'] : date('m/d/Y');
$sid  = isset($_GET['sid']) ? $_GET['sid'] : '0';
$did  = isset($_GET['did']) ? $_GET['did'] : '0';
$mrecord = isset($_GET['mrecord']) ? $_GET['mrecord'] : '0';
$Cid = isset($_GET['Cid']) ? $_GET['Cid'] : '0';
$serviceqty = isset($_GET['serviceqty']) ? $_GET['serviceqty'] : '0';
?>
<div class="column is-9">
	<nav class="breadcrumb" aria-label="breadcrumbs">
		<ul>
			<li><a href="#">OHIP</a></li>
			<li class="is-active"><a href="#" aria-current="page"><?php echo $page_url; ?></a></li>
			<li><a href="#">New</a></li>
		</ul>
	</nav>
<form action="<?php echo base_url(); ?>admin/claim_master_save" method="post">	
	<section class="info-tiles">
		<div class="box">
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field">
						<label class="label">Claim #</label>
						<p class="control">
							<?php if($mrecord == 1){ 
							$V = $Cid;
							$Claim_id_n = $Cid;
							}else{
								$V ="";
								$Claim_id_n = $this->General_model->GetMaxRow("processed_service_record", "source_id", "1", "1");
							}
							?>
							
							<input type="hidden" name="Cid" id="Cid" value="<?php echo $Claim_id_n; ?>">
							
							<input class="input is-midden disabled" readonly type="text" name="Claim_id" id="Claim_id" value="<?php echo $V; ?>">
							
							
						</p>
					</div>

					<div class="field is-grouped is-grouped-centered" style="margin-top: 25px;">
						<p class="control">
						
							<?php $Claim_id_n = $this->General_model->GetMinRow("processed_service_record", "source_id", "1", "1"); 
							if($Claim_id_n == 0){ }else{ 
							$_Claim_id_n = $Claim_id_n -1;
							if($_Claim_id_n == 0){
								$_Claim_id_n = 1;
							}else{
								  
							}
							
							?>
							<a class="button is-light is-success" href="<?php echo $__siteurl . $page_url; ?>/review/<?php echo $Claim_id_n; ?>"> <<</a>
							<a class="button is-light is-success" disabled href="#"> >> </a>
							<?php } ?>
						</p>
								
					</div>				
				  </div>
				</div>
				
		</div>
		
		<div class="box columns" id="grp_patient">
				<div class="column is-9">
					<div class="field is-horizontal">
					  <div class="field-body">
						
						<?php //-- has-addons; ?>
					<div class="field " style="width: 194px;">
							<label class="label">Chart Id <br> </label>
							<div class="field has-addons">	
								<div class="control is-expanded">
								<div class="select is-fullwidth">
								  <select name="chartid" id="chartid">
								  <?php
									$List = $this->iacsmodel->ReturnArrayValue("patients", "1", "1", "id", 'asc'); 	
									foreach($List as $ListRows){
									?>
									<option <?php echo $_chartid == $ListRows['id'] ? 'selected' : ''; ?> value="<?php echo $ListRows['id']; ?>" title="<?php echo $ListRows['id']; ?>"><?php echo $ListRows['id']; ?> </option>
									<?php } ?>
									
								  </select>
								</div>
							  </div>
							  <div class="control">
								<button type="button" class="button is-primary" onclick="find('Patient')"><i class="fa fa-search"></i></button>
							  </div>
							</div>
					  
					</div>
						
						<div class="field">
						  <label class="label">Health Registration #</label>
						  <p class="control">
							<input class="input is-midden" type="text" name="hrno" disabled value="<?php echo $this->General_model->ReturnRowValue("patients", "ohip", "id", "$_chartid"); ?>">
						  </p>
						</div>
						
					  </div>
					</div>
					
					<div class="field is-horizontal">
					  <div class="field-body">
						<div class="field">
						  <label class="label">Last Name</label>
						  <p class="control">
							<input class="input is-midden" type="text" name="lname" disabled value="<?php echo $this->General_model->ReturnRowValue("patients", "lname", "id", "$_chartid"); ?>">
						  </p>
						</div>
						<div class="field">
						  <label class="label">First Name</label>
						  <p class="control">
							<input class="input is-midden" type="text" name="fname" disabled value="<?php echo $this->General_model->ReturnRowValue("patients", "fname", "id", "$_chartid"); ?>">
						  </p>
						</div>
					  </div>
					</div>
						
					<div class="field is-horizontal">
					  <div class="field-body">
						<div class="field">
						  <label class="label">Version</label>
						  <p class="control">
							<input class="input is-midden" type="text" name="version" disabled value="<?php echo $this->General_model->ReturnRowValue("patients", "version", "id", "$_chartid"); ?>">
						  </p>
						</div>
						
						<div class="field">
						  <label class="label">Date of Birth</label>
						  <p class="control">
							<?php 
							$dob = $this->General_model->ReturnRowValue("patients", "dob", "id", "$_chartid"); 
						if($dob == '1970-01-01' ){
							$_dob = '';
						}else{
							if($dob == '' ){
								$_dob = '';
							}else{
								$_dob = date('m/d/Y', strtotime($dob));
							}
						}
						
						?>
							<input class="input is-midden" type="text" name="dob" disabled value="<?php echo $_dob; ?>">
						  </p>
						</div>
					  </div>
					</div>
				</div>
				
				<div class="column">				
<br><br>				
					<?php if($_chartid == 0){ ?>
						<a class="button is-light is-info is-fullwidth" onclick="find('Patient')" onclick0="find_patient(chartid.value);">Find Patient</a>
						<br>						
						<a class="button is-light is-info is-fullwidth" title="Disabled button" disabled href="#"> Edit Patient</a>
						<br>
						<a class="button is-light is-info is-fullwidth" title="Disabled button" disabled href="#"> View History</a>
					<?php }else{ ?>
						<a class="button is-light is-info is-fullwidth" disabled>Find Patient</a>
						<br>
						<a class="button is-light is-info is-fullwidth " href="<?php echo $__siteurl;?>patient/edit/<?php echo $_chartid; ?>"> Edit Patient</a>
						<br>
						<a class="button is-light is-info is-fullwidth" href="<?php echo $__siteurl; ?>patient/history/<?php echo $chartid; ?>"> View History</a>					
					<?php } ?>
				</div>
		</div>
		
		<div class="box columns <?php echo $_chartid == '' ? 'disabledDiv' : ''; ?>" id="grp_service_date" style="margin-top:10px;">
				<div class="column is-9">
					<div class="field is-horizontal">
					  <div class="field-body">
						<div class="field">
						  <label class="label">Select Service Date</label>
						  <div class="control has-icons-right">
							<input class="input is-midden" readonly type="text" name="service_date" id="service_date" value="<?php echo $sd; //date('m/d/Y'); ?>">
							<span class="icon is-small is-right">
							  <i class="fa fa-calendar"></i>
							</span>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				<div class="column">		
					<input type="button" style="margin-top: 30px;" id="selected_date" class="button is-light is-primary" onclick="selected_dated_btn()" value="Enter Service">
					<input type="button" style="margin-top: 30px; display:none;" id="collect_date" class="button is-light is-primary" onclick="correct_date()" value="Correct Date">
					
					<input type="hidden" id="sd_t" value="<?php echo $sd_t; ?>">
					
				</div>
		</div>
		
		<div class="box disabledDiv" id="grd_service">
			<p style="margin-bottom: 13px; font-weight: 900;"> Enter Services </p>
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field " style="width: 125px;">
							<label class="label f-12">Service Code </label>	
						<div class="field has-addons">
						  <div class="control is-expanded">
							<div class="select is-fullwidth">
							  <select name="service_code" class="cmb_style" id="service_code" >
								<?php
								$List = $this->iacsmodel->ReturnArrayValue("available_services", "1", "1", "id", 'asc'); 	
								foreach($List as $ListRows){
								?>
								<option <?php echo $sid == $ListRows['servicecode'] ? 'selected' : ''; ?> title="<?php echo $ListRows['servicefee']; ?>"><?php echo $ListRows['servicecode']; ?></option>
								<?php } ?>
							  </select>
							</div>
						  </div>
						  <div class="control">
							<button type="button" class="button is-primary" onclick="find('services')">
								  <i class="fa fa-search"></i>
							</button>
						  </div>  
						</div>
					</div>
					
					
					<div class="field">
					<label class="label f-12"># Service</label>
					  <p class="control">
						<input class="input is-midden" style="width:70px;" type="number" name="serviceqty" value="<?php echo $serviceqty; ?>" id="serviceqty" onchange="calc_amount()" placeholder="">
					  </p>
					</div>
					
					<div class="field " style="width: 125px;">
						<label class="label f-12">Diagnosis</label>
						<div class="field has-addons">  
						
						  <div class="control is-expanded">
							<div class="select is-fullwidth">
							  <select name="Diagnosis" class="cmb_style" id="Diagnosis">
								<?php
								$List = $this->iacsmodel->ReturnArrayValue("diagnosis", "1", "1", "ID", 'asc'); 	
								foreach($List as $ListRows){
								?>
								<option <?php echo trim($did) == $ListRows['ID'] ? 'selected' : ''; ?> value="<?php echo $ListRows['ID']; ?>"><?php echo trim($ListRows['code']); ?></option>
								<?php } ?>
								
							  </select>
							</div>
						  </div>
						  <div class="control">
							<button type="button" class="button is-primary" onclick="find('diagnosis')"><i class="fa fa-search"></i></button>
						  </div>  
						</div>
					</div>
					<div class="field">
						<label class="label f-12">Referring </label>
					  <p class="control">
						<div class="select">								
							<select class="select is-midden" id="Physician" class="cmb_style" name="Physician">
								<option>Select</option>
								<?php
								$List = $this->iacsmodel->ReturnArrayValue("referral", "1", "1", "id", 'asc'); 	
								foreach($List as $ListRows){
								?>
								<option title="<?php echo $ListRows['OHIP_Referral']; ?>" value="<?php echo $ListRows['id']; ?>"><?php echo $ListRows['Name']; ?></option>
								<?php } ?>
								
							</select>
						</div>
					  </p>
					</div>
					<div class="field">
					  <label class="label f-12">Provider Number</label>
					  <p class="control">
						<input class="input is-midden" style="Width:110px;" type="text" name="Physician_Contact" id="Physician_Contact">
					  </p>
					</div>
					
					<div class="field">
					<label class="label f-10">Service Location Indicator</label>
					  <p class="control">
						<div class="select">								
							<select class="select is-midden" id="service_location_indicator" style="width: 140px;" name="service_location_indicator">
								<option></option>
								<option>HDS</option>
								<option>HED</option>
								<option>HIP</option>
								<option>HOP</option>
								<option>HRP</option>
								<option>IHF</option>
								<option>OFF</option>
								<option>OTN</option>
								
							</select>
						</div>
					  </p>
					  <label class="manual_review"><input type="checkbox" id="manual_review" onchange="onChange_CheckBox()" name="manual_review">Manual Review</label>
					  <input type="hidden" id="manual_review2" name="manual_review2" value="0">
					  
					</div>
					
					
				  </div>
				</div>
				
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field">
					  <label class="label f-12">Unit Service Fee</label>
					  <p class="control">
						<input class="input is-midden" disabled type="text" value="<?php echo $this->General_model->ReturnRowValue("available_services", "servicefee", "servicecode", "$sid"); ?>" name="txtunitfee" id="txtunitfee">
					  </p>
					</div>
					
					<div class="field">
				      <label class="label f-12">Total Fee</label>
					  <p class="control">
						<input class="input is-midden" disabled type="text" name="txttotalfee" id="txttotalfee" >
					  </p>
					</div>
					
					<div class="field">
				      <label class="label f-12">Facility #</label>
					  <p class="control">
						<input class="input is-midden" type="text" name="Facility" id="Facility">
					  </p>
					</div>
					
					<div class="field">
				      <label class="label f-12">Admission Date</label>
					  <p class="control">
						<input class="input is-midden" type="text" name="admission_date" id="admission_date" readonly>
					  </p>
					</div>
					
					<div class="field">
				      <label class="label f-12">Lab #</label>
					  <p class="control">
						<input class="input is-midden" type="text" name="lab_no" id="lab_no">
					  </p>
					</div>
					
					<div class="field">
					  <p class="control">
						<input type="button" style="margin-top: 30px;" class="button is-light is-primary" onclick="add_rows()" value="Add">
						<input type="hidden" name="session_id" id="session_id" value="<?php echo $this->session->userdata('session_id'); ?>">
					  </p>
					</div>
					
				  </div>
				</div>
					
				
		</div>
		
		
		<div class="columns">
			<div class="column is-12">
					<div class="box">
						<div class="card-table is-full">
							<div class="content">
								<table class="table is-fullwidth " style="font-size: 12px;" id="data_row">
										<tr>
											<th>Service Date</tt>
											<th>Status</tt>
											<th>Service Code</tt>
											<th># Services</tt>
											<th>Service Fee</th>
											<th>Amount Submitted</th>
											<th>Amount Paid</th>
											<th>Error</th>
											<th>Action</th>
										</tr>
										<?php
										$db_name = $this->session->userdata("db_name");
										$this->db->query('use '.$db_name.'');
										if($V == ''){
											 //$sql="select * from tblclaim_entry_body where session_id='".$this->session->userdata('session_id')."'";
											 $sql="select * from processed_service_record where source_id=0";
											 
										}else{
											// session_id='".$this->session->userdata('session_id')."'
										 $sql="select * from processed_service_record where 1=1 And source_id=$V ";
										}
										$query=$this->db->query($sql);
										$List_d = $query->result_array();
										foreach($List_d as $ListRows){
										?>
										
										<tr>
											<td><?php echo date('m/d/Y', strtotime($ListRows['service_date'])); ?> </td>
											<td><?php 
											echo $ListRows['status'];
											/*
											if($ListRows['eb_status'] == 0){ echo "OPEN"; }
											if($ListRows['eb_status'] == 1){ echo "CREATED"; }
											if($ListRows['eb_status'] == 2){ echo "SUBMITTED"; } */
											?></td>
											<td><?php echo $ListRows['service_code']; ?></td>
											<td><?php echo $ListRows['num_serv']; ?></td>
											
											<td><?php echo $ListRows['service_fee']; ?></td>
											<td><?php echo $ListRows['num_serv']*$ListRows['service_fee']; ?></td>
											<td><?php //echo $ListRows['serviceqty']; ?></td>
											<td><?php //echo $ListRows['serviceqty']; ?></td>
											
											<td>
												<button class="button is-light is-danger" title="Delete" onclick="del_row(this,'<?php echo $ListRows['id']; ?>');" ><i class="fa fa-trash"></i></button>
											</td>
										</tr>
										<?php } ?>
									<tbody>
									
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					<div class="box" style="height: 110px;">
						<div class="content">
							<p style="float:left; font-weight: 900;">Total Amount Submitted:</p> <p style="font-weight: 900;" id="cal_amount">0</p>
							<div style="float:left;">
								<input type="button" class="button is-light is-success" id="btn_correct_patient" value="Another Patient" onclick="another_p()">
								<input type="button" class="button is-light is-success" id="btn_another_date" value="Another Date" onclick="change_date()">
								
								<input type="button" class="button is-light is-success" style="display:none;" id="btn_correct_date" value="Correct Date">
								<input type="hidden" id="master_record" value="<?php echo $mrecord; ?>">
								
							</div>
							<div style="float:right; display:none;" >
								<input type="submit" class="button is-light is-primary" value="Save">
								
							</div>
							
						</div>
					</div>
			</div>
		</div>

		
	</section>

</form>
	
</div>

<script>

$(document).ready(function() {
    $('#Physician_Contact').val('');   
    $('#Physician').change(function() {
         $('#Physician_Contact').val($(this).find("option:selected").attr("title"));
    });
	
	//$('#txtunitfee').val('');   
    $('#service_code').change(function() {
         $('#txtunitfee').val($(this).find("option:selected").attr("title"));
		 calc_amount();
    });
	
	var txtselected = $('#sd_t').val();
	if(txtselected == 1)
	{
		$('#grp_service_date').addClass('disabledDiv');
		$('#grd_service').removeClass('disabledDiv');		
		$('html,body').animate({
        scrollTop: $("#grd_service").offset().top},
        'slow');
	}
	calc_amount();	
});

function onChange_CheckBox()
{
	if($("#manual_review").is(':checked'))
		$("#manual_review2").val(1);  // checked
	else
		$("#manual_review2").val(0);  // unchecked
}

function add_rows()
{
rowno = 1;
var vservice_date = $('#service_date').val();
var veb_status = "OPEN";

var vClaim_id = $('#Claim_id').val();
var vservice_code = $('#service_code').val();
var vserviceqty = $('#serviceqty').val();
var vtxtunitfee = $('#txtunitfee').val();
var vtxttotalfee = $('#txttotalfee').val();
var vsession_id = $('#session_id').val();
var cal_amount = $('#cal_amount').html();
var vlab_no = $('#lab_no').val();
var vadmission_date = $('#admission_date').val();
var vFacility = $('#Facility').val();
var vsession_id = $('#session_id').val();
var cal_amount_total = parseFloat(cal_amount) + parseFloat(vtxttotalfee);
$('#cal_amount').html(cal_amount_total);

var vpatient_id = $('#chartid').val();
var vservice_location_indicator = $('#service_location_indicator').val();
var vmanual_review = $('#manual_review2').val();

if(vtxttotalfee == 0)
{
	alert('0 total fee is not acceptable, adding service  terminated');
	return false;
}
	VID = 0;
	var vclaim_entry_id = 0;
	vPhysician= $('#Physician').val();
	vDiagnosis = $('#Diagnosis').val();
	var vchartid = $('#chartid').val();
	
	var vclaim_entry_id = $('#Cid').val();
	$('#Claim_id').val(vclaim_entry_id);

var formData = {claim_entry_id: vclaim_entry_id, Diagnosis: vDiagnosis, Physician: vPhysician, service_date: vservice_date, 
eb_status: veb_status, service_code: vservice_code, serviceqty: vserviceqty, txtunitfee: vtxtunitfee, txttotalfee: vtxttotalfee, 
Facility: vFacility, admission_date: vadmission_date, lab_no: vlab_no, session_id: vsession_id,
manual_review: vmanual_review, service_location_indicator: vservice_location_indicator, patient_id : vpatient_id
}; //Array 
	$.ajax({
		url: '<?php echo base_url(); ?>admin/claim_body_save', // point to server-side controller method
		type: 'post',
		dataType: 'text',
		async: false,
        cache: false,
		data: formData,
		success: function (response) {
			VID = response;
		}
	});
	var row = $("<tr id='"+rowno+"'>");
// <button class="btn btn-default btn-icon-anim btn-circle" title="Edit" onclick="">
	row.append($("<td>"+vservice_date+"</td>"))
		.append($("<td>"+veb_status+"</td>"))
		.append($("<td>"+vservice_code+"</td>"))
		.append($("<td>"+vserviceqty+"</td>"))
		.append($("<td>"+vtxtunitfee+"</td>"))
		.append($("<td>"+vtxttotalfee+"</td>"))
		
		.append($("<td></td>"))
		.append($("<td></td>"))
		
		.append($('<td><button class="button is-light is-danger" title="Delete" onclick="del_row(this,'+VID+');" ><i class="fa fa-trash"></i></button></td>'))
		.append($('</tr>'));
		$("#data_row").append(row);
		
		$('#serviceqty').val(0);
		$('#txttotalfee').val(0);
		$('#lab_no').val('');
		$('#admission_date').val('');
		$('#Facility').val('');

var mrecord = $('#master_record').val();
$('#master_record').val(1);

<?PHP /*	
	if(mrecord == 0){
			
		var formData_master = {claim_entry_id: vclaim_entry_id, Claim_id: vclaim_entry_id, chartid: vchartid, session_id: vsession_id, service_date: vservice_date}; //Array 
			$.ajax({
				url: '<?php echo base_url(); ?>admin/claim_master_save_ajax', // point to server-side controller method
				type: 'post',
				dataType: 'text',
				async: false,
				cache: false,
				data: formData_master,
				success: function (response) {
					//alert(response);
					VID = response;
				},
				error: function (response) {
					alert('Error...');
				}
			});
	}
*/ ?>	
	load_sidebar();
}

function del_row(r, vid)
{
	var i = r.parentNode.parentNode.rowIndex;
	document.getElementById("data_row").deleteRow(i);
	
}
function find_patient(chartids)
{
	location.href = '<?php echo base_url(); ?>admin/claim_entry?pid='+chartids+'&sid=&did=';
	var chartid = $('#chartid').val();
	var services = $('#service_code').val();
	var Diagnosis = $('#Diagnosis').val();
	var mrecord = $('#master_record').val();
	var sd_t = $('#sd_t').val();
	var sd = $('#service_date').val();
	var Cid = $('#Cid').val();
	location.href = '<?php echo base_url(); ?>admin/find/'+types+'?pid='+chartid+'&sid='+services+'&did='+Diagnosis+'&sd='+sd+'&sd_t='+sd_t+'&mrecord='+mrecord+'&Cid='+Cid;

}

function find(types)
{
	var chartid = $('#chartid').val();
	var services = $('#service_code').val();
	var Diagnosis = $('#Diagnosis').val();
	var mrecord = $('#master_record').val();
	var sd_t = $('#sd_t').val();
	var sd = $('#service_date').val();
	var Cid = $('#Cid').val();
	var serviceqty = $('#serviceqty').val();
	location.href = '<?php echo base_url(); ?>admin/find/'+types+'?pid='+chartid+'&sid='+services+'&did='+Diagnosis+'&sd='+sd+'&sd_t='+sd_t+'&mrecord='+mrecord+'&Cid='+Cid+'&serviceqty='+serviceqty;
}

function calc_amount()
{
	var amount = $('#serviceqty').val() * $('#txtunitfee').val();
	$('#txttotalfee').val(amount);
}

function selected_dated_btn()
{
	$('#grp_service_date').addClass('disabledDiv');
	$('#grd_service').removeClass('disabledDiv');
	$('#sd_t').val('1');
	$('#btn_correct_date').show();
}
// grp_service_date
function change_date()
{
	<?php /*
	$('#grp_service_date').removeClass('disabledDiv');
	$('#grd_service').addClass('disabledDiv');
	$('#grd_patient').addClass('disabledDiv');
	
	$('#selected_date').hide();
	$('#collect_date').show();
	
	$('html,body').animate({
        scrollTop: $("#grp_service_date").offset().top},
        'slow');	
	*/ ?>
	var chartid = $('#chartid').val();
	//alert(chartid);
	location.href = '<?php echo base_url(); ?>admin/claim_entry?pid='+chartid;

}

function another_p()
{
	<?php /*
    $('#grp_patient').removeClass('disabledDiv');
	$('#grp_service_date').addClass('disabledDiv');
	$('#grd_service').addClass('disabledDiv');
	
	$('html,body').animate({
        scrollTop: $("#grp_patient").offset().top},
        'slow');
	*/ ?>
	location.href = '<?php echo base_url(); ?>admin/claim_entry';	
}

</script>