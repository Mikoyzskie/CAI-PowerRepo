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

    <script src="/cdn-cgi/apps/head/ns59LyNWB_P3s_PU5b-1nAM2Xe4.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
        <link rel="icon" href="https://i.imgur.com/mr6sxQf.png">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="assets/js/app.js"></script>

    
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
    <div id="gb-sidebar" class="gb-vertical-nav bg-white collapsible-bar">
        <div class="py-4 px-3 mb-4 bg-light">
            <div class="media d-flex align-items-center"><img src="https://scontent.fmnl25-4.fna.fbcdn.net/v/t39.30808-1/c0.0.160.160a/p160x160/271385134_2407729536025058_7649790718067325166_n.jpg?_nc_cat=100&ccb=1-5&_nc_sid=7206a8&_nc_eui2=AeGgyERxB6pKa-HZaR0Bf6TGHkDB11AiJt8eQMHXUCIm3y3Xmdfy2hxVHHt-bJaSv60skXRnRS9-N1qJ8_lsq3u7&_nc_ohc=hEKMtQNbzmwAX8mllXc&tn=ae0bujNf62xzz24F&_nc_ht=scontent.fmnl25-4.fna&oh=00_AT_zvdkJbgehQHUYdg-M6CkQmtarPhSIDdeuIyK45lk-yA&oe=61EC7AE0" alt="..." width="65"
                    class="mr-3 rounded-circle img-thumbnail shadow-sm" />
                <div class="media-body">
                    <h4 class="m-0">Myk Escala</h4>
                    <p class="tagadmin font-weight-light text-muted mb-0">Administrator</p>

                    <div class="dropdown invi"><button id="bulk-action-dropdown" type="button" data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> Hello, Admin </button>
                                        <div aria-labelledby="bulk-action-dropdown" class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">Profile</a><a href="#"
                                                class="dropdown-item">Settings</a><a href="#" class="dropdown-item">Log Out</a></div>
                    </div>
                </div>

                
            </div>
        </div>
        <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Main</p>
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item"><a href="#" class="nav-link text-dark bg-light">Home</a></li>
            <li class="nav-item dropdown dropright"><a href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    Lessons </a>
                <div aria-labelledby="navbarDropdown" class="dropdown-menu"><a href="#" class="dropdown-item">Action</a><a href="#" class="dropdown-item">Another action</a>
                    <div class="dropdown-divider"></div><a href="#" class="dropdown-item">Something else here</a>
                </div>
            </li>
            <li class="nav-item"><a href="#" class="nav-link">Customers</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Subscriptions </a></li>
        </ul>
        <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Reports</p>
        <ul class="nav flex-column bg-white mb-0">
            <li class="nav-item"><a href="#" class="nav-link">Event Logs </a></li>
            <li class="nav-item"><a href="#" class="nav-link">Archives </a></li>
            <li class="nav-item"><a href="#" class="nav-link">Administrators </a></li>
            <li class="nav-item"><a href="#" class="nav-link">Line charts </a></li>
        </ul>
    </div>

    <div id="gb-main-bar-content" class="page-content collapsible-bar-1 pl-5 pr-5 pb-2">
        <div class="pull-right mt-3 justify-content-end d-flex"><button onclick="document.querySelector('.collapsible-bar').classList.toggle('active');" id="sidebarCollapse" type="button"
                class="btn btn-collapse rounded-pill btn-sm px-2 py-2 btn-dark"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" class="c2465">
                    <path d="M24 18v1h-24v-1h24zm0-6v1h-24v-1h24zm0-6v1h-24v-1h24z" fill="#1040e2"></path>
                    <path d="M24 19h-24v-1h24v1zm0-6h-24v-1h24v1zm0-6h-24v-1h24v1z"></path>
                </svg></button>
        
                <div class="dropdown-nav ml-4 mt-2"><button id="bulk-action-dropdown" type="button" data-toggle="dropdown" class="btn btn-sm btn-white dropdown-toggle"> Hello, Admin </button>
                                        <div aria-labelledby="bulk-action-dropdown" class="dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item">Profile</a><a href="#"
                                                class="dropdown-item">Settings</a><a href="#" class="dropdown-item">Log Out</a></div>
                </div>

                
        </div>
        <h2 class="display-4">Dashboard</h2>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-3 mb-lg-0">
                <div class="border rounded">
                    <div class="d-flex border-bottom p-3 w-100 align-items-center">
                        <h3 class="h5 mr-auto mb-0">Revenue </h3>
                        <p class="badge badge-success mb-0">Monthly </p>
                    </div>
                    <p class="px-3 pt-4 h3">350,800 </p>
                    <div class="d-flex px-3 w-100">
                        <p class="mr-auto">Total income </p>
                        <p class="text-success d-flex align-items-center"> 82% </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3 mb-lg-0">
                <div class="border rounded">
                    <div class="d-flex border-bottom p-3 w-100 align-items-center">
                        <h3 class="h5 mr-auto mb-0">Orders </h3>
                        <p class="badge badge-success mb-0">Monthly </p>
                    </div>
                    <p class="px-3 pt-4 h3">258,500 </p>
                    <div class="d-flex px-3 w-100">
                        <p class="mr-auto">New orders </p>
                        <p class="text-success d-flex align-items-center"> 32% </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3 mb-lg-0">
                <div class="border rounded">
                    <div class="d-flex border-bottom p-3 w-100 align-items-center">
                        <h3 class="h5 mr-auto mb-0">Visits </h3>
                        <p class="badge badge-success mb-0">Today </p>
                    </div>
                    <p class="px-3 pt-4 h3">95,648 </p>
                    <div class="d-flex px-3 w-100">
                        <p class="mr-auto">New visits </p>
                        <p class="text-success d-flex align-items-center">24% </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="border rounded">
                    <div class="d-flex border-bottom p-3 w-100 align-items-center">
                        <h3 class="h5 mr-auto mb-0">User activity </h3>
                        <p class="badge badge-danger mb-0">Today </p>
                    </div>
                    <p class="px-3 pt-4 h3">3,341 </p>
                    <div class="d-flex px-3 w-100">
                        <p class="mr-auto">Repeated Users </p>
                        <p class="text-danger d-flex align-items-center">42% </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">

                    <div class="header mt-md-5">
                        <div class="header-body">
                            <div class="row align-items-center">
                                <div class="col">

                                    <h6 class="header-pretitle"> Overview </h6>
                                    <h1 class="header-title"> Users </h1>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn btn-primary lift"> New User </a>
                                </div>
                            </div>

                            

                            <div class="row align-items-center">
                                <div class="col">

                                    <ul class="nav nav-tabs nav-overflow header-tabs">
                                        <li class="nav-item"><a href="#!" class="nav-link"> All <span class="badge badge-pill badge-primary">
                                    <?php if(!empty($count)):?>
                                    <?php foreach($count as $count):?>
                                        <?= $count->userCount;?>
                                    <?php endforeach;?>
                                    <?php else:?>
                                    <?php endif;?>
                                    </span></a></li>
                                        <li class="nav-item"><a href="#!" class="nav-link active"> Activated <span class="badge badge-pill badge-success">
                                    <?php if(!empty($active)):?>
                                    <?php foreach($active as $active):?>
                                        <?= $active->userCount;?>
                                    <?php endforeach;?>
                                    <?php else:?>
                                    <?php endif;?>
                                        </span></a></li>
                                        <li class="nav-item"><a href="#!" class="nav-link"> Pending <span class="badge badge-pill badge-warning">
                                    <?php if(!empty($pending)):?>
                                    <?php foreach($pending as $pending):?>
                                        <?= $pending->userCount;?>
                                    <?php endforeach;?>
                                    <?php else:?>
                                    <?php endif;?>
                                        </span></a></li>
                                        <li class="nav-item"><a href="#!" class="nav-link"> Archived <span class="badge badge-pill badge-danger">24</span></a></li>
                                       
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header bg-white">
                            <div class="row align-items-center">
                                <div class="col">
                                    <form class="row align-items-center mt-1">
                                        <div class="col-auto pr-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path
                                                    d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.315-4.315-9.73-9.731-9.73-5.315 0-9.73 4.315-9.73 9.73 0 5.366 4.315 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z">
                                                </path>
                                            </svg></div>
                                        <div class="col"><input type="search" placeholder="Search" class="form-control form-control-flush search" /></div>
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
                                        <td class="text-right">
                                            <div class="dropdown"><a href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    class="btn btn-light btn-sm dropdown-toggle"> Actions </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                <?php if($user['attempt'] == 3):?>
                                                    <a href="#!" class="dropdown-item"> Unlock </a>
                                                <?php else:?>
                                                <a href="#!" class="dropdown-item"> Edit </a>
                                                <?php endif;?>
                                                <a href="#!" class="dropdown-item"> Email </a>
                                                <a href="#!" class="dropdown-item"> Delete </a>
                                                    
                                                
                                                </div>
                                            </div>
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

        

    <script type="text/javascript">
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#gb-main-bar-content').toggleClass('active');
            });
        });

    </script>

</body>

</html>
