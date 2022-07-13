<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAI-Management</title>
    <meta name="description" content="None">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn"
        crossorigin="anonymous">
        <link rel="icon" href="https://i.imgur.com/mr6sxQf.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/admin.css');?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/alerts.css');?>">
    
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="/cdn-cgi/apps/head/ns59LyNWB_P3s_PU5b-1nAM2Xe4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    

    
<style>
    
    .dropdown.invi{
        display: none;
    }

    @media (max-width: 480px){
    
        .dropdown.invi{
        margin-left:-10px;
        display: block;
        }
        .dropdown-nav{
            display:none;
        }
    }

    .paginate ul li a{
    position: relative;
    display: block;
    padding: 0.5rem 0.75rem;
    margin-left: -1px;
    line-height: 1.25;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #dee2e6;
    border-radius: 5px;
    text-decoration: none;
    }

    .paginate ul .active a{
    
    color: white;
    background-color: #007bff;
    
    }

    div.checkbox.switcher label,
div.radio.switcher label {
	padding-top: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
}

div.checkbox.switcher label *,
div.radio.switcher label * {
	vertical-align: middle;
}

div.checkbox.switcher label input,
div.radio.switcher label input {
	display: none;
}

div.checkbox.switcher label input + span,
div.radio.switcher label input + span {
	position: relative;
	display: inline-block;
	margin-right: 10px;
	width: 56px;
	height: 28px;
	background-image: initial;
	background-position-x: initial;
	background-position-y: initial;
	background-size: initial;
	background-attachment: initial;
	background-origin: initial;
	background-clip: initial;
	background-color: rgb(242, 242, 242);
	border-top-width: 1px;
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: rgb(238, 238, 238);
	border-right-color: rgb(238, 238, 238);
	border-bottom-color: rgb(238, 238, 238);
	border-left-color: rgb(238, 238, 238);
	border-image-source: initial;
	border-image-slice: initial;
	border-image-width: initial;
	border-image-outset: initial;
	border-image-repeat: initial;
	border-top-left-radius: 50px;
	border-top-right-radius: 50px;
	border-bottom-right-radius: 50px;
	border-bottom-left-radius: 50px;
	transition-duration: 0.3s;
	transition-timing-function: ease-in-out;
	transition-delay: 0s;
	transition-property: all;
}

div.checkbox.switcher label input + span small,
div.radio.switcher label input + span small {
	position: absolute;
	display: block;
	width: 50%;
	height: 100%;
	background-image: initial;
	background-position-x: initial;
	background-position-y: initial;
	background-size: initial;
	background-attachment: initial;
	background-origin: initial;
	background-clip: initial;
	background-color: rgb(255, 255, 255);
	border-top-left-radius: 50%;
	border-top-right-radius: 50%;
	border-bottom-right-radius: 50%;
	border-bottom-left-radius: 50%;
	transition-duration: 0.3s;
	transition-timing-function: ease-in-out;
	transition-delay: 0s;
	transition-property: all;
	left: 0px;
}

div.checkbox.switcher label input:checked + span,
div.radio.switcher label input:checked + span {
	background-image: initial;
	background-position-x: initial;
	background-position-y: initial;
	background-size: initial;
	background-attachment: initial;
	background-origin: initial;
	background-clip: initial;
	background-color: rgb(38, 155, 255);
	border-top-color: rgb(38, 155, 255);
	border-right-color: rgb(38, 155, 255);
	border-bottom-color: rgb(38, 155, 255);
	border-left-color: rgb(38, 155, 255);
}

div.checkbox.switcher label input:checked + span small,
div.radio.switcher label input:checked + span small {
	left: 50%;
}

</style>
    
</head>

<body>
<?php if(!empty(session()->getFlashdata('warning'))) :?>
<div class="alert-warn show">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg"><?= session()->getFlashdata('warning'); ?></span>
        <span class="close-btn">
            <span class="fas fa-times"></span>
        </span>       
</div>                    
<?php endif ?>
<?php if(!empty(session()->getFlashdata('success'))) :?>
<div class="alert-success show">
        <span class="fas fa-check-circle"></span>
        <span class="msg"><?= session()->getFlashdata('success'); ?></span>
        <span class="close-btn-success">
            <span class="fas fa-times"></span>
        </span>       
