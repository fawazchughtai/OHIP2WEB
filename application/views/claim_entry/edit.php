<?php		
$total = 0;
//$Claim_id = $id;
$claim_entry_id = $id;
$Claim_id = $this->General_model->ReturnRowValue("processed_service_record", "source_id", "source_id", "$id");
if($Claim_id == ''){ $Claim_id = 0; }
//$session_id_master = $this->General_model->ReturnRowValue("processed_service_record", "session_id_master", "claim_entry_id", "$id");
$session_id_master ="";
$chartid=isset($_GET['pid']) ? $_GET['pid'] : '0';
$sid=isset($_GET['sid']) ? $_GET['sid'] : '0';
$did=isset($_GET['did']) ? $_GET['did'] : '0';
$serviceqty=isset($_GET['serviceqty']) ? $_GET['serviceqty'] : '0';
?>

<div class="column is-9">
	<nav class="breadcrumb" aria-label="breadcrumbs">
		<ul>
			<li><a href="#">OHIP</a></li>
			<li><a href="#" aria-current="page">Claim Entry</a></li>
			<li class="is-active"><a href="#" aria-current="page">Review </a></li>
			
		</ul>
	</nav>
<form action="<?php echo base_url(); ?>admin/claim_master_update" method="post">	
	<section class="info-tiles">
		<div class="box">
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field">
					  <label class="label">Claim #</label>
					  <p class="control">
						<input class="input is-midden disabled" readonly type="text" name="Claim_id" id="Claim_id" value="<?php echo $this->General_model->ReturnRowValue("processed_service_record", "source_id", "source_id", "$id"); ?>">
						<input type="hidden" name="Cid" id="Cid" value="<?php echo $this->General_model->ReturnRowValue("processed_service_record", "source_id", "source_id", "$id"); ?>">
						
						
					  </p>
					</div>
					
					<div class="field is-grouped is-grouped-centered" style="margin-top: 25px;">
						<p class="control">
							
							<?php 
							$Claim_id_n = $this->General_model->GetMinRow("processed_service_record", "source_id", "1", "1"); 
							$PNR = $Claim_id_n - $Claim_id;
							if($PNR == 0){ $Res = 'disabled'; }else{ $Res = ''; }
							
							if($Res == 'disabled'){ ?>
								<a class="button is-light is-success" <?php echo $Res; ?> href="#"> << </a>
								
							<?php }else{ ?>
								<a class="button is-light is-success" <?php echo $Res; ?> href="<?php echo $__siteurl . $page_url; ?>/review/<?php echo $p = $Claim_id-1; ?>"> <<</a>
							<?php } ?>
							
							
							<?php 
							$Claim_id_n = $this->General_model->GetMax_Row("processed_service_record", "source_id", "1", "1"); 
							$NR = $Claim_id_n - $Claim_id;
							if($NR == 0){ $Res = 'disabled'; }else{ $Res = ''; 
							$NR = $Claim_id +1;
							}
							
							if($Res == 'disabled'){ ?>
								<a class="button is-light is-success" <?php echo $Res; ?> href="#"> >> </a>
								
							<?php }else{ ?>
								<a class="button is-light is-success" <?php echo $Res; ?> href="<?php echo $__siteurl . $page_url; ?>/review/<?php echo  $NR ;?>"> >> </a>								
							<?php } ?>
							
						</p>
						
					</div>
				  </div>
				</div>
				
		</div>
