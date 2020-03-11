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
                <div class="column is-6 is-offset-2">
                    <h3 class="title has-text-grey">Sign Up Active</h3>
                    <p class="subtitle has-text-grey">Please Check your email and enter the avtive code here.</p>
                    <div class="box">
                        <figure class="avatar">
                            <img src="https://placehold.it/128x128">
                        </figure>
                        <form action="<?php echo $__siteurl; ?>sign_up_active_save" method="post">
                            
							<div class="field ">
								<div class="control">
								<input class="input is-large" name="txtcode" type="text" required placeholder="Enter Active Code">
                                </div>
                            </div>
							
                            <button class="button is-block is-info is-large is-fullwidth">Actived</button>
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
