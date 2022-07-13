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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

    
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <style>
#imcss{
    margin-top: -15px;
}
    
    .column{
        margin: auto;
    }
    #i7fh{
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
        #i7fh{
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
        #i7fh{
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
        #i7fh{
        width: 400px;
    }
    }
</style>
</head>

<body>
    <section class="hero is-light is-fullheight">
        <div id="iajj" class="hero-body">
            <div id="iinv" class="container has-text-centered">
                <div id="i7fh" class="column">
                    <div id="i2xip" class="box"><img type="img" src="<?= base_url('public/assets/img/head_logo.png');?>" id="iqoo5" />
                        <h3 id="ivd3" class="title has-text-black">Sign In</h3>
                        <p id="i0hj" class="subtitle has-text-black">Sign in to your account</p>
                        <form type="form" id="ibylj" method="post" action="<?= base_url('auth/check'); ?>" autocomplete="off">

                        <?= csrf_field();?>

                        <?php if(!empty(session()->getFlashdata('fail'))) :?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                        <?php endif ?>

                        <?php if(!empty(session()->getFlashdata('success'))) :?>
                            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                        <?php endif ?>
                        
                            <div class="field">
                                <div class="control"><input type="email" placeholder="Your Email" id="i64x9" required class="input is-large" name='email' value="<?= set_value('email') ?>" /></div>
                                <span class="text-danger"><?= isset($validation) ? display_error($validation,'email') : '' ?></span>
                            </div>
                            <div id="iitl4" class="field">
                                <div id="ir5mp" class="control is-rounded"><input type="password" placeholder="Your Password" id="i5rxb" required class="input is-large" name='password' value="<?= set_value('password') ?>"><i id="togglePassword"
                                        class="far fa-eye"></i></div>
                                
                                <span class="text-danger"><?= isset($validation) ? display_error($validation,'password') : '' ?></span>
                            </div>
                            <div class="field"><label id="izwol" class="checkbox"><a href="<?= site_url('auth/reset');?>" class="has-text-blue">Forgot Password?</a>
                            <div class="g-recaptcha mt-3" data-sitekey="6Lc3WFAdAAAAANPyXUAaA0uWWnlcHmcm9TiHDErl"></div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation,'g-recaptcha-response') : '' ?></span>
                                </label></div><button id="imcss" class="button is-block is-info is-large is-fullwidth">Login <i aria-hidden="true" class="fa fa-sign-in"></i></button>
                        </form>
                        <p id="iffuk" class="has-text-black">
                            <a href="<?= site_url('auth/register');?>">Need an account? Sign Up</a> | 
                            <a href="<?= site_url('auth/frequently_asked_questions');?>">FAQ</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#i5rxb');
     
      togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
