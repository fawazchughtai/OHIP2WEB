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
                    <h3 class="title has-text-grey">Forgot Password</h3>
                    <p class="subtitle has-text-grey">Please enter email address.</p>
                    <div class="box">
                        <!--figure class="avatar">
                            <img src="https://placehold.it/128x128">
                        </figure-->
                        <form action="<?php echo $__siteurl; ?>forgot_check" method="post">
                            <div class="field">
                                <div class="control">
                                    <input class="input is-large" name="txtuser" type="text" placeholder="Your Email" autofocus="">
                                </div>
                            </div>

                            <button class="button is-block is-info is-large is-fullwidth">Send</button>
                        </form>
                    </div>
					
                    
                </div>
            </div>
        </div>
    </section>
    <script async type="text/javascript" src="../js/bulma.js"></script>
</body>

</html>
