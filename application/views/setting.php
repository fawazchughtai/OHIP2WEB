<style>
.label
{  	  
	text-align: left;
}

</style>
			<div class="container has-text-centered">
                <div class="column is-12 ">
                    <h3 class="title has-text-grey">Setting</h3>
                    <div class="box">
                        <form action="<?php echo $__siteurl; ?>setting_save" method="post">
                            <?php
							$List = $this->iacsmodel->ReturnArrayValue_Master("tbl_master", "recid", $this->session->userdata("recid"), "recid", 'asc'); 	
							foreach($List as $ListRows){
							?>
							<div class="field is-horizontal">
							  <div class="field-body">
								<div class="field">
								<label class="label">First Name</label>
								  <p class="control">
									<input class="input is-large" type="text" name="fname" value="<?php echo $ListRows['FirstName']; ?>" placeholder="First Name">
									
								  </p>
								</div>
								<div class="field">
								<label class="label">Last Name</label>
								  <p class="control">
									<input class="input is-large" type="text" name="lname" value="<?php echo $ListRows['LastName']; ?>" placeholder="Last Name">
								  </p>
								</div>
							  </div>
							</div>
							
							<div class="field ">
								<label class="label">Address</label>
								<div class="control">
								<input class="input is-large" name="txtaddress" type="text" value="<?php echo $ListRows['Address']; ?>"  required placeholder="Address">
                                </div>
                            </div>
							
							<div class="field is-horizontal">
							  <div class="field-body">
								<div class="field">
								<label class="label">City</label>
								  <p class="control">
									<input class="input is-large" type="text" name="txtcity" value="<?php echo $ListRows['City']; ?>"   placeholder="City">
								  </p>
								</div>
								<div class="field">
									<label class="label">Province</label>
								  <div class="control">
									<div class="select">
										<select class="input is-large" name="cmbProvince" >
											<option>Province</option>
											<?php
												$List22 = $this->iacsmodel->ReturnArrayValue_Master("tblprovince", "1", "1", "ProvName", 'asc'); 	
												foreach($List22 as $ListRows2){
												?>
												<option <?php echo $ListRows['Province'] == $ListRows2['ProvCode'] ? 'selected' : ''; ?> value="<?php echo $ListRows2['ProvCode']; ?>"><?php echo $ListRows2['ProvName']; ?> </option>
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
								<label class="label">Postal Code</label>
								  <p class="control">
									<input class="input is-large" type="text" name="txtPostalCode" value="<?php echo $ListRows['PostalCode']; ?>"   placeholder="PostalCode">
								  </p>
								</div>
								<div class="field">
								  <p class="control">
								  <label class="label">Phone No</label>
									<input class="input is-large" type="text" name="txtphone" value="<?php echo $ListRows['phoneno']; ?>"  placeholder="Phone Number">
								  </p>
								</div>
							  </div>
							</div>
							
							<div class="field is-horizontal">
							  <div class="field-body">
								<div class="field">
								<label class="label">E-Mail</label>
								  <p class="control">
									<input class="input is-large" type="email" name="txtemail_new" value="<?php echo $this->iacsmodel->ReturnPhysicianEmail(); ?>" placeholder="E-mail ">
								  </p>
								</div>
								<div class="field" style="display:none;">
								<label class="label">Password</label>
								  <p class="control">
									<!--<input class="input is-large" type="password" name="txtpassword_new" value="<?php echo $ListRows['txtpassword']; ?>" placeholder="Password">-->
									<input class="input is-large" type="password" name="txtpassword_new" value="<?php echo $ListRows['txtpassword']; ?>" placeholder="Password">
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
									<label class="label">Provider No</label>
								  <p class="control">
									<input class="input is-large" readonly type="text" name="txtpno" value="<?php echo $ListRows['provider_no']; ?>">
								  </p>
								</div>
								<div class="field">
									<label class="label">MOH Office Code</label>
								  <div class="control">
									<div class="select">
										<select class="input is-large " name="cmbmri_code" >
										<option value="">MOH Office Code</option>
											<?php
												$List2 = $this->iacsmodel->ReturnArrayValue_Master("tblmri", "1", "1", "mri_code", 'asc'); 	
												foreach($List2 as $ListRows22){
												?>
												<option <?php echo $ListRows['mricode'] == $ListRows22['mri_code'] ? 'selected' : ''; ?> value="<?php echo $ListRows22['mri_code']; ?>"><?php echo $ListRows22['mri_desc']; ?> </option>
												<?php } ?>
										</select>
									</div>
								  </div>
								</div>
								
							  </div>
							</div>
							
							
								<div class="field">
									<label class="label">Specialty Code</label>
									
								  <div class="control">
									<div class="select">
										<select class="input is-large " name="cmbspecialtycodes" >
											<option value="">Specialty Code</option>
											<?php
												$List1 = $this->iacsmodel->ReturnArrayValue_Master("tblspecialtycodes", "1", "1", "specialtydesc", 'asc'); 	
												foreach($List1 as $ListRows1){
												?>
												<option <?php echo $ListRows['specialtycodes'] == $ListRows1['specialtycode'] ? 'selected' : ''; ?> value="<?php echo $ListRows1['specialtycode']; ?>"><?php echo $ListRows1['specialtydesc']; ?> </option>
												<?php } ?>
										</select>
									</div>
								  </div>
								</div>
								<br>
								<div class="field">
								  <div class="control ">
									<label class="radio">
									  <input type="radio" <?php echo $ListRows['opt_info'] == 'P' ? 'checked' : ''; ?> value="P" name="question">
									  Opt-In
									</label>
									<label class="radio ">
									  <input type="radio" <?php echo $ListRows['opt_info'] == 'S' ? 'checked' : ''; ?> value="S" name="question">
									  Opt-Out
									</label>
								  </div>
								</div>


    					</div>
						
					
							<div class="box">
							<p class="">Credit Card Information</p>
							<br>
							
								<div class="field">
								<label class="label">Credit Card Number</label>									
								  <div class="control">
									<input class="input is-large" type="text" name="credit_card_no" value="<?php echo $ListRows['credit_card_no']; ?>">									
								  </div>
								</div>
								
								<br>
								<div class="field">
								<label class="label">Credit Card Type</label>
								  <div class="control ">
									<label class="radio">
									  <input type="radio" <?php echo $ListRows['card_type'] == 'Visa' ? 'checked' : ''; ?> value="Visa" name="card_type">
									  Visa
									</label>
									<label class="radio ">
									  <input type="radio" <?php echo $ListRows['card_type'] == 'Master Card' ? 'checked' : ''; ?> value="Master Card" name="card_type">
									  Master Card
									</label>
								  </div>
								</div>
								
								<div class="field">
								<label class="label">Card Holder Name</label>
								  <div class="control">
									<input class="input is-large" type="text" name="card_holder_name" value="<?php echo $ListRows['card_holder_name']; ?>">									
								  </div>
								</div>
								
								<div class="field is-horizontal">
								  <div class="field-body">
									<div class="field">
									<label class="label">Expiry Date (MM/YY)</label>
									  <p class="control">
										<input class="input is-large" type="text" name="Expiry_Date" value="<?php echo $ListRows['Expiry_Date']; ?>" >
									  </p>
									</div>
									<div class="field">
									<label class="label">CVV</label>
									  <p class="control">
										<input class="input is-large" type="text" name="CVV" value="<?php echo $ListRows['CVV']; ?>">
									  </p>
									</div>
								  </div>
								</div>
								
    					</div>
						
                            <button class="button is-block is-info is-large is-fullwidth">Save</button>
							
							<input type="hidden" value="<?php echo $ListRows['recid']; ?>" name="recid">
							<?php } ?>
                        </form>
                    </div>
					
                    
                </div>
            </div>
        </div>
   