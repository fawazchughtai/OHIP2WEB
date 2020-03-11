<style>
.label
{  	  
	text-align: left;
}

</style>
			<div class="container has-text-centered">
                <div class="column is-12 ">
                    <h3 class="title has-text-grey">Change Password</h3>
                    <div class="box">
                        <form action="<?php echo $__siteurl; ?>change_password_update" method="post">
                            <?php
							$List = $this->iacsmodel->ReturnArrayValue_Master("tbl_master", "recid", $this->session->userdata("recid"), "recid", 'asc'); 	
							foreach($List as $ListRows){
							?>
							
							<div class="field is-horizontal">
							  <div class="field-body">
								<div class="field">
								<label class="label">E-Mail</label>
								  <p class="control">
									<input class="input is-large disable" readonly type="email" name="txtemail_new" value="<?php echo $ListRows['email']; ?>" readonly required>
								  </p>
								</div>
							 </div>
							</div>
							<div class="field is-horizontal">
							  <div class="field-body">	
								<div class="field" >
								<label class="label">Old Password</label>
								  <p class="control">
									<input class="input is-large" type="password" name="txtpassword_old" id="txtpassword_old" onblur="check_old_password();" required>									
								  </p>
								</div>
</div>
							</div>
							<div class="field is-horizontal">
							  <div class="field-body">

							  <div class="field" >
								<label class="label">New Password</label>
								  <p class="control">
									<input class="input is-large" type="password" id="txtpassword_new" name="txtpassword_new" value="<?php //echo $ListRows['txtpassword']; ?>" required>
								  </p>
								</div>
</div>
							</div>
							<div class="field is-horizontal">
							  <div class="field-body">								
								<div class="field" >
								<label class="label">Confirm Password</label>
								  <p class="control">
									<input class="input is-large" type="password" id="txtpassword_retry" name="txtpassword_retry" onblur="Check_passwod()" required>
								  </p>
								</div>
							  </div>
							</div>
						
                            <button class="button is-block is-info is-large is-fullwidth">Change Password</button>
							
							<input type="hidden" value="<?php echo $ListRows['recid']; ?>" name="recid">
							<?php } ?>
                        </form>
                    </div>
					
                    
                </div>
            </div>
        </div>
<script>
function Check_passwod()
{
	if( $('#txtpassword_new').val() == $('#txtpassword_retry').val() )
	{
	//	alert('Ok');
	}else{
		alert('Invalid Input, New Password and Confirm Password are not same...');
		$('#txtpassword_new').val('');
		$('#txtpassword_retry').val('');
		
	}
}

function check_old_password()
{
	var txtpassword_old = $('#txtpassword_old').val();
//	alert(txtpassword_old);
		$.ajax({
			url: '<?php echo $__siteurl; ?>password_check/'+txtpassword_old,
			dataType: 'text',
			async: false,
			type: 'GET',
			success: function(response) {
				if(response == 'ok')
				{
					
				}else{
					alert('Invalid Input, Incorrect Old Password...');
					$('#txtpassword_old').val('');
				}
			}
		});
}
</script>