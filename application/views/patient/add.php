<?php $chartid = '';?>
<div class="column is-9">
	<nav class="breadcrumb" aria-label="breadcrumbs">
		<ul>
			<li><a href="#">System</a></li>
			<li class="is-active"><a href="#" aria-current="page"><?php echo $page_url; ?></a></li>
		</ul>
	</nav>
	
	<section class="info-tiles">
		<div class="box">
		
			<form name="patient" action="#" method="post" >
				<p>Patient Information Mandatory fields</p>
				
				<div class="field ">
					<label class="label">Chart #</label>
					<div class="control">
						<input class="input is-large" readonly name="chartid" id="chartid"  value="<?php echo $this->General_model->GetMaxRow("patients", "id", "1", "1"); ?>" type="text" required>
					</div>
				</div>
				
				
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field">
					  <label class="label">Health Registration #</label>
					  <p class="control">
						<input class="input is-large" maxlength="20" type="text" name="hrno" id="hrno"  value="<?php echo $this->General_model->ReturnRowValue("patients", "ohip", "id", "$chartid"); ?>">
						<input type="hidden" name="hrno_result" id="hrno_result">
					  </p>
					</div>
					<div class="field">
				      <label class="label">Version</label>
					  <p class="control">
						<input class="input is-large" type="text" id="version" name="version" value="<?php echo $this->General_model->ReturnRowValue("patients", "version", "id", "$chartid"); ?>">
					  </p>
					</div>
				  </div>
				</div>
				
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field">
					  <label class="label">Last Name</label>
					  <p class="control">
						<input class="input is-large" type="text" name="lname" id="lname" value="<?php echo $this->General_model->ReturnRowValue("patients", "lname", "id", "$chartid"); ?>">
					  </p>
					</div>
					<div class="field">
				      <label class="label">First Name</label>
					  <p class="control">
						<input class="input is-large" type="text" name="fname" id="fname" value="<?php echo $this->General_model->ReturnRowValue("patients", "fname", "id", "$chartid"); ?>">
					  </p>
					</div>
				  </div>
				</div>
					
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field" style="width: 310px;">
					  <label class="label">Gender</label>
					  <?php $gender = $this->General_model->ReturnRowValue("patients", "sexe", "id", "$chartid"); ?>
					  <p class="control">
						<label class="radio">
						  <input type="radio" value="M" id="gender" name="gender" <?php echo $gender == "M" ? 'checked' : ''; ?> >
						  Male
						</label>
						<label class="radio ">
						  <input type="radio" value="F" id="gender" name="gender" <?php echo $gender == "F" ? 'checked' : ''; ?>>
						  Female
						</label>
					  </p>
					</div>
					<div class="field">
				      <label class="label">Date of Birth</label>
					  <p class="control">
						<input class="input is-large" type="text" name="dob" autocomplete="off" id="service_date" value="<?php echo $this->General_model->ReturnRowValue("patients", "dob", "id", "$chartid"); ?>">
					  </p>
					</div>
				  </div>
				</div>
					
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field" style="width: 140px;">
					  <label class="label">Province</label>
					  <p class="control">
						  <div class="select" style="width: 404px;">
							<select class="input is-large" name="province" id="province" onchange="load_plan(this.value)">
								<option value="0">Select</option>
								<?php
									$province = $this->General_model->ReturnRowValue("patients", "province", "id", "$chartid");
									$List22 = $this->iacsmodel->ReturnArrayValue("cdprovince", "1", "1", "ProvName", 'asc'); 	
									foreach($List22 as $ListRows2){
									?>
									<option <?php echo $province == $ListRows2['ProvCode'] ? 'selected' : ''; ?> value="<?php echo $ListRows2['ProvCode']; ?>"><?php echo $ListRows2['ProvName']; ?> </option>
									<?php } ?>
							</select>
						  </div>
					  </p>
					</div>
					
					<div class="field">
				      <label class="label">Plan</label>
					  <p class="control">
							<div class="select">
							<select class="input is-large" name="plan" id="cmbplan" >
								<option>Select</option>
								<?php
								/*
									$plan = $this->General_model->ReturnRowValue("tblpatient", "plan", "chartid", "");
									$List22 = $this->iacsmodel->ReturnArrayValue("tblplan", "1", "1", "planCode", 'asc'); 	
									foreach($List22 as $ListRows2){
									?>
									<option <?php echo $plan == $ListRows2['planCode'] ? 'selected' : ''; ?> value="<?php echo $ListRows2['planCode']; ?>"><?php echo $ListRows2['planCode']; ?> </option>
									<?php } */?>
									
							</select>
						  </div>
					  </p>
					</div>
				  </div>
				</div>