<?php $chartid = $this->General_model->ReturnRowValue("processed_service_record", "patient_id", "source_id", "$id"); ?>		
		<div class="box columns" id="grp_patient" >
				<div class="column is-9">
					<div class="field is-horizontal">
					  <div class="field-body">
						
						<div class="field " style="width: 194px;">
							<label class="label">Chart Id <br> </label>
							<div class="field has-addons">	
								<div class="control is-expanded">
								<div class="select is-fullwidth">
								  <select name="chartid" id="chartid">
								  <?php
									$_chartid = $this->General_model->ReturnRowValue("patients", "id", "id", "$chartid");
									//$_chartid = $this->General_model->ReturnRowValue("patients", "hrno", "chartid", "$chartid");
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
							<input class="input is-midden" type="text" name="hrno" disabled value="<?php echo $this->General_model->ReturnRowValue("patients", "ohip", "id", "$chartid"); ?>">
						  </p>
						</div>
						
					  </div>
					</div>
					
					<div class="field is-horizontal">
					  <div class="field-body">
						<div class="field">
						  <label class="label">Last Name</label>
						  <p class="control">
							<input class="input is-midden" type="text" name="lname" disabled value="<?php echo $this->General_model->ReturnRowValue("patients", "lname", "id", "$chartid"); ?>">
						  </p>
						</div>
						<div class="field">
						  <label class="label">First Name</label>
						  <p class="control">
							<input class="input is-midden" type="text" name="fname" disabled value="<?php echo $this->General_model->ReturnRowValue("patients", "fname", "id", "$chartid"); ?>">
						  </p>
						</div>
					  </div>
					</div>
						
					<div class="field is-horizontal">
					  <div class="field-body">
						<div class="field">
						  <label class="label">Version</label>
						  <p class="control">
							<input class="input is-midden" type="text" name="version" disabled value="<?php echo $this->General_model->ReturnRowValue("patients", "version", "id", "$chartid"); ?>">
						  </p>
						</div>
						
						<div class="field">
						  <label class="label">Date of Birth</label>
						  <p class="control">
						  <?php $dob = $this->General_model->ReturnRowValue("patients", "dob", "id", "$chartid"); 
						if($dob == '1970-01-01'){
							$_dob = '';
						}else{
							$_dob = date('m/d/Y', strtotime($dob));
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
					<?php if($chartid == 0){ ?>
						<a class="button is-light is-info is-fullwidth" onclick="find_patient(chartid.value);">Find Patient</a>
						<br>
						<a class="button is-light is-info is-fullwidth Disabled button" disabled href="#"> Edit Patient</a>
						<br>
						<a class="button is-light is-info is-fullwidth Disabled button" disabled href="#"> View History</a>
					<?php }else{ ?>
						<a class="button is-light is-info is-fullwidth Disabled button" disabled>Find Patient</a>
						<br>
						<a class="button is-light is-info is-fullwidth " href="<?php echo $__siteurl;?>patient/edit/<?php echo $chartid; ?>"> Edit Patient</a>
						<br>
						<a class="button is-light is-info is-fullwidth" href="<?php echo $__siteurl; ?>/edit/<?php echo $chartid; ?>"> View History</a>
					<?php } ?>
				</div>
		</div>
		
		
		<div class="box columns " style="margin-top:10px;" id="grp_service_date">
				<div class="column is-9">				
					<div class="field is-horizontal">
					  <div class="field-body">
						<div class="field">
						  <label class="label">Services Date</label>
						  <div class="control has-icons-right">
						  <?php $service_date = $this->General_model->ReturnRowValue("processed_service_record", "service_date", "source_id", "$id"); 
						if($service_date == '1970-01-01'){
							$_service_date = '';
						}else{
							$_service_date = date('m/d/Y', strtotime($this->General_model->ReturnRowValue("processed_service_record", "service_date", "source_id", "$id")));
						}
						
						?>
							<input class="input is-midden" readonly type="text" name="service_date" id="service_date" value="<?php echo $_service_date; ?>">
							<span class="icon is-small is-right">
							  <i class="fa fa-calendar"></i>
							</span>
						  </div>
						</div>
					  </div>
					</div>
				</div>
				
				<div class="column">		
					<input type="button" style="margin-top: 30px;" class="button is-light is-primary" onclick="update_date()" value="Correct Date">
				</div>
				
		</div>
		
				
		<div class="box " id="grd_service">
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
						<input class="input is-midden" style="width:70px;" type="number" value="<?php echo $serviceqty; ?>" name="serviceqty" id="serviceqty" onchange="calc_amount()" placeholder="">
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
								<option <?php echo trim($did) == $ListRows['ID'] ? 'selected' : ''; ?> value="<?php echo $ListRows['ID']; ?>">
									<?php echo trim($ListRows['code']); ?>
								</option>
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
						<input type="hidden" name="session_id" id="session_id" value="<?php echo $session_id_master; ?>">
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
										$_total = 0;
										$List = $this->iacsmodel->ReturnArrayValue("processed_service_record", "source_id", $id, "id", 'asc'); 	
										foreach($List as $ListRows){
										?>
										
										<tr>
											<td><?php echo date('m/d/Y', strtotime($ListRows['service_date'])); ?> </td>
											<td><?php 
											if($ListRows['status'] == 0){ echo "OPEN"; }
											if($ListRows['status'] == 1){ echo "CREATED"; }
											if($ListRows['status'] == 2){ echo "SUBMITTED"; }
											?></td>
											<td><?php echo $ListRows['service_code']; ?></td>
											<td><?php echo $ListRows['num_serv']; ?></td>
											
											<td><?php echo $ListRows['service_fee']; ?></td>
											<td><?php echo $txttotalfee = $ListRows['service_fee'] * $ListRows['num_serv']; 
											$_total = $_total + $txttotalfee;
											?></td>
											<td><?php //echo $ListRows['serviceqty']; ?></td>
											<td><?php //echo $ListRows['serviceqty']; ?></td>
											
											<td>
												<button class="button is-light is-danger" title="Delete" onclick="Del_Row(this,'<?php echo $ListRows['id']; ?>');" ><i class="fa fa-trash"></i></button>
											</td>
										</tr>
										<?php } ?>
									<tbody>
									
									</tbody>
								</table>
							</div>
						</div>
					</div>
					
					<div class="box" style="height: 115px;">
						<div class="content">
							<p style="float:left; font-weight: 900;">Total Amount Submitted:</p> <p style="font-weight: 900;" id="cal_amount"><?php echo $_total; ?></p>
							
							<div style="float:left;">
								
								<input type="button" class="button is-light is-success" id="btn_correct_patient" value="Another Patient" onclick="another_p()">
								
								
								<input type="button" class="button is-light is-success" id="btn_another_date" value="Another Date" onclick="another_date()">
								<input type="button" class="button is-light is-success" id="btn_correct_date" value="Correct Date" onclick="change_date()">
								
							</div>
							<div style="float:right;">
							<input type="hidden" name="claim_entry_id" value="<?php echo $claim_entry_id; ?>">
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
    });
	calc_amount();	
	
});

