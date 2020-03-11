<?php $chartid = '';
	
$a = $_GET['d'];

echo $UUU = base64_decode($a);
echo "<br>";
//$matches = "hrno";
// chartid=8&hrno=3333333333&version=2&lname=Chupek*&fname=Michael*&gender=male&dob=2019-06-07', &province=ON&plan=HCP¬es=wwwwwwww', 
//&home_no=33333&mobile_no=7142734380&email=arfmultani@gmail.com', &address=1513 Marlborough Ave****
//
//parse_str($str, $UUU);

$arr = explode("&", $UUU, 2);
echo ":".$first = $arr[0];
echo "<br>:".$first = $arr[1];
echo "<br>:".$first = $arr[2];
echo "<br>:".$first = $arr[3];

/*
echo $output['hrno'];  // value
echo "<br>";
echo $output['lname'];  // value
*/
?>

<div class="column is-9">
	<nav class="breadcrumb" aria-label="breadcrumbs">
		<ul>
			<li><a href="#">System</a></li>
			<li class="is-active"><a href="#" aria-current="page"><?php echo $page_url; ?></a></li>
		</ul>
	</nav>
	
	<section class="info-tiles">
		<div class="box">
		
			<form action="<?php echo $__siteurl . $page_url; ?>/save" method="post" onsubmit="return check_health_number()">
				<p>Patient Information Mandatory fields</p>
				
				<div class="field ">
					<label class="label">Chart #</label>
					<div class="control">
						<input class="input is-large" readonly name="chartid" value="<?php echo $this->General_model->GetMaxRow("tblpatient", "chartid", "1", "1"); ?>" type="text" required>
					</div>
				</div>
				
				
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field">
					  <label class="label">Health Registration #</label>
					  <p class="control">
						<input class="input is-large" maxlength="10" type="text" name="hrno" id="hrno"  value="<?php echo $this->General_model->ReturnRowValue("tblpatient", "hrno", "chartid", "$chartid"); ?>">
						<input type="text" name="hrno_result" id="hrno_result">
					  </p>
					</div>
					<div class="field">
				      <label class="label">Version</label>
					  <p class="control">
						<input class="input is-large" type="text" name="version" value="<?php echo $this->General_model->ReturnRowValue("tblpatient", "version", "chartid", "$chartid"); ?>">
					  </p>
					</div>
				  </div>
				</div>
				
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field">
					  <label class="label">Last Name</label>
					  <p class="control">
						<input class="input is-large" type="text" name="lname" value="<?php echo $this->General_model->ReturnRowValue("tblpatient", "lname", "chartid", "$chartid"); ?>">
					  </p>
					</div>
					<div class="field">
				      <label class="label">First Name</label>
					  <p class="control">
						<input class="input is-large" type="text" name="fname" value="<?php echo $this->General_model->ReturnRowValue("tblpatient", "fname", "chartid", "$chartid"); ?>">
					  </p>
					</div>
				  </div>
				</div>
					
				<div class="field is-horizontal">
				  <div class="field-body">
					<div class="field" style="width: 310px;">
					  <label class="label">Gender</label>
					  <?php $gender = $this->General_model->ReturnRowValue("tblpatient", "gender", "chartid", "$chartid"); ?>
					  <p class="control">
						<label class="radio">
						  <input type="radio" value="male" name="gender" <?php echo $gender == "male" ? 'checked' : ''; ?> >
						  Male
						</label>
						<label class="radio ">
						  <input type="radio" value="female" name="gender" <?php echo $gender == "female" ? 'checked' : ''; ?>>
						  Female
						</label>
					  </p>
					</div>
					<div class="field">
				      <label class="label">Date of Birth</label>
					  <p class="control">
						<input class="input is-large" type="text" name="dob" autocomplete="off" id="service_date" value="<?php echo $this->General_model->ReturnRowValue("tblpatient", "dob", "chartid", "$chartid"); ?>">
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
									$province = $this->General_model->ReturnRowValue("tblpatient", "province", "chartid", "$chartid");
									$List22 = $this->iacsmodel->ReturnArrayValue("tblprovince", "1", "1", "ProvName", 'asc'); 	
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
						<input class="input is-large" type="text" name="home_no" value="<?php echo $this->General_model->ReturnRowValue("tblpatient", "home_no", "chartid", "$chartid"); ?>">
					  </p>
					</div>
					<div class="field">
				      <label class="label">Mobile No</label>
					  <p class="control">
						<input class="input is-large" type="text" name="mobile_no" value="<?php echo $this->General_model->ReturnRowValue("tblpatient", "mobile_no", "chartid", "$chartid"); ?>">
					  </p>
					</div>
				  </div>
				</div>				
				
				<div class="field ">
					<label class="label">Email</label>
					<div class="control">
						<input class="input is-large" name="email" type="email" value="<?php echo $this->General_model->ReturnRowValue("tblpatient", "email", "chartid", "$chartid"); ?>">
					</div>
				</div>
				
				<div class="field">
					<label class="label">Address</label>
					<div class="control">
						<textarea class="textarea is-large" name="address" rows="3" required><?php echo $this->General_model->ReturnRowValue("tblpatient", "address", "chartid", "$chartid"); ?></textarea>
					</div>
				</div>
				
				<div class="field">
					<label class="label">Notes</label>
					<div class="control">
						<textarea class="textarea is-large" name="notes" rows="5"><?php echo $this->General_model->ReturnRowValue("tblpatient", "notes", "chartid", "$chartid"); ?></textarea>
					</div>
				</div>
				
				<div class="field is-grouped is-grouped-centered">
				  <p class="control">
					<input type="submit" class="button is-light is-primary" value="Save">
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
	if(province =='ON')
	{
		$.ajax({
			url: '<?php echo base_url(); ?>admin/hrno_check/'+hrno,
			dataType: 'text',
			async: false,
			type: 'GET',
			success: function(response) {
				alert(response);
				$('#hrno_result').val(response);
			},
			error: function(x, e) {
			}
		});
	}else{
		return true;
	}
}
</script>