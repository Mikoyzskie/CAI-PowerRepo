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
                <form class="form-inline my-2 my-lg-0" action="<?= base_url('dashboard/search')?>"><input placeholder="Search" aria-label="Search" type="text" class="form-control mr-sm-2" name="search" autocomplete="off"/><button type="submit"
                        class="btn my-2 my-sm-0 btn-outline-secondary"><i class="fa fa-search fa-lg">
                        </i></button></form><a href="<?= site_url('dashboard/post');?>" class="btn ml-2 btn-outline-secondary"><i class="fa fa-plus">
                    </i></a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown"><a href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                            <img src="https://img.icons8.com/wired/64/000000/cat-profile.png" width="30"
                            height="30"/></a>
                        <div aria-labelledby="dropdown01" class="dropdown-menu"><a href="<?= site_url('dashboard/profile');?>" class="dropdown-item">My Profile</a><a href="<?= site_url('dashboard/settings');?>" class="dropdown-item">Settings</a><a
                                href="<?= site_url('auth/logout');?>" class="dropdown-item">Logout</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container c28464">
        <div class="row c28723">
            <div class="col-xl-8 col-lg-8 col-12 c28731 col-md-12 col-sm-12 border rounded pb-4">
                
            <?php if(!empty($tutorials)):?>
            <?php foreach($tutorials as $tutorial):?>
                    
            
                <h4 data-type="header" id="i57nga4" class="mt-4">Microsoft PowerPoint</h4>
                <h3 data-type="header" id="idzr2"><?= $tutorial->title;?></h3>
                <h5 id="in45e" class="text-secondary">Computer Aided Instruction - Lessons</h5>
                <hr />
                <div class="embed-responsive embed-responsive-16by9"><iframe allowfullscreen="" src="<?= $tutorial->vid_link;?>" id="i6xdp4"
                        class="embed-responsive-item"></iframe></div>

            </div>
            <div class="col-xl-4 col-lg-4 col-md-8 col-sm-8 col-12 c28774">
                <h5 data-type="header" id="iyfgc">Lesson Progress</h5>
                <hr />
                <div class="card">
                    <div class="card-body">
                        <div class="media"><i class="fa fa-info-circle fa-2x mr-3" >
                            </i>
                            <div class="media-body">
                                <h5 id="ikoi8" draggable="true" data-highlightable="1" data-type="header" class="mt-0 mb-1">Description</h5><?= $tutorial->short_description;?>
                                
                                <h6 class="text-secondary mt-3">Quiz Score: 
                                <?php if(!empty($grades)):?>    
                                <?php foreach($grades as $grade):?><?= $grade->grade;?>
                                <?php endforeach;?>
                                <?php else:?>
                                    0
                                <?php endif;?>
                            
                                 /<?php foreach($counts as $counts):?> <?= $counts->NumberOfQuestion;?>
                                <?php endforeach;?>
                                </h6>
                            </div>
                        </div><a href="<?= site_url('dashboard/quiz?id=');?><?= $tutorial->id;?>" style="text-decoration: none;"><button class="btn btn-block mt-4 btn-outline-secondary">
                        <?php if(empty($grades)):?>
                        Take Quiz
                        <?php else:?>
                        Retake Quiz
                        <?php endif;?>
                        </button></a>
                    </div>
                </div>
            </div>
                    <?php endforeach;?>
                    <?php else:?>
                    <?php endif;?>
        </div>
    </div>
</body>

</html>
