<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CAI POWER</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/styles.css');?>">
    <link rel="icon" href="https://i.imgur.com/mr6sxQf.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
<style>
    .column{
        margin: auto;
    }
    #irmv{
        width: 400px;
    }
    
@media (max-width: 480px){
    .g-recaptcha {
            transform:scale(0.85);
            -webkit-transform:scale(0.85);
            transform-origin:0 0;
            -webkit-transform-origin:0 0;
            margin: auto;
        }
        #irmv{
        width: 300px;
    }
    
    }
    @media (min-width: 768px){
    .g-recaptcha {
            transform:scale(0.88);
            -webkit-transform:scale(0.88);
            transform-origin:0 0;
            -webkit-transform-origin:0 0;
            margin-left: 34px;
        }
        #irmv{
        width: 400px;
    }
    }
    
    @media (min-width: 992px){
    .g-recaptcha {
            transform:scale(0.88);
            -webkit-transform:scale(0.88);
            transform-origin:0 0;
            -webkit-transform-origin:0 0;
            margin-left: 34px;
        }
        #irmv{
        width: 400px;
    }
    }
</style>

</head>

<body >
    <section class="hero is-light is-fullheight">
        <div id="irdv" class="hero-body">
            <div id="ibym" class="container has-text-centered " >
                <div id="irmv" class="column is-centered">
                    <div id="ijkg" class="box">
                        <div id="ixthg" class="container"><img type="img" src="<?= base_url('public/assets/img/head_logo.png');?>" id="ihxt" /></div>
                        <h3 id="i4is" class="title has-text-black">Sign Up</h3>
                        <p id="irdz" class="subtitle has-text-black">Create a new account</p>
                        <form type="form" id="ifara" method="post" action="<?= base_url('auth/save');?>" autocomplete="off">

                        <?= csrf_field();?>
                        <?php if(!empty(session()->getFlashdata('fail'))) :?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                        <?php endif ?>

                        <?php if(!empty(session()->getFlashdata('success'))) :?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                        <?php endif ?>

                            <input type="text" required placeholder="Enter Fullname"  id="iizxy" class="input is-large" name="name" value="<?= set_value('name');?>"/>
                        <div class="field">
                            <div id="ik8oc" class="control"></div>
                        </div>
                        <input type="email" required placeholder="Enter Email" id="ij5n3" class="input" name="email" value="<?= set_value('email');?>"/>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation,'email') : '' ?></span>
                            
                        <div class="field">
                            <div class="control"></div>
                        </div>
                            <div class="field">
                                <div class="control">
                                    
                                <input type="password" required placeholder="Enter Password" id="i9mb3" class="input is-large" name="password" value="<?= set_value('password');?>"/>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation,'password') : '' ?></span>
                                </div>
                            </div>
                            
                            <input type="password" required placeholder="Confirm Password" id="irago" class="input is-large" name="cpassword" value="<?= set_value('cpassword');?>"/>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation,'cpassword') : '' ?></span>
                            <div class="field"></div>
                            
                            
                            <div class="g-recaptcha" data-sitekey="6Lc3WFAdAAAAANPyXUAaA0uWWnlcHmcm9TiHDErl"></div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation,'g-recaptcha-response') : '' ?></span>
                            

                            <button id="iyu6x" class="button is-block is-info is-large is-fullwidth" type="submit">Register<i id="itsfp"
                                    draggable="true" aria-hidden="true" class="fa fa-sign-in"></i>
                            </button>
                        </form>
                        <p id="iex84" class="has-text-black mt-2"><a href="<?= site_url('auth');?>">Already have an account? Sign In</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
</body>

</html>
