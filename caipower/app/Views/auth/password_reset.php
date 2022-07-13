<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="/cdn-cgi/apps/head/ns59LyNWB_P3s_PU5b-1nAM2Xe4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/styles.css');?>">
    <link rel="icon" href="https://i.imgur.com/mr6sxQf.png">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <style>
        body {
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
	font-family: "Open Sans", -apple-system, BlinkMacSystemFont, Roboto, "Helvetica Neue", Arial, sans-serif;
	font-size: 1rem;
	font-weight: 400;
	line-height: 1.5;
	color: rgb(108, 117, 125);
	text-align: left;
	background-color: rgb(233, 236, 239);
        }
    </style>
</head>

<body>
    <section class="height-100 bg-gradient-2">
        <div class="container h-100">
            <div class="row h-100 justify-content-center align-items-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card py-3 shadow-lg">
                        <div class="card-body">
                            <h1 class="h2 mb-4 text-center">Reset Password</h1>
                            <?php foreach($token as $tokens):?>
                            <form method="post" autocomplete="off" action="<?= base_url('auth/resetPass'); echo '/';?><?=$tokens->code?>">
                            <?php endforeach?>
                            <?php if(!empty(session()->getFlashdata('success'))) :?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                            <?php endif ?>
                            <?php if(!empty(session()->getFlashdata('fail'))) :?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                        <?php endif ?>

                                <div class="form-group"><input name="password" id="email" type="text" placeholder="New Password" class="form-control" required/>
                                <span class="text-danger d-flex justify-content-center mt-2"><?= isset($validation) ? display_error($validation,'password') : '' ?></span></div>

                                <div class="form-group"><input name="cpassword" id="email" type="text" placeholder="Confirm New Password" class="form-control" required/>
                                <span class="text-danger d-flex justify-content-center mt-2"><?= isset($validation) ? display_error($validation,'cpassword') : '' ?></span></div>
                                
                                <div class="d-flex justify-content-center g-recaptcha" data-sitekey="6Lc3WFAdAAAAANPyXUAaA0uWWnlcHmcm9TiHDErl" ></div>
                                <span class="text-danger d-flex justify-content-center mt-3"><?= isset($validation) ? display_error($validation,'g-recaptcha-response') : '' ?></span>

                            <br>

                                <div class="form-group"><button type="submit" class="btn btn-block btn-lg btn-primary">Reset password</button></div>
                            </form>
                            <div class="text-center text-small mt-3"><span>Already know your password? <a href="<?= site_url('auth');?>">Log in here</a></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