</div>                    
<?php endif ?>
<?php if(!empty(session()->getFlashdata('fail'))) :?>
<div class="alert-fail show">
        <span class="fas fa-exclamation-circle"></span>
        <span class="msg"><?= session()->getFlashdata('fail'); ?></span>
        <span class="close-btn-fail">
            <span class="fas fa-times"></span>
        </span>       
</div>                    
<?php endif ?>
<div id="gb-sidebar" class="gb-vertical-nav bg-white collapsible-bar">
        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center"><img src="<?= base_url('public/uploads/default.png');?>" alt="..." width="65"
                    class="mr-3 rounded-circle img-thumbnail shadow-sm" />
                <div class="media-body">
                    <h4 class="m-0"><?= ucfirst($adminInfo['name']);?></h4>
                    <p class="tagadmin font-weight-light text-muted mb-0"><?= ucfirst($adminInfo['role']);?></p>
                   
                </div>
            </div>
        </div>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>
        <ul class="nav flex-column bg-white mb-0">
        <?php if($adminInfo['role']=='Teacher'):?>
            <li class="nav-item dropdown dropright"><a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    Lessons </a>
                <div aria-labelledby="navbarDropdown" class="dropdown-menu"><a href="<?= base_url('admin/lessons')?>" class="dropdown-item">Lessons Table</a><a href="<?= base_url('admin/lesson')?>" class="dropdown-item">New Lesson</a>
                    <div class="dropdown-divider"></div><a href="<?= base_url('admin/questions')?>" class="dropdown-item">Questions</a>
                    
                </div>
            </li>
            <li class="nav-item"><a href="<?= base_url('admin/lesson_archive')?>" class="nav-link text-dark bg-light">Lesson Archive</a></li>
            <li class="nav-item"><a href="<?= base_url('admin/question_archive')?>" class="nav-link text-dark bg-light">Question Archive</a></li>
        <?php else:?>
            <li class="nav-item"><a href="<?= base_url('admin/')?>" class="nav-link text-dark bg-light">Home</a></li>
            <li class="nav-item dropdown dropright"><a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    Lessons </a>
                <div aria-labelledby="navbarDropdown" class="dropdown-menu"><a href="<?= base_url('admin/lessons')?>" class="dropdown-item">Lessons Table</a><a href="<?= base_url('admin/lesson')?>" class="dropdown-item">New Lesson</a>
                    <div class="dropdown-divider"></div><a href="<?= base_url('admin/questions')?>" class="dropdown-item">Questions</a>
                </div>
            </li>
        <?php endif;?>
            
           
        </ul>
<?php if($adminInfo['role']=='Teacher'):?>
<?php else:?>
    <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Reports</p>
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item"><a href="<?= base_url('admin/events')?>" class="nav-link">Event Logs </a></li>
            <li class="nav-item dropdown dropright"><a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    Archives </a>
                <div aria-labelledby="navbarDropdown" class="dropdown-menu"><a href="<?= base_url('admin/user_archive')?>" class="dropdown-item">User Archives</a><a href="<?= base_url('admin/lesson_archive')?>" class="dropdown-item">Lesson Archives</a><a href="<?= base_url('admin/question_archive')?>" class="dropdown-item">Question Archives</a>
                         
                </div>
            </li>
            <li class="nav-item"><a href="<?= base_url('admin/administrator')?>" class="nav-link">Administrators</a></li>
            
            
        </ul>
<?php endif;?>
        
    </div>

    <div id="gb-main-bar-content" class="page-content collapsible-bar-1 pl-5 pr-5 pb-2">
        <div class="pull-right mt-3 justify-content-end d-flex"><button onclick="document.querySelector('.collapsible-bar').classList.toggle('active');" id="sidebarCollapse" type="button"
                class="btn btn-collapse rounded-pill btn-sm px-2 py-2 btn-dark"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" class="c2465">
                    <path d="M24 18v1h-24v-1h24zm0-6v1h-24v-1h24zm0-6v1h-24v-1h24z" fill="#1040e2"></path>
                    <path d="M24 19h-24v-1h24v1zm0-6h-24v-1h24v1zm0-6h-24v-1h24v1z"></path>
                </svg></button>
        
                <div class="dropdown-nav ml-4 mt-2"><button id="bulk-action-dropdown" type="button" data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> Hello, <?= ucfirst($adminInfo['role']);?> </button>
                                        <div aria-labelledby="bulk-action-dropdown" class="dropdown-menu dropdown-menu-right"><a href="<?= base_url('admin/settings')?>"
                                                class="dropdown-item">Settings</a><a href="<?= base_url('admin/logout')?>" class="dropdown-item">Log Out</a></div>
                </div>
        </div>
        <div class="container mt-3">
        <div class="row c28723">
            <div class="col-12 c28731 col-md-12 col-sm-12 col-xl-8 col-lg-8 mx-auto">
                <h2 data-type="header" id="ikjko3">Settings</h2>
                <hr />
                <div class="card">
                    <div class="card-body">
                    
