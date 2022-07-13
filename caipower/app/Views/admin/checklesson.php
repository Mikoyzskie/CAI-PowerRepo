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
    <script src="/cdn-cgi/apps/head/ns59LyNWB_P3s_PU5b-1nAM2Xe4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/admin.css');?>">

    <link rel="icon" href="https://i.imgur.com/mr6sxQf.png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <script src="assets/js/app.js"></script>

    
<style>
    .icon{
    font-size: 100px;
    color: #d14524;
    margin-bottom: 10px;
}


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

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="header mt-md-5 col-12 c28731 col-md-12 col-sm-12 col-xl-8 col-lg-8 mx-auto">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">

                                   
                                    <h1 class="header-title"> Check Entry </h1>
                                </div>
                                <div class="col-auto">
                                    <a onclick="history.back()" class="btn btn-primary lift" style="color: white;"> Go back </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    
<!-- test -->

                </div>
            </div>
            
            <div class="col-12 c28731 col-md-12 col-sm-12 col-xl-8 col-lg-8 mx-auto border rounded pb-4 mt-4">
            
            <!-- <i class="text-center text-danger">*If thumbnail did not show up, inserted thumbnail is invalid</i> -->
            <div class="row">
                

                    <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                    <h3 data-type="header" id="idzr2" class="mt-4">
                            
                                    <?php if(!empty($state)):?>
                                  
                                    Thumbnail: <?php echo $state;?>
                                    
                                    <?php else:?>
                                    <?php endif;?>
                                    
                        </h3>
                        <h3 data-type="header" id="idzr2" class="">
                            
                                    <?php if(!empty($title)):?>
                                  
                                        <?php echo $title;?>:
                                    
                                    <?php else:?>
                                    <?php endif;?>
                                    <?php if(!empty($avail)):?>
                                  
                                  <?php echo $avail?>
                              
                              <?php else:?>
                              <?php endif;?>
                        </h3>
                        
                        <h6>
                            <?php if(!empty($message)):?>                                  
                            <?php echo $message;?>                       
                            <?php else:?>
                            <?php endif;?>
                        </h6>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12"></div>
                </div>
                <hr />
                
                
    <div class="start_btns">
    <i class="text-center text-danger">*If icon did not show up, inserted icon is invalid</i>
        <div class="icon" style="display: flex; align-items: center; justify-content: center;">
            <?php if(!empty($icon)):?>                                       
            <i class="fas <?php echo $icon;?>"></i>
            <?php else:?>
            <?php endif;?>   
        </div>
        
        <div class="header_title">
        
            <h3 data-type="header" id="idzr2" class="mt-2 text-center">
            <?php if(!empty($achieve)):?>                                  
            <?php echo $achieve;?>                       
            <?php else:?>
            <?php endif;?>
            </h3>
            
  
        </div>
       
        
    
    </div>
    <i class="text-center text-danger">*If video did not show up, inserted video link is invalid</i>
    <div class="embed-responsive embed-responsive-16by9">
            <?php if(!empty($youtube)):?>                                  
                                   
            
        <iframe allowfullscreen="" src="<?php echo $youtube;?>" id="i6xdp4"
                        class="embed-responsive-item"></iframe></div>
        
            <?php else:?>
            <?php endif;?>
    
    
                
            </div>
            
        </div>

        

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#gb-main-bar-content').toggleClass('active');
            });
        });

    </script>

</body>

</html>
