

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login </title>
<meta name="description" content="">
<meta name="author" content="">
<script src="/cdn-cgi/apps/head/ns59LyNWB_P3s_PU5b-1nAM2Xe4.js"></script><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="<?= base_url('public/assets/css/login.css');?>">
<link rel="icon" href="https://i.imgur.com/mr6sxQf.png">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</head>
<body>
<section class="row no-gutters p-0 height-100 align-items-initial">
<div class="col-lg d-lg-flex order-lg-2 height-30"><img src="https://source.unsplash.com/collection/404339/1600x900" alt="Image" class="bg-image" /></div>
<div class="col-lg-5 p-0 d-flex bg-white align-items-lg-center">
<div class="row no-gutters flex-fill justify-content-center">

<div class="col-11 col-md-8 col-lg-10 col-xl-9 py-4">
<?php if(!empty(session()->getFlashdata('fail'))) :?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                        <?php endif ?>

                        <?php if(!empty(session()->getFlashdata('success'))) :?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                        <?php endif ?>
<h1 class="h2 text-center">Login </h1>
<form action="<?= base_url('admin/check')?>" method="POST" autocomplete="off">
<div class="form-group"><label for="email">Email:</label><input id="email" placeholder="Enter your email address" type="email" class="form-control" name="email"/></div>
<span class="text-danger"><?= isset($validation) ? display_error($validation,'email') : '' ?></span>
<div class="form-group">
<div class="d-flex justify-content-between"><label for="password" class="text-dark">Password:</label><!-- <small><a href="#">Forgot password?</a></small> --></div><input id="password" placeholder="Choose a password" type="password" class="form-control" name="password"/>
</div>
<div class="form-group"><button type="submit" class="btn btn-block btn-lg btn-info">Log in</button></div>
<div class="form-group">

</div>
</form>

</div>
</div>
</div>
</section>
</body>
</html>