<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - OHIP Web Application</title>
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <!-- Bulma Version 0.7.4-->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>asset/css/login.css">
</head>

<body>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Login</h3>
                    <p class="subtitle has-text-grey">Please login to proceed.</p>
                    <div class="box">
                        <!--figure class="avatar">
                            <img src="https://placehold.it/128x128">
                        </figure-->
                        <form action="<?php echo $__siteurl; ?>logincheck" method="post">
                            
							<div class="notification is-success"><button class="delete"></button>Please Check Mail </div>
							
							
							<div class="field">
                                <div class="control">
                                    <input class="input is-large" name="txtuser" type="text" placeholder="Your Email" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" name="txtpassword" type="password" placeholder="Your Password">
                                </div>
                            </div>
                            <div class="field">
                                <label class="checkbox">
                  <input type="checkbox">
                  Remember me
                </label>
                            </div>
                            <button class="button is-block is-info is-large is-fullwidth">Login</button>
                        </form>
                    </div>
					
                    <p class="has-text-grey">
                        <a href="<?php echo $__siteurl; ?>sign_up">Sign Up</a> &nbsp;·&nbsp;
                        <a href="<?php echo $__siteurl; ?>forgot_password">Forgot Password</a> 
                    </p>
                </div>
            </div>
        </div>
    </section>
    <script async type="text/javascript" src="../js/bulma.js"></script>
</body>

</html>