<section class="bg-dark mb-3">
        <div class="container pt-4">
            <div class="row">
            <?php if(!empty($user)):?>
                    <?php foreach($user as $key):?>
                <div class="col-12 col-sm-12 col-md-12">
                    <p data-type="paragraph" class="text-center"><img width="100" height="100" data-type="image" src="<?= base_url('public/uploads');?>/<?= $key->profile;?>" id="iwm39a" style="border-radius: 50%;"/></p>
                    <section class="bdg-sect text-center text-light">
                        <h1 data-type="header" class="heading text-white"><?= $key->name;?></h1>
                        <p data-type="paragraph" class="paragraph"><i class="text-secondary"><?= $key->bio;?></i></p>
                    </section>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-xl-5 col-lg-5">
                    
                </div>
                
            </div>
        </div>
    </section>
                        <form id="lessonform" method="post" action="<?= base_url('admin/update_user');?>" enctype="multipart/form-data">
                        <?= csrf_field();?>
                            <div class="form-group"><label for="productName">Full Name:</label><input type="text" placeholder="John Doe" class="form-control" required name="name" value="<?= $key->name;?>"/></div>
                            <input type="hidden" class="form-control" required name="code" value="<?= $key->code;?>"/>
                            <div class="form-group"><label for="exampleInputName">Email Address:</label>
                            
                            <input type="text" placeholder="johndoe@rocketmail.com" class="form-control" required name="email" value="<?= $key->email;?>"/></div>
                            

                            <div class="form-group"><label for="exampleInputName">Enter Password:</label>
                            
                            <input type="text" placeholder="Atleast 5 character password" class="form-control" name="password" /></div>
                            

                            <div class="form-group"><label for="exampleInputName">Confirm Password:</label>
                           
                            <input type="text" placeholder="Match password" class="form-control"  name="cpassword" /></div>
                            
                            
                            <!-- <div class="form-group ">
                            <label for="inputState">User Role:</label>
                            
                            <select id="inputState" class="form-control col-md-6" name="role" required>
                                <option value="" selected>Select Option</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Administrator">Administrator</option>
                            </select>
                            </div> -->
                            <!-- <div class="form-group"><label for="exampleInputName">Available:</label>
                                <div class="checkbox switcher"><label for="test1"><input type="checkbox" id="test1" value="Yes" checked="" name="avail"/><span><small></small></span><small>Yes</small></label></div>
                            </div> -->
                            <button
                                type="submit" class="btn btn-outline-secondary">Update</button>
                        </form>
                        <?php endforeach;?>
                                    <?php else:?>
                                    <?php endif;?>
                    </div>
                </div>
                <div class="post-a-product mt-3">
                </div>
            </div>           
        </div>
    </div>
        
        

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#gb-main-bar-content').toggleClass('active');
            });
        });

    </script>
<script>    
    $('.alert-warn').removeClass("hide");
    $('.alert-warn').addClass("show");
    $('.alert-warn').addClass("showAlert");
    setTimeout(function(){
    $('.alert-warn').addClass("hide");
    $('.alert-warn').removeClass("show");
    },5000);
$('.close-btn').click(function(){
    $('.alert-warn').addClass("hide");
    $('.alert-warn').removeClass("show");
});

$('.alert-success').removeClass("hide");
    $('.alert-success').addClass("show");
    $('.alert-success').addClass("showAlert");
    setTimeout(function(){
    $('.alert-success').addClass("hide");
    $('.alert-success').removeClass("show");
    },5000);
$('.close-btn-success').click(function(){
    $('.alert-success').addClass("hide");
    $('.alert-success').removeClass("show");
});
$('.alert-fail').removeClass("hide");
    $('.alert-fail').addClass("show");
    $('.alert-fail').addClass("showAlert");
    setTimeout(function(){
    $('.alert-fail').addClass("hide");
    $('.alert-fail').removeClass("show");
    },5000);
$('.close-btn-fail').click(function(){
    $('.alert-fail').addClass("hide");
    $('.alert-fail').removeClass("show");
});
</script>   
</body>

</html>
