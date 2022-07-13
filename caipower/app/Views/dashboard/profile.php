<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAI PowerPoint </title>
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="/cdn-cgi/apps/head/ns59LyNWB_P3s_PU5b-1nAM2Xe4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="https://i.imgur.com/mr6sxQf.png">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
   <link rel="stylesheet" href="<?= base_url('public/assets/css/home.css');?>">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   <style>
       .icon{
    font-size: 80px;
    color: #d14524;
    
}
   </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container"><a href="<?= site_url('dashboard/');?>" class="navbar-brand"><svg width="40" height="40" version="1.1" viewBox="-44.4 -13.7 595 319" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
            <path d="m214-9.87h-129c-66.5 0-125 55.4-125 126 0 70.1 56 129 127 129h88.6c8.22 0.156 23.7-2.36 35.2-9.98 10.1-6.68 15.1-11.2 22.4-22l69.6-120c3.5-5.58 6.27-10.1 12.9-15.7 7.47-6.23 13.8-7.95 23.5-8.41h78.3c27.5-1.19 51.1 21.3 51.1 48.9-5e-3 27.5-23.4 50-50.9 48.9h-66.7c-13.2 0.569-21.2 2.88-32.6 9.54-13 7.56-18.5 14.4-26.8 27.7l-57.9 99.7h90l22.7-38.5c4.44-7.66 8.57-11.6 16.4-15.7 6.95-3.6 11.7-4.7 19.6-4.51h39.1c66.5 0 124-55.7 125-125 1.43-71.4-54.8-130-129-130h-93.5c-14.7 0.081-30.6 6.43-36.2 10.1-8.67 5.71-18 13.9-25.3 25.9l-69.7 121c-4.13 6.02-6.46 9.2-12.5 13.1-7.26 4.69-12.7 5.28-21.1 5.82h-74.4c-26.4-1.19-46.8-22.5-46.8-48.9 0-26.4 20.4-47.7 46.8-48.9h83.7" style="fill:#d14524"/>
            </svg></a><button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"
                class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="<?= site_url('dashboard/');?>" class="nav-link">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a href="<?= site_url('dashboard/lessons');?>" class="nav-link">Lessons</a></li>
                    <li class="nav-item"><a href="<?= site_url('dashboard/mates');?>" class="nav-link">Mates</a></li>
                </ul>
                <form class="form-inline my-2 my-lg-0" action="<?= base_url('dashboard/search')?>"><input placeholder="Search" aria-label="Search" type="text" class="form-control mr-sm-2" name="search" /><button type="submit"
                        class="btn my-2 my-sm-0 btn-outline-secondary"><i class="fa fa-search fa-lg">
                        </i></button></form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown"><a href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                            <img src="https://img.icons8.com/wired/64/000000/cat-profile.png" width="30"
                            height="30"/></a>
                        <div aria-labelledby="dropdown01" class="dropdown-menu"><a href="#" class="dropdown-item">My Profile</a><a href="<?= site_url('dashboard/settings');?>" class="dropdown-item">Settings</a><a
                                href="<?= site_url('auth/logout');?>" class="dropdown-item">Logout</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<section class="bg-dark pb-3">
        <div class="container pt-5">
            <div class="row">
                <div class="col-12 col-md-12 col-sm-12 col-xl-3 col-lg-3">
                    <p data-type="paragraph" class="text-center"><img width="150" height="150" data-type="image" src="<?=base_url('public/uploads');?>/<?= ucfirst($userInfo['profile']);?>" id="iwm39a" /></p>
                    <a href="<?= site_url('dashboard/settings');?>">
                    <div class="follow-btn mx-auto text-center"><button class="btn mt-3 btn-outline-light">Edit Profile</button></div>
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-xl-5 col-lg-5">
                    <section class="bdg-sect text-center text-light">
                        <h1 data-type="header" class="heading text-white"><?= ucfirst($userInfo['name']);?> </h1>
                        <p data-type="paragraph" class="paragraph"><i class="text-secondary"><?= ucfirst($userInfo['bio']);?></i></p>
                    </section>
                </div>
                <!-- <div class="col-12 col-md-12 col-sm-12 col-lg-4 col-xl-4">
                    <div class="follow-btn-outer pb-5">
                        <div class="row p-3 mx-auto text-light m-3">
                            <div class="col-6">
                                <h2 data-type="header">0 </h2>
                                <p data-type="paragraph">Followers </p>
                            </div>
                            <div class="col-6">
                                <h2 data-type="header">0 </h2>
                                <p data-type="paragraph">Following </p>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <div class="container c28464">
        <div class="row c28723">
            <div class="col-xl-3 col-lg-3 c28731 col-md-12 col-sm-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center"><span class="link"><a href="#" class="text-secondary">Lessons</a></span><span
                                    class="badge badge-pill badge-base-color"><?php if(!empty($achcount)):?><?php foreach($lesscount as $key):?>
                        <?= $key->lesson_count?>
                    <?php endforeach;?>
                    <?php else:?>
                        0
                    <?php endif;?></span></li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"><span class="link"><a href="#" class="text-secondary">Achievements</a></span><span
                                    class="badge badge-pill badge-base-color"><?php if(!empty($achcount)):?>
                    <?php foreach($achcount as $key):?>
                        <?= $key->ach_count?>
                    <?php endforeach;?>
                    <?php else:?>
                        0
                    <?php endif;?></span></li>
                            
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-12 c28731 col-md-12 col-sm-12">
                <h2 data-type="header" id="i57nga4">Achievements </h2>
                <hr />
                
                <div class="upcoming-products mb-3">
                <?php if(!empty($ach)):?>
                    <?php foreach($ach as $key):?>
                        <div class="card mb-3 px-2 py-2">
                        <div class="row no-gutters">
                        <div class="icon" style="display: flex; align-items: center; justify-content: center;">
            <i class="fas <?= $key->icon?>"></i>
        </div>
                            <div class="col-md-10 col-10">
                                <div class="card-body product-card-body">
                                    <h5 data-type="header" class="card-title"><?= $key->achievement?> </h5>
                                    <p data-type="paragraph" class="card-text product-card-text"><?= $key->title?>. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php endforeach;?>
                    <?php else:?>
                    <h4 class="text-secondary"> Keep it up to gain Achievements!</h4>
                    <?php endif;?>
                    
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12 c28774 d-xs-none d-sm-none d-lg-block d-xl-block d-md-none">
                <h5 data-type="header">Finished Lessons </h5>
                <hr />
                <div class="card">
                <?php if(!empty($doneLess)):?>
                    <?php foreach($doneLess as $key):?>
                    <div class="card-body">
                        <div class="media">
                    
                            <div class="media-body">
                                <h5 data-type="header" class="mt-0 mb-1"><?= $key->title?> </h5> 
                            </div>
                    
                        </div><!-- <button class="btn btn-block mt-4 btn-outline-secondary">Learn More</button> -->
                    </div>
                    <?php endforeach;?>
                    <?php else:?>
                        <div class="card-body">
                        <div class="media">
                    
                        <div class="media-body">
                                <h5 data-type="header" class="mt-0 mb-1">Empty? </h5> Yup! It's empty. Do something! PowerPoint Template or whatever, just give us something!
                            </div>  
                    
                        </div><!-- <button class="btn btn-block mt-4 btn-outline-secondary">Learn More</button> -->
                    </div>
                        
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
