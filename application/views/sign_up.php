<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - OHIP Web Application</title>
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.4-->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/css/login.css">
	<script src="<?php echo base_url(); ?>asset/jquery.min.js"></script>

</head>

<body>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-8 is-offset-2">
                    <h3 class="title has-text-grey">Sign Up</h3>
                    <p class="subtitle has-text-grey">Please Complete these fields.</p>
                    <div class="box">
                        
                        <form action="<?php echo $__siteurl; ?>sign_up_save" method="post">
                            
							<div class="field is-horizontal">
							  <div class="field-body">
								<div class="field">
								  
								  <p class="control">
									<label class="label">First Name</label>
									<input class="input is-large" type="text" name="fname">
									
								  </p>
								</div>
								<div class="field">
								  <p class="control">
									<label class="label">Last Name</label>
								  
									<input class="input is-large" type="text" name="lname">
								  </p>
								</div>
							  </div>
							</div>
							
							<div class="field ">
							
								<div class="control">
								<label class="label">Address</label>
								<input class="input is-large" name="txtaddress" type="text" required >
                                </div>
                            </div>
							
							<div class="field is-horizontal">
							  <div class="field-body">
								<div class="field">
								
								  <p class="control">
<label class="label">City</label>								
								<input class="input is-large" type="text" name="txtcity"  >
								  </p>
								</div>
								<div class="field">
								
								  <div class="control">
									<label class="label">Province</label>
									<div class="select">
										<select class="input is-large" name="cmbProvince" >
											<?php
												$List = $this->iacsmodel->ReturnArrayValue_Master("tblprovince", "1", "1", "ProvName", 'asc'); 	
												foreach($List as $ListRows){
												?>
												<option value="<?php echo $ListRows['ProvCode']; ?>"><?php echo $ListRows['ProvName']; ?> </option>
												<?php } ?>
										</select>
									</div>
								  </div>
								</div>
								
							  </div>
							</div>
							
							<div class="field is-horizontal">
							  <div class="field-body">
								<div class="field">
								  <p class="control">
								  <label class="label">Postal Code</label>
									<input class="input is-large" type="text" name="txtPostalCode"  >
								  </p>
								</div>
								<div class="field">
								  <p class="control">
								  <label class="label">Phone Number</label>
									<input class="input is-large" type="text" name="txtphone" >
								  </p>
								</div>
							  </div>
							</div>
							
							<div class="field is-horizontal">
							  <div class="field-body">
								<div class="field">
								  <p class="control">
									<label class="label">Email</label>
									<input class="input is-large" type="email" name="txtemail_new" onblur0="check_email_id(this.value)" >
								  </p>
								</div>
								<div class="field">
								  <p class="control">
								  <label class="label">Password</label>
									<input class="input is-large" type="password" name="txtpassword_new">
								  </p>
								</div>
							  </div>
							</div>
						
						<div class="box">
							<p class="">Billing Information</p>
							<br>
							<div class="field is-horizontal">
							  <div class="field-body">
								<div class="field">
								  <p class="control">
									<label class="label">Provider Number</label>
									<input class="input is-large" maxlength="6" type="text" name="txtpno">
									
								  </p>
								</div>
								<div class="field">
								  <div class="control">
								  <label class="label">MOH Office Code</label>
									<div class="select">
										
										<select class="input is-large " name="cmbmri_code" >
										
										<option value=""></option>
											<?php
												$List = $this->iacsmodel->ReturnArrayValue_Master("tblmri", "1", "1", "mri_code", 'asc'); 	
												foreach($List as $ListRows){
												?>
												<option value="<?php echo $ListRows['mri_code']; ?>"><?php echo $ListRows['mri_desc']; ?> </option>
												<?php } ?>
										</select>
										
										
									</div>
								  </div>
								</div>
								
							  </div>
							</div>
							
							
								<div class="field">
								  <div class="control">
								  <label class="label">Specialty Code</label>
									<div class="select">
										<select class="input is-large " name="cmbspecialtycodes" >
											<option value="">Specialty Code</option>
											<?php
												$List = $this->iacsmodel->ReturnArrayValue_Master("tblspecialtycodes", "1", "1", "specialtydesc", 'asc'); 	
												foreach($List as $ListRows){
												?>
												<option value="<?php echo $ListRows['specialtycode']; ?>"><?php echo $ListRows['specialtydesc']; ?> </option>
												<?php } ?>
										</select>
									</div>
								  </div>
								</div>
								<br>
								<div class="field">
								  <div class="control ">
									<label class="radio">
									  <input type="radio" value="1" name="question" checked>
									  Opt-In
									</label>
									<label class="radio ">
									  <input type="radio" value="0" name="question">
									  Opt-Out
									</label>
									
								  </div>
								</div>


    					</div>
					
                            <input type="submit" class="button is-block is-info is-large is-fullwidth" name="Sign Up">
                        </form>
                    </div>
					
                    
                </div>
            </div>
        </div>
    </section>
    
</body>

<script>

function check_email_id(txt_email)
{
	alert(txt_email);
	var postForm = { 'txt_email': txt_email };
	$.ajax({
		url:"<?php echo base_url(); ?>admin/email_address_check",
		method:"POST",
		data:postForm,
		contentType:false,
		cache:false,
		processData:false,
		success:function(data){
			alert(data);
		}
	})
}

</script>

</html>