<br>
				<div class="field is-horizontal" style="margin-top:30px;">
				  <div class="field-body">
					<div class="field">
					  <label class="label">Home Number</label>
					  <p class="control">
						<input class="input is-large" type="text" name="home_no" id="home_no" value="<?php echo $this->General_model->ReturnRowValue("patients", "home_tel", "id", "$chartid"); ?>">
					  </p>
					</div>
					<div class="field">
				      <label class="label">Mobile No</label>
					  <p class="control">
						<input class="input is-large" type="text" name="mobile_no" id="mobile_no" value="<?php echo $this->General_model->ReturnRowValue("patients", "mobile_tel", "id", "$chartid"); ?>">
					  </p>
					</div>
				  </div>
				</div>				
				
				<div class="field ">
					<label class="label">Email</label>
					<div class="control">
						<input class="input is-large" name="email" id="email" type="email" value="<?php echo $this->General_model->ReturnRowValue("patients", "email", "id", "$chartid"); ?>">
					</div>
				</div>
				
				<div class="field">
					<label class="label">Address</label>
					<div class="control">
						<textarea class="textarea is-large" id="address" name="address" rows="3" required><?php echo $this->General_model->ReturnRowValue("patients", "address", "id", "$chartid"); ?></textarea>
					</div>
				</div>
				
				<div class="field">
					<label class="label">Notes</label>
					<div class="control">
						<textarea class="textarea is-large" name="notes" id="notes" rows="5"><?php echo $this->General_model->ReturnRowValue("patients", "notes", "id", "$chartid"); ?></textarea>
					</div>
				</div>
				
				<div class="field is-grouped is-grouped-centered">
				  <p class="control">
					<input type="button" name="submit" class="button is-light is-primary" onclick="check_health_number()" value="Save">
				  </p>
				</div>
			</form>
		</div>
		
	</section>
</div>

<script>
function load_plan(pid)
{           
	if(pid == 0)
	{
		return false;
	}
	if(pid == 'ON')
	{
		$("#hrno").attr('maxlength','10');
	}else{
		$("#hrno").attr('maxlength','20');
	}
	    

    $('#cmbplan').empty().append('<option>Select</option>');        
    $.ajax({
            url: '<?php echo base_url(); ?>admin/load_plan/'+pid,
            dataType: 'json',
            type: 'POST',
            data: {"prov_code": pid},
            success: function(response) {
				var len = response.length;
					
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];        
                    $("#cmbplan").append("<option value='"+id+"'>"+name+"</option>");
                }

            },
            error: function(x, e) {

            }

        });

}

function check_health_number()
{
	var hrno = $('#hrno').val();        
	var province = $('#province').val();
	var vchartid = $('#chartid').val();
	var vhrno = $('#hrno').val();
	var vversion = $('#version').val();
	var vlname = $('#lname').val();
	var vfname = $('#fname').val();
	var vgender = $('#gender').val();
	var vdob = $('#service_date').val();
	var vprovince = $('#province').val();
	var vplan = $('#cmbplan').val();
	var vnotes = $('#notes').val();
	var vhome_no = $('#home_no').val();
	var vmobile_no = $('#mobile_no').val();
	var vemail = $('#email').val();
	var vaddress = $('#address').val();

		var formData_master = {chartid: vchartid, hrno: vhrno, version: vversion, lname: vlname, fname: vfname, gender: vgender, dob: vdob, 
		province: vprovince, plan: vplan, notes: vnotes, home_no: vhome_no, mobile_no: vmobile_no, email: vemail, address: vaddress}; //Array 
	
	if(province =='ON')
	{
		// url: '<?php echo base_url(); ?>api_hvn.php?hno='+hrno+'&vn='+vversion,
		$.ajax({
			url: '<?php echo base_url(); ?>admin/hrno_check/'+hrno,
			dataType: 'text',
			async: false,
			type: 'GET',
			success: function(response) {
				$('#hrno_result').val(response);
				if(response == 'Ok')
				{
					$.ajax({
						url: '<?php echo base_url(); ?>admin/patient/save_ajax', // point to server-side controller method
						type: 'post',
						dataType: 'text',
						async: false,
						cache: false,
						data: formData_master,
						success: function (response) {
							if(response == 'already')
							{
								alert('Health Registration # already register...');
								return false;
							}else{
								location.href = '<?php echo base_url(); ?>admin/patient';	
							}
							
						},
						error: function (response) {
							alert('Error...');
						}
					});
				}else{
					alert('Health registration is invalid. Cannot proceed');
					return false;
					
				}
			}
		});
		
	}else{
		$.ajax({
			url: '<?php echo base_url(); ?>admin/patient/save_other_ajax', // point to server-side controller method
			type: 'post',
			dataType: 'text',
			async: false,
			cache: false,
			data: formData_master,
			success: function (response) {
				//alert(response);
				location.href = '<?php echo base_url(); ?>admin/patient';	
			},
			error: function (response) {
				alert('Error...');
			}
		});
	}
}
</script>