function update_date()
{
	vclaim_entry_id = <?php echo $claim_entry_id; ?>;
	var vservice_date = $('#service_date').val();
	var formData = {claim_entry_id: vclaim_entry_id, service_date: vservice_date };

	$.ajax({
		url: '<?php echo base_url(); ?>admin/claim_date_update', // point to server-side controller method
		type: 'post',
		dataType: 'text',
		async: false,
        cache: false,
		data: formData,
		success: function (response) {
			alert(response);
			//VID = response;
			alert('Services Date Correct Successfully...');
		},
		error: function (response) {
			alert('Error...');
		}
	});
	
	setTimeout(location.reload() , 1000);
}

function add_rows()
{
rowno = 1;
var vservice_date = $('#service_date').val();
var veb_status = "Open";

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
	alert('Some thing missing...');
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
			//alert(response);
			VID = response;
			
		},	
		error: function (response) {
			alert('Error...');
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
		
		load_sidebar();
}

function del_row(r, vid)
{
	var i = r.parentNode.parentNode.rowIndex;
	document.getElementById("data_row").deleteRow(i);
	
}
function find_patient(chartids)
{
	location.href = '<?php echo base_url(); ?>admin/claim_entry?pid='+chartids;
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
	var Claim_id = $('#Claim_id').val();
	
	location.href = '<?php echo base_url(); ?>admin/find_edit/'+types+'?Claim_id='+Claim_id+'&pid='+chartid+'&sid='+services+'&did='+Diagnosis+'&sd='+sd+'&sd_t='+sd_t+'&mrecord='+mrecord+'&Cid='+Cid+'&serviceqty='+serviceqty;
	
}

function calc_amount()
{
	var amount = $('#serviceqty').val() * $('#txtunitfee').val();
	$('#txttotalfee').val(amount);
}

function change_date()
{
	$('#grp_service_date').removeClass('disabledDiv');
	$('#btn_correct_date').hide();
	$('html,body').animate({
        scrollTop: $("#grp_service_date").offset().top},
        'slow');	
}

function another_date()
{
	var chartid = $('#chartid').val();
	location.href = '<?php echo base_url(); ?>admin/claim_entry?pid='+chartid;
}

function another_p()
{
	/*
    $('#grp_patient').removeClass('disabledDiv');
	$('html,body').animate({
        scrollTop: $("#grp_patient").offset().top},
        'slow');
		*/
	location.href = '<?php echo base_url(); ?>admin/claim_entry';
}

function onChange_CheckBox()
{
	if($("#manual_review").is(':checked'))
		$("#manual_review2").val(1);  // checked
	else
		$("#manual_review2").val(0);  // unchecked
}

</script>