<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Libraries\hash;
class admin extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    public function index(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $pager = \Config\Services::pager();
        
        $users = $usersModel->allUsers();
        $count = $usersModel->countUsers();
        $admins = $usersModel->countAdmins();
        $lessoncount = $usersModel->getLessCount();
        $eventcount = $usersModel->geteventCount();
        $questcount = $usersModel->getQuesCount();
        
        $data = [
            'users' => $usersModel->allUsers(10),
            'adminInfo'=>$adminInfo,
            'pager' => $usersModel->pager,
            'count' => $count,
            'admins'=>$admins,
            'lessoncount'=>$lessoncount,
            'events'=>$eventcount,
            'quests'=>$questcount,
            
        ];
        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }
        return view('admin/index', $data);
        
    }

    function check(){
        //Credentials validation

        $validation = $this->validate([
            'email'=>[
                'rules'=>'is_not_unique[tblusers.email]',
                'errors'=>[
                    'is_not_unique'=>'Account does not exist.'
                ]
                ]
                ]);
        
        if(!$validation){
            return view('admin/login',['validation'=>$this->validator]);
        }else{
            //Credential check

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $usersModel = new \App\Models\UsersModel();
            $admin_info = $usersModel->where('email', $email)->first();
            if($admin_info['role']=='User'){
                return redirect()->to('admin/login')->with('fail', 'User account.');
            }else{
                $check_password = Hash::check($password, $admin_info['password']);

                $registerModel = new \App\Models\RegisterModel;
                $data = $registerModel->lockCheck($email);
                    
                foreach ($data as $row){
                    $isActivated = $row->active;
                    $isLocked = $row->attempt;
                    $isArchived = $row->visible;
                }
        
                    if($isLocked == 3){
                        return redirect()->to('admin/login')->with('fail', 'Account Locked. Contact Support to Unlock.');
                    }else{
                        if(!$check_password){
                            
                            $query = $registerModel->attempt($email);
            
                            if($query){
                                session()->setFlashdata('fail', 'Incorrect Password');
                                return redirect()->to('admin/login')->withInput();
                            }
                            else{
                                return redirect()->to('admin/login')->with('fail', 'Something went wrong');                  
                            }
            
                           
                        }else{
                            if($isArchived == 1){
                                return redirect()->to('admin/login')->with('fail', 'Account Doesnt Exist.');
                            }else{
                                if($isActivated == 0){
                                    return redirect()->to('admin/login')->with('fail', 'Account Not Verified, Please Check Your Email.');
                                }else{
                                    $admin_id = $admin_info['id'];
                                    session()->set('loggedAdmin', $admin_id);
                                    $eventName = $admin_info['name'];
                                    $query = $registerModel->loggedIn($eventName);
                                    return redirect()->to('admin/');
                                } 
                            }                                   
                        }
                    }
            }
        
        }
    }

    public function admins(){
        $pager = \Config\Services::pager();
        $count = $usersModel->     
        $data = [
            'event' => $eventModel->events(10),
            'pager' => $eventModel->pager,
            
        ];
 
        return view('admin/admin',$data);
    }

    public function login(){
        return view('admin/login');
    }   

    public function user(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        $data = [
            'adminInfo'=>$adminInfo,
        ];
        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }

        return view('admin/user',$data);
    }

    public function unlock(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }
        if(empty($_GET['id'])){
            return redirect()->to('admin/');
        }else{
            $code = $_GET['id'];
        }
        
        $lessModel = new \App\Models\LessonsModel();
        $query = $lessModel->unlockUser($code);
        if(!$query){
            return redirect()->to('admin/')->with('fail', 'Error: Something went wrong.');
        }else{
            return redirect()->to('admin/')->with('success', 'User successfully unlocked.');
        }
    }

    public function lessons(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        $pager = \Config\Services::pager();
        $lessModel = new \App\Models\LessonsModel();
        $lessons = $lessModel->lessons();
        
        $lessoncount = $usersModel->getLessCount();
        
        $data = [
            'lessons' => $lessModel->lessons(10),
            'pager' => $lessModel->pager,
            'adminInfo'=>$adminInfo,
            
        ];
        
        return view('admin/lessons',$data);
    }

    public function searchlesson(){
        if(empty($_GET['search'])){
            return redirect()->to('admin/lessons');
        }else{
            $search = $_GET['search'];
        }
        
        $lessModel = new \App\Models\LessonsModel();
        $lessons = $lessModel->lessonsearch($search,10);
        $usersModel = new \App\Models\UsersModel();
        
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        $lessoncount = $usersModel->getLessCount();
        $pager = \Config\Services::pager();
        $data = [
            'lessons' => $lessModel->lessonsearch($search,10),
            'pager'=>  $lessModel->pager,
            'adminInfo'=>$adminInfo,
        ];
 
        return view('admin/lessons',$data);
    }

    public function searchquest(){
        if(empty($_GET['search'])){
            return redirect()->to('admin/questions');
        }else{
            $search = $_GET['search'];
        }
        
        $questModel = new \App\Models\QuestModel();
        $quest = $questModel->questionssearch($search,0);
        $usersModel = new \App\Models\UsersModel();
        
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        
        $pager = \Config\Services::pager();
        $data = [
            'quest' => $questModel->questionssearch($search,0),
            'pager'=>  $questModel->pager,
            'adminInfo'=>$adminInfo,
        ];

        if($adminInfo['role']=='Teacher'){
            return view('admin/lessons');
        }
 
        return view('admin/questions',$data);
    }

    public function searchuser(){
        if(empty($_GET['search'])){
            return redirect()->to('admin/');
        }else{
            $search = $_GET['search'];
        }
        
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $pager = \Config\Services::pager();
        
        $users = $usersModel->allUsers();
        $count = $usersModel->countUsers();
        $admins = $usersModel->countAdmins();
        $lessoncount = $usersModel->getLessCount();
        $eventcount = $usersModel->geteventCount();
        $questcount = $usersModel->getQuesCount();
        $active = $usersModel->countActivated();
        $pending = $usersModel->countPending();
        $data = [
            'users' => $usersModel->allUsersSearch($search),
            'adminInfo'=>$adminInfo,
            'pager' => $usersModel->pager,
            'count' => $count,
            'admins'=>$admins,
            'lessoncount'=>$lessoncount,
            'events'=>$eventcount,
            'quests'=>$questcount,
            'active' => $active,
            'pending' => $pending,
        ];
        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }
 
        return view('admin/index', $data);
    }

    public function searchevent(){
        if(empty($_GET['search'])){
            return redirect()->to('admin/events');
        }else{
            $search = $_GET['search'];
        }
        $pager = \Config\Services::pager();
        $eveModel = new \App\Models\EventModel();
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $events = $eveModel->eventsearch($search,10);
        $events2 = $eveModel->eventsearch2($search,10);
        $events3 = $eveModel->eventsearch3($search,10);
        if(empty($events)){
            if(empty($events2)){
                if(empty($events3)){
                    $data = [
                        'event' => $eveModel->eventsearch3($search,10),
                        'pager' => $eveModel->pager,
                        'adminInfo'=>$adminInfo,
                    ];
                }else{
                    $data = [
                        'event' => $eveModel->eventsearch3($search,10),
                        'pager' => $eveModel->pager,
                        'adminInfo'=>$adminInfo,
                    ];
                }
            }else{
                $data = [
                    'event' => $eveModel->eventsearch2($search,10),
                    'pager' => $eveModel->pager,
                    'adminInfo'=>$adminInfo,
                ]; 
            }
        }else{
            $data = [
                'event' => $eveModel->eventsearch($search,10),
                'pager' => $eveModel->pager,
                'adminInfo'=>$adminInfo,
            ];
        }
        /* $eve = array_merge($events,$events2,$events3); */
        
        
        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }
        return view('admin/events',$data);
    }
    
    public function lesson(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        

        $data = [
            'adminInfo'=>$adminInfo,
        ];

        return view('admin/lesson',$data);
    }

    public function events(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        $pager = \Config\Services::pager();
        $eventModel = new \App\Models\EventModel();
        $events = $eventModel->events(10);      
        $data = [
            'event' => $eventModel->events(10),
            'pager' => $eventModel->pager,
            'adminInfo'=>$adminInfo
        ];
 
        return view('admin/events',$data);
    }

    public function questions(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        $pager = \Config\Services::pager();
        $questModel = new \App\Models\QuestModel();
        $quest = $questModel->questions(5);      
        $data = [
            'quest' => $questModel->questions(5),
            'pager' => $questModel->pager,
            'adminInfo'=>$adminInfo,
        ];
 
        return view('admin/questions',$data);
    }

    public function upQuest(){
        if(empty($_GET['id'])){
            return redirect()->to('admin/questions');
        }else{
            $lessonId = $_GET['id'];
        }
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $admin = $adminInfo['name'];
        $questModel = new \App\Models\QuestModel();
        $registerModel = new \App\Models\RegisterModel();
        $quest = $questModel->show_edit($lessonId);
       if(empty($quest)){
        return view('admin/questions');
       }
       $question = $this->request->getPost('question');
       $choice1 = $this->request->getPost('choice1');
       $choice2 = $this->request->getPost('choice2');
       $choice3 = $this->request->getPost('choice3');
       $choice4 = $this->request->getPost('choice4');
       $lesson = $this->request->getPost('lesson');
       $answer=$this->request->getPost('exampleRadios');

       if($choice1 != $quest[0]->choice1){
        $array = [
            'choice1'=>$choice1
        ];
        $query1= $registerModel->adminEventQuest($lesson,$admin,$lessonId);
        $query = $questModel->questupdate($array,$lessonId);
        return redirect()->to('admin/questions')->with('success', 'Question successfully updated!');
       }
       if($choice2 != $quest[0]->choice2){
        $array = [
            'choice2'=>$choice2
        ];
        $query1= $registerModel->adminEventQuest($lesson,$admin,$lessonId);
        $query = $questModel->questupdate($array,$lessonId);
        return redirect()->to('admin/questions')->with('success', 'Question successfully updated!');
       }
       if($choice3 != $quest[0]->choice3){
        $array = [
            'choice3'=>$choice3
        ];
        $query1= $registerModel->adminEventQuest($lesson,$admin,$lessonId);
        $query = $questModel->questupdate($array,$lessonId);
        return redirect()->to('admin/questions')->with('success', 'Question successfully updated!');
       }
       if($choice4 != $quest[0]->choice4){
        $array = [
            'choice4'=>$choice4
        ];
        $query1= $registerModel->adminEventQuest($lesson,$admin,$lessonId);
        $query = $questModel->questupdate($array,$lessonId);
        return redirect()->to('admin/questions')->with('success', 'Question successfully updated!');
       }
       if($answer != $quest[0]->answer){
        $array = [
            'answer'=>$answer
        ];
        $query1= $registerModel->adminEventQuest($lesson,$admin,$lessonId);
        $query = $questModel->questupdate($array,$lessonId);
        return redirect()->to('admin/questions')->with('success', 'Question successfully updated!');
       }
       if($question != $quest[0]->question){
        $array = [
            'question'=>$question
        ];
        $query1= $registerModel->adminEventQuest($lesson,$admin,$lessonId);
        $query = $questModel->questupdate($array,$lessonId);
        return redirect()->to('admin/questions')->with('success', 'Question successfully updated!');
       }
       $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        $pager = \Config\Services::pager();
        $questModel = new \App\Models\QuestModel();
        $quest = $questModel->questions(5);      
        $data = [
            'quest' => $questModel->questions(5),
            'pager' => $questModel->pager,
            'adminInfo'=>$adminInfo,
        ];
 
        return view('admin/questions',$data);
       
    }

    public function question(){
        if(empty($_GET['id']) && empty($_GET['lesson'])){
            return redirect()->to('admin/questions');
        }else{
            $lessonId = $_GET['id'];
            $id = $_GET['lesson'];
        }
        $usersModel = new \App\Models\UsersModel();
        $questModel = new \App\Models\QuestModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $less = $usersModel->getLessonTitle($id);
        $quest = $questModel->show_edit($lessonId);
       if(empty($quest)){
        return view('admin/questions');
       }

        $data = [
            'quest'=>$quest,
            'title'=>$less,
            'adminInfo'=>$adminInfo,
        ];
 
        return view('admin/question',$data);
    }

    public function tests(){
    }

    public function check_lesson(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $admin = $adminInfo['name'];
        $title = $this->request->getPost('title');
        $link = $this->request->getPost('youtube');
        $descript = $this->request->getPost('message');
        $achieve = $this->request->getPost('achieve');
        $icon = $this->request->getPost('icon');
        $avail = $this->request->getPost('avail');
        $thumb = $this->request->getFile('thumb');

        if(empty($_FILES['thumb']['name'])){
            $state = "Image is empty";
        }else{
            $validationRule = [
                'thumb' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded[thumb]'
                        . '|is_image[thumb]'
                        . '|mime_in[thumb,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[thumb,100]'
                        . '|max_dims[thumb,1024,768]',
                ],
            ];
            if(!$validationRule){
                $state = "Image format is invalid.";
            }else{
                $state = "Image format is valid.";
            }
        }

        if($avail == "Yes"){
            $avail = "Available";
        }else{
            $avail = "Upcoming";
        }
        $data = [
            'title'=>$title,
            'youtube'=>$link,
            'message'=>$descript,
            'achieve'=>$achieve,
            'icon'=>$icon,
            'state'=>$state,
            'avail'=>$avail,
            'adminInfo'=>$adminInfo,            
        ];
        
        return view('admin/checklesson',$data);
    }

    public function testing(){
        for($i = 1; $i != 6; $i++){
            
            echo $i;
        }
    }

    public function publish_lesson(){
        $title = $this->request->getPost('title');
        $link = $this->request->getPost('youtube');
        $descript = $this->request->getPost('message');
        $achieve = $this->request->getPost('achieve');
        $icon = $this->request->getPost('icon');
        $avail = $this->request->getPost('avail');
        $thumb = $this->request->getFile('thumb');

        if($avail == "Yes"){
            $avail = 0;
        }else{
            $avail = 1;
        }

        if(empty($_FILES['thumb']['name'])){
            $thumbs = $this->request->getFile('thumb');
        }else{
            $validationRule = [
                'thumb' => [
                    'label' => 'Image File',
                    'rules' => 'uploaded[thumb]'
                        . '|is_image[thumb]'
                        . '|mime_in[thumb,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                        . '|max_size[thumb,100]'
                        . '|max_dims[thumb,1024,768]',
                ],
            ];
            if(!$validationRule){
                return redirect()->back()->with('fail', 'Error: Invalid image input.');
            }else{
                if($thumb->isValid() && ! $thumb->hasMoved()){
                    $thumbs = $thumb->getRandomName(); 
                    $thumb->move('./public/uploads', $thumbs);
                }else{
                    return redirect()->back()->with('fail', 'Error: Unable to Upload Image.');
                    
                }
            }
        }

        $values = [
            'title'=>$title,
            'thumb'=>$thumbs,
            'vid_link'=>$link,
            'short_description'=>$descript,
            'achievement'=>$achieve,
            'icon'=>$icon,
            'archive'=>$avail,
        ];

        $lessModel = new \App\Models\LessonsModel();
        $query = $lessModel->insert($values);
        $lessonID = $lessModel->insertID();
        for($i = 1; $i != 6; $i++){
            
            $values = [
                'lesson_id'=>$lessonID,
                'number'=> $i
            ];
            $lessModel = new \App\Models\QuestModel();
            $querys = $lessModel->insert($values);
        }
        if(!$query){
            return redirect()->back()->with('fail', 'Error: Something went wrong.');
        }else{
            return redirect()->back()->with('success', 'Lesson successfully added!');
        }
    }

    public function delete_users(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }
        if(isset($_POST['deletedata'])){
            $id = $_POST['delete_id'];
            $eventName = $_POST['delete_name'];
            $archive = 1;
            $userModel = new \App\Models\UsersModel();
            $query = $userModel->deleteuser($archive,$id);
            $registerModel = new \App\Models\RegisterModel();
        
        $admin = $adminInfo['name'];
        $data = [
            'adminInfo'=>$adminInfo,
        ];
            $query_event = $registerModel->adminDelUser($eventName,$admin);
            
         if(!$query && !$query_event){
             return redirect()->to('admin/')->with('fail', 'Error: Something went wrong.');
         }else{
             return redirect()->to('admin/')->with('success', 'User successfully archived!');
         }
        }
    }
 
     public function restore_users(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }
        if(isset($_POST['deletedata'])){
            $id = $_POST['delete_id'];
            $archive = 0;
            $userModel = new \App\Models\UsersModel();
            $query = $userModel->deleteuser($archive,$id);
            $registerModel = new \App\Models\RegisterModel();
        $eventName = $_POST['delete_name'];
       
        $admin = $adminInfo['name'];
        
            $query_event = $registerModel->adminResUser($eventName,$admin);
         if(!$query){
             return redirect()->back()->with('fail', 'Error: Something went wrong.');
         }else{
             return redirect()->back()->with('success', 'User successfully restored!');
         }
        }
    }

    public function delete_lesson(){
       if(isset($_POST['deletedata'])){
           $id = $_POST['delete_id'];
           $archive = 1;
           $lessModel = new \App\Models\LessonsModel();
           $query=$lessModel->deleteLesson($id,$archive);
           $eventName = $_POST['delete_name'];
           $usersModel = new \App\Models\UsersModel();
           $registerModel = new \App\Models\RegisterModel();
           $loggedAdminID = session()->get('loggedAdmin');
           $adminInfo = $usersModel->find($loggedAdminID);
           $admin = $adminInfo['name'];
           $quizModel = new \App\Models\QuestModel();
           $quiz = $quizModel->deleteQuestionDelLesson($id,$archive);
           $query_event = $registerModel->adminDelLess($eventName,$admin);
        if(!$query && !$query_event){
            return redirect()->to('admin/lessons')->with('fail', 'Error: Something went wrong.');
        }else{
            return redirect()->to('admin/lessons')->with('success', 'Lesson successfully deleted!');
        }
       }
    }

    public function delete_question(){
        if(isset($_POST['deletedata'])){
            $id = $_POST['delete_id'];
            $lesson = $_POST['delete_name'];
            $archive = 1;

            $usersModel = new \App\Models\UsersModel();
            $registerModel = new \App\Models\RegisterModel();
            $loggedAdminID = session()->get('loggedAdmin');
            $adminInfo = $usersModel->find($loggedAdminID);
            $admin = $adminInfo['name'];

            $questModel = new \App\Models\QuestModel();
            $query = $questModel->deleteQuestion($id,$archive);

            $status = 'archive';
            $query_event = $registerModel->adminDelQuest($lesson,$admin,$id,$status);
         if(!$query && !$query_event){
             return redirect()->to('admin/questions')->with('fail', 'Error: Something went wrong.');
         }else{
             return redirect()->to('admin/questions')->with('success', 'Question successfully deleted!');
         }
        }
     }

     public function restore_question(){
        if(isset($_POST['deletedata'])){
            $id = $_POST['delete_id'];
            $lesson = $_POST['delete_name'];
            $archive = 0;

            $usersModel = new \App\Models\UsersModel();
            $registerModel = new \App\Models\RegisterModel();
            $loggedAdminID = session()->get('loggedAdmin');
            $adminInfo = $usersModel->find($loggedAdminID);
            $admin = $adminInfo['name'];

            $questModel = new \App\Models\QuestModel();
            $query = $questModel->deleteQuestion($id,$archive);
            $status = 'restore';
            $query_event = $registerModel->adminDelQuest($lesson,$admin,$id,$status);
         if(!$query && !$query_event){
             return redirect()->to('admin/questions')->with('fail', 'Error: Something went wrong.');
         }else{
             return redirect()->to('admin/questions')->with('success', 'Question successfully restored!');
         }
        }
     }

    public function restore_lesson(){
        if(isset($_POST['deletedata'])){
            $id = $_POST['delete_id'];
            $archive = 0;
            $eventName = $_POST['delete_name'];
            $lessModel = new \App\Models\LessonsModel();
            $query=$lessModel->deleteLesson($id,$archive);
            $usersModel = new \App\Models\UsersModel();
            $registerModel = new \App\Models\RegisterModel();
           $loggedAdminID = session()->get('loggedAdmin');
           $adminInfo = $usersModel->find($loggedAdminID);
           $admin = $adminInfo['name'];
           $quizModel = new \App\Models\QuestModel();
           $quiz = $quizModel->deleteQuestionDelLesson($id,$archive);
            $query_event = $registerModel->adminResLess($eventName,$admin);
            
         if(!$query && !$query_event){
             return redirect()->to('admin/lesson_archive')->with('fail', 'Error: Something went wrong.');
         }else{
             return redirect()->to('admin/lesson_archive')->with('success', 'Lesson successfully restored!');
         }
        }
    }

    public function edit_lesson(){
        if(empty($_GET['id'])){
            return redirect()->to('admin/lessons');
        }else{
            $lessonID = $_GET['id'];
        }
        
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);


        $lessModel = new \App\Models\LessonsModel();
        $lessons = $lessModel->show_edit($lessonID);

        $data = [
            'lessons' => $lessons,
            'adminInfo'=>$adminInfo,
        ];

        if(empty($lessons)){
            return redirect()->to('admin/lessons');
        }else{
            return view('admin/lessonedit',$data);
        }
        
    }

    public function edit_user(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }

        $admin = $adminInfo['name'];
        if(empty($_GET['id'])){
            return redirect()->to('admin/');
        }else{
            $userID = $_GET['id'];
        }
        
        $userModel = new \App\Models\UsersModel();
        $users = $userModel->show_edit($userID);

        $data = [
            'user' => $users,
            'adminInfo'=>$adminInfo,
        ];

        if(empty($users)){
            return redirect()->to('admin/');
        }else{
            return view('admin/edituser',$data);
        }
        
    }

    public function settings(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $admin = $adminInfo['name'];
        $userID = $adminInfo['code'];
        
        $userModel = new \App\Models\UsersModel();
        $users = $userModel->show_edit($userID);

        $data = [
            'user' => $users,
            'adminInfo'=>$adminInfo,
        ];

        if(empty($users)){
            return redirect()->to('admin/');
        }else{
            return view('admin/settings',$data);
        }
        
    }

    public function update_user(){
        $usersModel = new \App\Models\UsersModel();
        $registerModel = new \App\Models\RegisterModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }

        $admin = $adminInfo['name'];
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $bio = $this->request->getPost('message');
        
        $profile = $this->request->getFile('userfile');
        $userID = $this->request->getPost('code');
        $userModel = new \App\Models\UsersModel();
        $users = $userModel->show_edit($userID);
        $eventName = $users[0]->name;
        $password = $this->request->getPost('password');
        $cpassword = $this->request->getPost('cpassword');

        if(!empty($password) && !empty($cpassword)){
            $validation = $this->validate([
                'password'=>[
                    'rules'=>'min_length[5]|max_length[12]',
                    'errors'=>[
                        'min_length'=>'Password must be at least 5 characters.',
                        'max_length'=>'Password cannot exceed 12 characters.'
                    ]
                    ],
                    'cpassword'=>[
                        'rules'=>'matches[password]',
                        'errors'=>[
                            'matches'=>'Password not match.'
                        ]
                        ]
                
                ]);
           
                if(!$validation){                    
                    return redirect()->back()->with('fail','Please check password');
                }else{
                    $updatePass = Hash::make($password);
                    $code = $users[0]->code;
                    
                    $query_password = $registerModel->resetpassword($updatePass,$code);   
                } 
                if($query_password){
                    $registerModel = new \App\Models\RegisterModel();
                    $query_event = $registerModel->AdminpasswordEvent($eventName,$admin);
                    return redirect()->to('admin/')->with('success', 'User successfully updated!');
                }
        }
        


        if($users[0]->name==$name){
            if($users[0]->email==$email){
                if($users[0]->bio==$bio){
                    
                }else{
                    $data = [
                        'bio'=>$bio
                    ];
                }
            }else{
                if($users[0]->bio==$bio){
                    
                }else{
                    $data = [
                        'bio'=>$bio,
                        
                    ];
                }
        $subject = 'Account Verification - CAI PowerPoint';
        $message = '<!doctype html>
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <title>
        
            </title>
            <!--[if !mso]><!-- -->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style type="text/css">
                #outlook a {
                    padding: 0;
                }
        
                .ReadMsgBody {
                    width: 100%;
                }
        
                .ExternalClass {
                    width: 100%;
                }
        
                .ExternalClass * {
                    line-height: 100%;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                    -webkit-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                }
        
                table,
                td {
                    border-collapse: collapse;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                }
        
                img {
                    border: 0;
                    height: auto;
                    line-height: 100%;
                    outline: none;
                    text-decoration: none;
                    -ms-interpolation-mode: bicubic;
                }
        
                p {
                    display: block;
                    margin: 13px 0;
                }
            </style>
            <!--[if !mso]><!-->
            <style type="text/css">
                @media only screen and (max-width:480px) {
                    @-ms-viewport {
                        width: 320px;
                    }
                    @viewport {
                        width: 320px;
                    }
                }
            </style>
        
        
            <style type="text/css">
                @media only screen and (min-width:480px) {
                    .mj-column-per-100 {
                        width: 100% !important;
                    }
                }
            </style>
        
        
            <style type="text/css">
            </style>
        
        </head>
        
        <body style="background-color:#f9f9f9;">
        
        
            <div style="background-color:#f9f9f9;">
        
        
                <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;">
        
                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                        <tbody>
                            <tr>
                                <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
        
                </div>

                <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;">
        
                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                        <tbody>
                            <tr>
                                <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                    
        
                                    <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
        
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:64px;">
        
                                                                
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:32px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                        Please confirm your email
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        Yes '.$users[0]->name.', we know.
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        An email to confirm an email. 🤪
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:20px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        Please validate your email address in order to get started using<br>CAI PowerPoint.
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-top:30px;padding-bottom:40px;word-break:break-word;">
        
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                        <tr>
                                                            <td align="center" bgcolor="#2F67F6" role="presentation" style="border:none;border-radius:3px;color:#ffffff;cursor:auto;padding:15px 25px;" valign="middle">
                                                                <a href="'.base_url().'/auth/admin_email_verify/'.$users[0]->id.'/'.$users[0]->code.'" style="background:#2F67F6;color:#ffffff;font-family:Helvetica Neue,Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
                                                                    Confirm Your Email
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        Or verify using this link:
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        <a href="'.base_url().'/auth/admin_email_verify/'.$users[0]->id.'/'.$users[0]->code.'" target="_blank"" style="color:#2F67F6">'.base_url().'/auth/admin_email_verify/</a>
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:26px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                        Need Help?
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555;">
                                                        Please send and feedback or bug info<br> to <a href="mailto:caipower09@gmail.com" style="color:#2F67F6">caipower09@gmail.com</a>
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                        </table>
        
                                    </div>
        
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
        
                </div>
                <div style="Margin:0px auto;max-width:600px;">
        
                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                   
                                    <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
        
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td style="vertical-align:bottom;padding:0;">
        
                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
        
                                                            <tr>
                                                                <td align="center" style="font-size:0px;padding:0;word-break:break-word;">
        
                                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:12px;font-weight:300;line-height:1;text-align:center;color:#575757;">
                                                                        CAI PowerPoint, 066 Agorita St. Mariveles 2105, Philippines
                                                                    </div>
        
                                                                </td>
                                                            <tr>                                                       
                                                        </table>
        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
        
                                    </div>
        
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
        
                </div>
        
        
            </div>
        
        </body>
        
        </html>';

        $emailInstance = \Config\Services::email();
        $emailInstance->setTo($email);
        $emailInstance->setFrom('caipower09@gmail.com','Info');
        $emailInstance->setSubject($subject);
        $emailInstance->setMessage($message);
        if($emailInstance->send()){
            $linkTime = date('Y-m-d H:i:s');            
            $code = $users[0]->code;
            $query_email = $registerModel->email_rep($email,$code,$linkTime);   
            if($query_email){               
                $query_event = $registerModel->adminEventEmail($eventName,$admin);
                return redirect()->to('admin/')->with('success', 'User successfully updated!');
            }
        }else{
            $data = $emailInstance->printDebugger(['headers']);
            print_r($data);
        }
            }
        }else{
            if($users[0]->email==$email){
                if($users[0]->bio==$bio){
                    $data = [
                        'name'=>$name
                    ];
                }else{
                    $data = [
                        'bio'=>$bio,
                        'name'=>$name
                    ];
                }
            }else{
                if($users[0]->bio==$bio){
                    $data = [
                        'name'=>$name
                    ];
                }else{
                    $data = [
                        'bio'=>$bio,
                        'name'=>$name
                    ];
                }
        $subject = 'Account Verification - CAI PowerPoint';
        $message = '<!doctype html>
        <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
        
        <head>
            <title>
        
            </title>
            <!--[if !mso]><!-- -->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <style type="text/css">
                #outlook a {
                    padding: 0;
                }
        
                .ReadMsgBody {
                    width: 100%;
                }
        
                .ExternalClass {
                    width: 100%;
                }
        
                .ExternalClass * {
                    line-height: 100%;
                }
        
                body {
                    margin: 0;
                    padding: 0;
                    -webkit-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                }
        
                table,
                td {
                    border-collapse: collapse;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                }
        
                img {
                    border: 0;
                    height: auto;
                    line-height: 100%;
                    outline: none;
                    text-decoration: none;
                    -ms-interpolation-mode: bicubic;
                }
        
                p {
                    display: block;
                    margin: 13px 0;
                }
            </style>
            <!--[if !mso]><!-->
            <style type="text/css">
                @media only screen and (max-width:480px) {
                    @-ms-viewport {
                        width: 320px;
                    }
                    @viewport {
                        width: 320px;
                    }
                }
            </style>
        
        
            <style type="text/css">
                @media only screen and (min-width:480px) {
                    .mj-column-per-100 {
                        width: 100% !important;
                    }
                }
            </style>
        
        
            <style type="text/css">
            </style>
        
        </head>
        
        <body style="background-color:#f9f9f9;">
        
        
            <div style="background-color:#f9f9f9;">
        
        
                <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;">
        
                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                        <tbody>
                            <tr>
                                <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
        
                </div>

                <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;">
        
                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                        <tbody>
                            <tr>
                                <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                    
        
                                    <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
        
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="width:64px;">
        
                                                                
        
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:32px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                        Please confirm your email
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        Yes '.$users[0]->name.', we know.
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        An email to confirm an email. 🤪
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:20px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        Please validate your email address in order to get started using<br>CAI PowerPoint.
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-top:30px;padding-bottom:40px;word-break:break-word;">
        
                                                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                        <tr>
                                                            <td align="center" bgcolor="#2F67F6" role="presentation" style="border:none;border-radius:3px;color:#ffffff;cursor:auto;padding:15px 25px;" valign="middle">
                                                                <a href="'.base_url().'/auth/admin_email_verify/'.$users[0]->id.'/'.$users[0]->code.'" style="background:#2F67F6;color:#ffffff;font-family:Helvetica Neue,Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
                                                                    Confirm Your Email
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        Or verify using this link:
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                        <a href="'.base_url().'/auth/admin_email_verify/'.$users[0]->id.'/'.$users[0]->code.'" target="_blank"" style="color:#2F67F6">'.base_url().'/auth/admin_email_verify/</a>
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:26px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                        Need Help?
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                            <tr>
                                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
        
                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555;">
                                                        Please send and feedback or bug info<br> to <a href="mailto:caipower09@gmail.com" style="color:#2F67F6">caipower09@gmail.com</a>
                                                    </div>
        
                                                </td>
                                            </tr>
        
                                        </table>
        
                                    </div>
        
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
        
                </div>
                <div style="Margin:0px auto;max-width:600px;">
        
                    <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                        <tbody>
                            <tr>
                                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                   
                                    <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
        
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                            <tbody>
                                                <tr>
                                                    <td style="vertical-align:bottom;padding:0;">
        
                                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
        
                                                            <tr>
                                                                <td align="center" style="font-size:0px;padding:0;word-break:break-word;">
        
                                                                    <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:12px;font-weight:300;line-height:1;text-align:center;color:#575757;">
                                                                        CAI PowerPoint, 066 Agorita St. Mariveles 2105, Philippines
                                                                    </div>
        
                                                                </td>
                                                            <tr>                                                       
                                                        </table>
        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
        
                                    </div>
        
                                   
                                </td>
                            </tr>
                        </tbody>
                    </table>
        
                </div>
        
        
            </div>
        
        </body>
        
        </html>';

        $emailInstance = \Config\Services::email();
        $emailInstance->setTo($email);
        $emailInstance->setFrom('caipower09@gmail.com','Info');
        $emailInstance->setSubject($subject);
        $emailInstance->setMessage($message);
        if($emailInstance->send()){
            $linkTime = date('Y-m-d H:i:s');
            
            $code = $users[0]->code;
            $query_email = $registerModel->email_rep($email,$code,$linkTime);
            if($query_email){               
                $query_event = $registerModel->adminEventEmail($eventName,$admin);
                return redirect()->to('admin/')->with('success', 'User successfully updated!');
            }
            
        }else{
            
            $data = $emailInstance->printDebugger(['headers']);
            print_r($data);
        }
            }
        }
        
        if(!empty($data)){
            $query = $userModel->update_user($data,$userID);
            
            if(!$query){
                return redirect()->to('admin/')->with('fail', 'Error: Something went wrong.');
            }else{
                $query = $registerModel->adminEventProfile($eventName,$admin);
                return redirect()->to('admin/')->with('success', 'User successfully updated!');
            }
        }

        return redirect()->to('admin/');
    }

    public function update_lessson(){
        $title = $this->request->getPost('title');
        $link = $this->request->getPost('youtube');
        $descript = $this->request->getPost('message');
        $achieve = $this->request->getPost('achieve');
        $icon = $this->request->getPost('icon');
        $avail = $this->request->getPost('avail');
        $thumb = $this->request->getFile('thumb');

        if($avail == "on"){
            $avails = 0;
        }else{
            $avails = 1;
        }

        $lessonID = $_GET['id'];
        $lessModel = new \App\Models\LessonsModel();
        $lessons = $lessModel->show_edit($lessonID);
        
        if(empty($_FILES['thumb']['name'])){
            if ($lessons[0]->title==$title && $lessons[0]->vid_link==$link && $lessons[0]->short_description==$descript && $lessons[0]->achievement==$achieve && $lessons[0]->icon==$icon && $lessons[0]->archive==$avails){
                return redirect()->back();
            }else{
                $query=$lessModel->upLesson($title,$link,$descript,$achieve,$icon,$avail,$lessonID);
                if(!$query){
                    return redirect()->to('admin/lessons')->with('fail', 'Error: Something went wrong.');
                }else{
                    return redirect()->to('admin/lessons')->with('success', 'Lesson successfully updated!');
                }
            }
        }else{
            if ($lessons[0]->title==$title && $lessons[0]->vid_link==$link && $lessons[0]->short_description==$descript && $lessons[0]->achievement==$achieve && $lessons[0]->icon==$icon && $lessons[0]->archive==$avails){
                $validationRule = [
                    'thumb' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[thumb]'
                            . '|is_image[thumb]'
                            . '|mime_in[thumb,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                            . '|max_size[thumb,100]'
                            . '|max_dims[thumb,1024,768]',
                    ],
                ];
                if(!$validationRule){
                    return redirect()->back()->with('fail', 'Error: Invalid image input.');
                }else{
                    if($thumb->isValid() && ! $thumb->hasMoved()){
                        $thumbs = $thumb->getRandomName(); 
                        $thumb->move('./public/uploads', $thumbs);

                        $query=$lessModel->upThumb($thumbs,$lessonID);
                        if($lessons[0]->thumb=="default.gif"){

                        }else{
                            if(file_exists("public/uploads/".$lessons[0]->thumb)){
                                unlink('public/uploads/'.$lessons[0]->thumb);
                            }
                        }

                        if(!$query){
                            return redirect()->to('admin/lessons')->with('fail', 'Error: Something went wrong.');
                        }else{
                            return redirect()->to('admin/lessons')->with('success', 'Lesson successfully updated!');
                        }
                    }else{
                        return redirect()->back()->with('fail', 'Error: Unable to Upload Image.');
                        
                    }
                }
            }else{
                $validationRule = [
                    'thumb' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[thumb]'
                            . '|is_image[thumb]'
                            . '|mime_in[thumb,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                            . '|max_size[thumb,100]'
                            . '|max_dims[thumb,1024,768]',
                    ],
                ];
                if(!$validationRule){
                    return redirect()->back()->with('fail', 'Error: Invalid image input.');
                }else{
                    if($thumb->isValid() && ! $thumb->hasMoved()){
                        $thumbs = $thumb->getRandomName(); 
                        $thumb->move('./public/uploads', $thumbs);

                        $query1=$lessModel->upThumb($thumbs,$lessonID);
                        if($lessons[0]->thumb=="default.gif"){

                        }else{
                            if(file_exists("public/uploads/".$lessons[0]->thumb)){
                                unlink('public/uploads/'.$lessons[0]->thumb);
                            }
                        }
                    }
                }
            
                $query=$lessModel->upLesson($title,$link,$descript,$achieve,$icon,$avail,$lessonID);
                
                if(!$query && !$query1){
                    return redirect()->to('admin/lessons')->with('fail', 'Error: Something went wrong.');
                }else{
                    return redirect()->to('admin/lessons')->with('success', 'Lesson successfully updated!');
                }
            }
        }


        
    }

    public function insertUser(){
        $validation = $this->validate([
            'password'=>[
                'rules'=>'min_length[5]|max_length[12]',
                'errors'=>[
                    'min_length'=>'Password must be at least 5 characters.',
                    'max_length'=>'Password cannot exceed 12 characters.'
                ]
                ],
            'cpassword'=>[
                'rules'=>'matches[password]|min_length[5]|max_length[12]',
                'errors'=>[
                    'matches'=>'Password not match.',
                    'min_length'=>'Password must be at least 5 characters.',
                    'max_length'=>'Password cannot exceed 12 characters.'
                ]
                ],
            'email'=>[
                'rules'=>'is_unique[tblusers.email]',
                'errors'=>[
                    'is_unique'=>'Email Already taken. Login Instead.   '
                ]
                ],
            
            
        ]);

        if(!$validation){
            if(empty($_FILES['userfile']['name'])){
                return view('admin/user',['validation'=>$this->validator]);
            }else{
                $validations = $this->validate([
                    'userfile' => [
                        'label' => 'Image File',
                        'rules' => 'uploaded[userfile]|is_image[userfile]|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[userfile,100]|max_dims[userfile,1024,768]',
                    ],
                ]);
                return view('admin/user',['validation'=>$this->validator],['validations'=>$this->validator]);
            }
        }else{
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $role = $this->request->getPost('role');
            $set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$code = substr(str_shuffle($set), 0, 20 );
            $date = date("Y-m-d H:i:s");
            
            $values = [
                'name'=>$name,
                'email'=>$email,
                'password'=>Hash::make($password),
                'code'=>$code,
                'active'=>false,
                'visible'=>false,
                'activatelink'=>$date,
                'role'=>$role
            ];

            $usersModel = new \App\Models\UsersModel();
            $query = $usersModel->insert($values);
            $userID = $usersModel->insertID();
            
            $subject = 'Account Verification - CAI PowerPoint';
            $message = '<!doctype html>
            <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
            
            <head>
                <title>
            
                </title>
                <!--[if !mso]><!-- -->
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <!--<![endif]-->
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <style type="text/css">
                    #outlook a {
                        padding: 0;
                    }
            
                    .ReadMsgBody {
                        width: 100%;
                    }
            
                    .ExternalClass {
                        width: 100%;
                    }
            
                    .ExternalClass * {
                        line-height: 100%;
                    }
            
                    body {
                        margin: 0;
                        padding: 0;
                        -webkit-text-size-adjust: 100%;
                        -ms-text-size-adjust: 100%;
                    }
            
                    table,
                    td {
                        border-collapse: collapse;
                        mso-table-lspace: 0pt;
                        mso-table-rspace: 0pt;
                    }
            
                    img {
                        border: 0;
                        height: auto;
                        line-height: 100%;
                        outline: none;
                        text-decoration: none;
                        -ms-interpolation-mode: bicubic;
                    }
            
                    p {
                        display: block;
                        margin: 13px 0;
                    }
                </style>
                <!--[if !mso]><!-->
                <style type="text/css">
                    @media only screen and (max-width:480px) {
                        @-ms-viewport {
                            width: 320px;
                        }
                        @viewport {
                            width: 320px;
                        }
                    }
                </style>
            
            
                <style type="text/css">
                    @media only screen and (min-width:480px) {
                        .mj-column-per-100 {
                            width: 100% !important;
                        }
                    }
                </style>
            
            
                <style type="text/css">
                </style>
            
            </head>
            
            <body style="background-color:#f9f9f9;">
            
            
                <div style="background-color:#f9f9f9;">
            
            
                    <div style="background:#f9f9f9;background-color:#f9f9f9;Margin:0px auto;max-width:600px;">
            
                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#f9f9f9;background-color:#f9f9f9;width:100%;">
                            <tbody>
                                <tr>
                                    <td style="border-bottom:#333957 solid 5px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
            
                    </div>

                    <div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;">
            
                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;">
                            <tbody>
                                <tr>
                                    <td style="border:#dddddd solid 1px;border-top:0px;direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                        
            
                                        <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
            
                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:bottom;" width="100%">
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
            
                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td style="width:64px;">
            
                                                                    
            
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
            
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
            
                                                        <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:32px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                            Please confirm your email
                                                        </div>
            
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
            
                                                        <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                            Yes '.$name.', we know.
                                                        </div>
            
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
            
                                                        <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                            An email to confirm an email. 🤪
                                                        </div>
            
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:20px;word-break:break-word;">
            
                                                        <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                            Please validate your email address in order to get started using<br>CAI PowerPoint.
                                                        </div>
            
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;padding-top:30px;padding-bottom:40px;word-break:break-word;">
            
                                                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                            <tr>
                                                                <td align="center" bgcolor="#2F67F6" role="presentation" style="border:none;border-radius:3px;color:#ffffff;cursor:auto;padding:15px 25px;" valign="middle">
                                                                    <a href="'.base_url().'/admin/verify/'.$userID.'/'.$code.'" style="background:#2F67F6;color:#ffffff;font-family:Helvetica Neue,Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
                                                                        Confirm Your Email
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table>
            
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:0;word-break:break-word;">
            
                                                        <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                            Or verify using this link:
                                                        </div>
            
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;padding-bottom:40px;word-break:break-word;">
            
                                                        <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                            <a href="'.base_url().'/admin/verify/'.$userID.'/'.$code.'" target="_blank"" style="color:#2F67F6">'.base_url().'/admin/verify/</a>
                                                        </div>
            
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
            
                                                        <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:26px;font-weight:bold;line-height:1;text-align:center;color:#555;">
                                                            Need Help?
                                                        </div>
            
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
            
                                                        <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:14px;line-height:22px;text-align:center;color:#555;">
                                                            Please send and feedback or bug info<br> to <a href="mailto:caipower09@gmail.com" style="color:#2F67F6">caipower09@gmail.com</a>
                                                        </div>
            
                                                    </td>
                                                </tr>
            
                                            </table>
            
                                        </div>
            
                                       
                                    </td>
                                </tr>
                            </tbody>
                        </table>
            
                    </div>
                    <div style="Margin:0px auto;max-width:600px;">
            
                        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
                            <tbody>
                                <tr>
                                    <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;">
                                       
                                        <div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:bottom;width:100%;">
            
                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
                                                <tbody>
                                                    <tr>
                                                        <td style="vertical-align:bottom;padding:0;">
            
                                                            <table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%">
            
                                                                <tr>
                                                                    <td align="center" style="font-size:0px;padding:0;word-break:break-word;">
            
                                                                        <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:12px;font-weight:300;line-height:1;text-align:center;color:#575757;">
                                                                            CAI PowerPoint, 066 Agorita St. Mariveles 2105, Philippines
                                                                        </div>
            
                                                                    </td>
                                                                <tr>                                                       
                                                            </table>
            
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
            
                                        </div>
            
                                       
                                    </td>
                                </tr>
                            </tbody>
                        </table>
            
                    </div>
            
            
                </div>
            
            </body>
            
            </html>';

            

            $emailInstance = \Config\Services::email();
            $emailInstance->setTo($email);
            $emailInstance->setFrom('caipower09@gmail.com','Info');
            $emailInstance->setSubject($subject);
            $emailInstance->setMessage($message);

            
                if($emailInstance->send()){
                    if(!$query){
                        return redirect()->to('admin/')->with('fail', 'Something went wrong.');
                        //return redirect()->to('register')->with('fail', 'Something went wrong.');
                    }else{
                        $registerModel = new \App\Models\RegisterModel;
                        $eventName = $name;
                        $passevent = $registerModel->registered($eventName);
                        return redirect()->to('admin/')->with('success', 'Registered successfully. Email Verification Sent.');
                    }
                }else{
                    
                    $data = $emailInstance->printDebugger(['headers']);
                    print_r($data);
                }
            
        }
    }

    public function verify(){
        if(empty($this->request->uri->getSegment(3))){
            return redirect()->to('admin/login');
        }else{
            $id =  $this->request->uri->getSegment(3);
            $code = $this->request->uri->getSegment(4);
        }
        

        $registerModel = new \App\Models\RegisterModel;
        $data['users'] = $registerModel->getUsers($id);

        foreach ($data['users'] as $row){
            $dbID =  $row->id;
            $dbCode = $row->code;
            $dbActive =  $row->active;
            $dbStart = $row->activatelink;
            $eventName =$row->name;
        }

        if(!empty($id) && !empty($code)){
            if($dbStart == "used"){
                return redirect()->to('admin/login')->with('fail', 'Already activated.');
            }else{
                $start = strtotime($dbStart);
                $end = date('Y-m-d H:i:s');
                $ends = strtotime($end);
                $hours = intval(($ends - $start)/3600);
                if($hours > 0){
                    return redirect()->to('admin/login')->with('fail', 'Email Link Expires. Contact Support For New Link.');  
                }else{
                    if($code == $dbCode && $id == $dbID){
                        $registerModel = new \App\Models\RegisterModel;
                        $query = $registerModel->activate($code);
                        
                        if($query){
                            $query = $registerModel->emailVerify($eventName);
                            return redirect()->to('admin/login')->with('success', 'Email Verified!');
                        }
                        else{
                            return redirect()->to('admin/login')->with('fail', 'Something went wrong in activating account');                  
                        }
                    }else{
                        return redirect()->to('auth/')->with('fail', 'Account does not exist.');
                    }
                } 
            }   
        }else{
            return redirect()->to('auth/')->with('fail', 'Cannot activate account. Code did not match');
        }
 
	}

    public function user_archive(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $pager = \Config\Services::pager();
        
        $users = $usersModel->archiveuser();
        
        
        $data = [
            'users' => $usersModel->archiveuser(10),
            'adminInfo'=>$adminInfo,
            'pager' => $usersModel->pager, 
        ];
 
        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }
        return view('admin/user_archives', $data);
    }

    public function administrator(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $pager = \Config\Services::pager();
        
        $users = $usersModel->allAdmin();
        
        
        $data = [
            'users' => $usersModel->allAdmin(10),
            'adminInfo'=>$adminInfo,
            'pager' => $usersModel->pager, 
        ];

        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }
 
        return view('admin/administrators', $data);
    }

    public function user_archive_search(){
        if(empty($_GET['search'])){
            return redirect()->to('admin/');
        }else{
            $search = $_GET['search'];
        }
        
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $pager = \Config\Services::pager();
        
        $users = $usersModel->archiveusersearch($search);
        
        $data = [
            'users' => $usersModel->archiveusersearch($search),
            'adminInfo'=>$adminInfo,
            'pager' => $usersModel->pager,
            
        ];
    
        if($adminInfo['role']=='Teacher'){
            return redirect()->to('admin/lessons');
        }
        return view('admin/user_archives', $data);
    }   

    public function lesson_archive(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        $pager = \Config\Services::pager();
        $lessModel = new \App\Models\LessonsModel();
        $lessons = $lessModel->lessons();
        
        $lessoncount = $usersModel->getLessCount();
        
        $data = [
            'lessons' => $lessModel->archivelessons(10),
            'pager' => $lessModel->pager,
            'adminInfo'=>$adminInfo,
        ];
 
        return view('admin/lesson_archive',$data);
    }

    public function question_archive(){
        $usersModel = new \App\Models\UsersModel();
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);

        $pager = \Config\Services::pager();
        $questModel = new \App\Models\QuestModel();
        $quest = $questModel->questionsarchive(5);      
        $data = [
            'quest' => $questModel->questionsarchive(5),
            'pager' => $questModel->pager,
            'adminInfo'=>$adminInfo,
        ];
 
        return view('admin/question_archive',$data);
    }

    function logout(){
        if(session()->has('loggedAdmin')){
            $registerModel = new \App\Models\RegisterModel;
            $usersModel = new \App\Models\UsersModel;
        $loggedAdminID = session()->get('loggedAdmin');
        $adminInfo = $usersModel->find($loggedAdminID);
        $eventName = $adminInfo['name'];
            $passevent = $registerModel->loggedOut($eventName);

            session()->remove('loggedAdmin');
            
            return redirect()->to('admin/login?access=out');
        }
    }
}
