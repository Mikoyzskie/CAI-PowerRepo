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
        </div>>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="header mt-md-5">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="header-pretitle"> Overview </h6>
                                    <h1 class="header-title"> Administrators /Teachers </h1>
                                </div>
                                <div class="col-auto">
                                    <a href="<?= base_url('admin/user')?>" class="btn btn-primary lift"> New Administrator </a>
                                </div>
                            </div>

                            

                            
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="row align-items-center">
                                <div class="col">
                                    <form class="row align-items-center mt-1" autocomplete="off" action="<?= base_url('admin/user_archive_search')?>">
                                        <div class="col-auto pr-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.315-4.315-9.73-9.731-9.73-5.315 0-9.73 4.315-9.73 9.73 0 5.366 4.315 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z">
                                                </path>
                                            </svg></div>
                                        <div class="col"><input type="search" placeholder="Search" class="form-control form-control-flush search" name="search"/></div>
                                    </form>
                                </div>
                                <div class="col-auto">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive p-3">
                            <table class="table table-sm table-nowrap card-table">
                                <thead>
                                    <tr>
                                        
                                        <th><a href="#" data-sort="orders-order" class="text-muted sort"> ID </a></th>
                                        <th><a href="#" data-sort="orders-product" class="text-muted sort"> User </a></th>
                                        <th><a href="#" data-sort="orders-date" class="text-muted sort"> Email </a></th>
                                        <th><a href="#" data-sort="orders-total" class="text-muted sort"> Code </a></th>
                                        <th><a href="#" data-sort="orders-status" class="text-muted sort"> Role </a></th>
                                        <th><a href="#" data-sort="orders-status" class="text-muted sort"> Status </a></th>
                                        
                                        <th colspan="2"><a href="#" data-sort="orders-method" class="text-muted sort"> Lock </a></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <?php if(!empty($users)):?>
                                    <?php foreach($users as $user):?>
                                    <tr class ="ml-4">
                                    
                                        <td class="orders-order"> <?= $user['id'];?> </td>
                                        <td class="orders-product"> <?= $user['name'];?> </td>
                                        <td class="orders-date"><?= $user['email'];?></td>
                                        <td class="orders-total"> <?= $user['code'];?></td>
                                        <td class="orders-total"> <?= $user['role'];?></td>
                                        <td class="orders-status">

                                            <?php if($user['active'] == 1):?>
                                                <div class="badge badge-success"> Activated </div>
                                            <?php else:?>
                                                <div class="badge badge-warning"> Pending </div>
                                            <?php endif;?>
                                        </td>
                                        <td class="orders-method">
                                            <?php if($user['attempt'] == 3):?>
                                                True
                                            <?php else:?>
                                                False
                                            <?php endif;?>
                                        </td>
                                        
                                    
                                        
                                    </tr>
                                    <?php endforeach;?>
                                    <?php else:?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="pagination mt-4" style="display: flex; justify-content: right;">
            
            
            <div class="paginate">
                
                    <?= $test = $pager->links()?>
                    
                    
                
            </div>
            </div>
            
        </div>
<script>
    $(document).ready(function (){
        $('.deletebtn').on('click',function (){
            $('#deletemodal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function(){
                return $(this).text();
            }).get();

            console.log(data);
            $('#delete_id').val(data[0]);
            $('#delete_name').val(data[1]);
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#gb-main-bar-content').toggleClass('active');
            });
        });

    </script>

</body>

</html>
