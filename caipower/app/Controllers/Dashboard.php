<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Libraries\hash;
use App\Models\RegisterModel;
use CodeIgniter\HTTP\RequestInterface;

class dashboard extends BaseController
{
    public function index(){
        $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $getLesson = $usersModel->getLesson();
        $query = $usersModel->topfive();
        $data = [
            'title'=>'dashboard',
            'userInfo'=>$userInfo,
            'lessons'=>$getLesson,
            'top'=>$query
        ];
        return view('dashboard/home',$data);
    }

    public function tutorial(){
        return view('dashboard/tutorial');
    }

    public function assess(){
        return view('dashboard/assess');
    }

    public function watch(){
        if(empty($_GET['id'])){
            return redirect()->to('dashboard/lessons');
        }else{
            $id = $_GET['id'];
        }
       
       $usersModel = new \App\Models\UsersModel;
       $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $name = $userInfo['code'];
       $watch = $usersModel->getWatch($id);
       $countQues = $usersModel->getScore($id);
       $grade = $usersModel->getGrade($id,$name);

       $lesscount = $usersModel->getLessCount();
        
        if($id > $lesscount[0]->NumberOfLesson){
            return redirect()->to('dashboard/lessons');
        }else{

       $data = [
           'tutorials'=>$watch,
            'counts'=>$countQues,
            'grades'=>$grade
        ]; 

       
       return view('dashboard/watch',$data);
        }
    }

    public function profile(){
        $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $code = $userInfo['code'];
        $countach = $usersModel->achcount($code);
        $countless = $usersModel->lesscount($code);
        $achievement = $usersModel->achieve($code);
        $lessonfin = $usersModel->doneLesson($code);
        $data = [
            'title'=>'dashboard',
            'userInfo'=>$userInfo,
            'achcount'=>$countach,
            'lesscount'=>$countless,
            'ach'=>$achievement,
            'doneLess'=>$lessonfin
        ];
        return view('dashboard/profile',$data);
    }

    public function quiz(){
        
        if(empty($_GET['id'])){
            return redirect()->to('dashboard/lessons');
        }else{
            $lessonId = $_GET['id'];
        }
        
        $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $quest = $usersModel->getQuest($lessonId);
        $title = $usersModel->getWatch($lessonId);
        $countQues = $usersModel->getScore($lessonId);
        $name = $userInfo['code'];
        $grade = $usersModel->getGrade($lessonId,$name);
        $lesscount = $usersModel->getLessCount();
        $order = $usersModel->getLessonTitle($lessonId);
        
        if($lessonId > $lesscount[0]->NumberOfLesson){
            return redirect()->to('dashboard/lessons');
        }else{
            $data = [
                'title'=>'dashboard',
                'userInfo'=>$userInfo,
                'quest' => $quest,
                'title' => $title,
                'counts'=>$countQues,
                'grades'=>$grade,
                'lessons'=>$lesscount,
                'order'=> $order
            ];
            return view('dashboard/quiz',$data);
        }
        
    }

    public function settings(){
        $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $data = [
            'title'=>'dashboard',
            'userInfo'=>$userInfo
        ];
        return view('dashboard/settings',$data);
    }

    public function lessons(){
        $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $code = $userInfo['code'];
        $lessonfin = $usersModel->doneLesson($code);
        $lessons = $usersModel->getLessons($code);
        $data = [
            'lessons'=>$lessons,
            'doneLess'=>$lessonfin
        ];
       
        return view('dashboard/lessons',$data);
    }

    public function visit(){
        if(empty($_GET['id'])){
            return redirect()->to('dashboard/mates');
        }else{
            $code = $_GET['id'];
        }
        
        $usersModel = new \App\Models\UsersModel;
        $find = $usersModel->findnemo($code);
        $countach = $usersModel->achcount($code);
        $countless = $usersModel->lesscount($code);
        $achievement = $usersModel->achieve($code);
        $lessonfin = $usersModel->doneLesson($code);
        if(empty($find[0])){
            return redirect()->to('dashboard/mates');
        }else{
            $data = [
                'user'=>$find,
                'achcount'=>$countach,
            'lesscount'=>$countless,
            'ach'=>$achievement,
            'doneLess'=>$lessonfin
            ];
            return view('dashboard/visit',$data);
        }      
    }
    
    public function mates(){
        $usersModel = new \App\Models\UsersModel;
        $query['top'] = $usersModel->topfive();
        
        return view('dashboard/mates',$query);
    }

    public function post(){
        $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $data = [
            'title'=>'dashboard',
            'userInfo'=>$userInfo
        ];
        return view('dashboard/post',$data);
    }

    public function search(){
        
        if(empty($_GET['search'])){
            return redirect()->to('dashboard/');
        }else{
            $search = $_GET['search'];
        }
        $usersModel = new \App\Models\UsersModel;
        $usersModels = new \App\Models\UsersModel;
        $query= $usersModel->searchTable($search);
        $names = $usersModels->searchName($search);
        $data = [
            'lessons' =>$query,
            'names' =>$names

        ];

        
        return view('dashboard/search',$data);
       

    }

    public function gradeSave(){
        $usersModel = new \App\Models\UsersModel;
        $registerModel = new \App\Models\RegisterModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        if(empty($_GET['id'])){
            return redirect()->to('dashboard/lessons');
        }else{
            $lessonId = $_GET['id'];
            $id = $_GET['id'];
        }

        
        $name = $userInfo['code'];
        $grade = $this->request->getPost('grade');
        $dbgrades = $usersModel->getGrade($id,$name);
        $items = $usersModel->getScore($id);
        $achieves=$usersModel->getLessonTitle($lessonId);
        $values = [
            'name'=>$name,
            'lesson'=>$lessonId,
            'grade'=>$grade,
        ];
       
        $gradeModel = new \App\Models\GradeModel();
        
        if($grade == 5){
            $query = $gradeModel->insert($values);
            $achstatus = $usersModel->upAch($name,$id,$grade);
                $ach= $achieves[0]->achievement;
                $passevent = $registerModel->achievementUnlock($eventName, $ach);
                if(!$achstatus){
                    return redirect()->to('dashboard/lessons');
                }else{
                    return redirect()->to('dashboard/lessons');
                } 
        }

        if(empty($dbgrades)){
        $query = $gradeModel->insert($values);
        
        if(!$query){
            return redirect()->to('dashboard/lessons');
        }else{
            return redirect()->to('dashboard/lessons');
        } 
        }else{
            
            $items = $items[0]->NumberOfQuestion;
            if($grade != $items){
                $newGrade = $usersModel->upGrade($id,$grade,$name);
                if(!$newGrade){
                    return redirect()->to('dashboard/lessons');
                }else{
                    return redirect()->to('dashboard/lessons');
                } 
            }else{
                $achstatus = $usersModel->upAch($name,$id,$grade);
                $ach= $achieves[0]->achievement;
                $passevent = $registerModel->achievementUnlock($eventName, $ach);
                if(!$achstatus){
                    return redirect()->to('dashboard/lessons');
                }else{
                    return redirect()->to('dashboard/lessons');
                } 
            }
        }
    }

    public function verify(){
        if(empty($this->request->uri->getSegment(3)) && empty($this->request->uri->getSegment(4))){
            return redirect()->to('dashboard/settings');
        }else{
            $id =  $this->request->uri->getSegment(3);
            $code = $this->request->uri->getSegment(4);
        }

        $registerModel = new \App\Models\RegisterModel;
        $data['users'] = $registerModel->getUsers($id);

        foreach ($data['users'] as $row){
            $dbID =  $row->id;
            $dbCode = $row->code;
            $email = $row->email;
            $dbActive =  $row->active;
            $dbStart = $row->activatelink;
            $eventName = $row->name;
        }

        if(!empty($id) && !empty($code)){
            if($dbStart == "used"){
                return redirect()->to('dashboard/settings')->with('fail', 'Error: Already activated.');
            }else{
                $start = strtotime($dbStart);
                $end = date('Y-m-d H:i:s');
                $ends = strtotime($end);
                $hours = intval(($ends - $start)/3600);
                if($hours > 0){
                    return redirect()->to('dashboard/settings')->with('fail', 'Error: Email Link Expires');  
                }else{
                    if($code == $dbCode && $id == $dbID){
                        $registerModel = new \App\Models\RegisterModel;
                        $query = $registerModel->resetemail($email,$code);
                        
                        $passevent = $registerModel->emailVerify($eventName);
                        if($query){
                            return redirect()->to('auth/')->with('success', 'Email Verified!');
                        }
                        else{
                            return redirect()->to('auth/')->with('fail', 'Something went wrong in activating account');                  
                        }
                    }else{
        
                    }
                } 
            }   
        }else{
            return redirect()->to('auth/')->with('fail', 'Cannot activate account. Code did not match');
        }
 
	}

    public function newEmail(){
        if(empty($this->request->uri->getSegment(3))){
            return redirect()->to('dashboard/settings');
        }else{
            $id =  $this->request->uri->getSegment(3);
            $code = $this->request->uri->getSegment(4);
        }
        

        $registerModel = new \App\Models\RegisterModel;
        $data['users'] = $registerModel->getUsers($id);

        foreach ($data['users'] as $row){
            $dbID =  $row->id;
            $dbCode = $row->code;
            $email =  $row->email_rep;
            $dbStart = $row->activatelink;
        }

        if(!empty($id) && !empty($code)){
            if($dbStart == "used"){
                return redirect()->to('dashboard/settings')->with('fail', 'Error: Already activated.');
            }else{
                $start = strtotime($dbStart);
                $end = date('Y-m-d H:i:s');
                $ends = strtotime($end);
                $hours = intval(($ends - $start)/3600);
                if($hours > 0){
                    return redirect()->to('dashboard/settings')->with('fail', 'Error: Email Link Expires.');  
                }else{
                    if($code == $dbCode && $id == $dbID){
                        $registerModel = new \App\Models\RegisterModel;
                        $query = $registerModel->newemail($email,$code);
                        $eventName = $userInfo['name'];
                        $passevent = $registerModel->emailupEvent($eventName);
                        if($query){
                            if(session()->has('loggedUser')){
                                session()->remove('loggedUser');
                                return redirect()->to('auth?access=out')->with('success', 'Email Changed! Please login.');
                            }
                        }
                        else{
                            return redirect()->to('dashboard/settings')->with('fail', 'Something went wrong in activating account');                  
                        }
                    }else{
                        return redirect()->to('dashboard/settings')->with('fail', 'Account does not exist.');
                    }
                } 
            }   
        }else{
            return redirect()->to('dashboard/settings')->with('fail', 'Cannot activate account. Code did not match');
        }

    }

    public function emailUpdatelink(){
        $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $validation = $this->validate([
            'email'=>[
                'rules'=>'is_not_unique[tblusers.email]',
                'errors'=>[
                    'is_not_unique'=>'Account does not exist.'
                ]
                ],
            ]);
        $email = $this->request->getPost('email');
        if($email == $userInfo['email']){
            return redirect()->back()->with('fail', 'Warning: Same email used!');
        }elseif($validation){
            return redirect()->back()->with('warn', 'Warning: Email already used.');
        }else{
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
                                                            Yes '.$userInfo['name'].', we know.
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
                                                                    <a href="'.base_url().'/dashboard/newEmail/'.$userInfo['id'].'/'.$userInfo['code'].'" style="background:#2F67F6;color:#ffffff;font-family:Helvetica Neue,Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
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
                                                            <a href="'.base_url().'/dashboard/newEmail/'.$userInfo['id'].'/'.$userInfo['code'].'" target="_blank"" style="color:#2F67F6">'.base_url().'/dashboard/newEmail/</a>
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
                $registerModel = new \App\Models\RegisterModel();
                $code = $userInfo['code'];
                $query = $registerModel->email_rep($email,$code,$linkTime);
                
                return redirect()->back()->with('success', 'Email Activation link sent!');
            }else{
                
                $data = $emailInstance->printDebugger(['headers']);
                print_r($data);
            }
        }

    }
    
    public function passwordUpdate(){
        $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $eventName = $userInfo['name'];
        $password = $this->request->getPost('opassword');
        $newpassword = $this->request->getPost('password');
        $checkpass = Hash::check($password, $userInfo['password']);
        $validation = $this->validate([
            'password'=>[
                'rules'=>'min_length[5]|max_length[12]',
                'errors'=>[
                    'min_length'=>'Password must be at least 5 characters.',
                    'max_length'=>'Password cannot exceed 12 characters.'
                ]
                ],
            
            ]);
        $validationMatch = $this->validate([
            'cpassword'=>[
                'rules'=>'matches[password]',
                'errors'=>[
                    'matches'=>'Password not match.'
                ]
                ]
        ]);
            if(!$checkpass){
                return redirect()->back()->with('fail', 'Warning: Incorrect old password');
            }elseif(!$validation){
                return redirect()->back()->with('warning', 'Warning: Password must be 5-12 characters');
            }elseif(!$validationMatch){
                return redirect()->back()->with('fail', 'Warning: Password does not match');
            }else{
                $updatePass = Hash::make($newpassword);
                $code = $userInfo['code'];
                  
                    $registerModel = new \App\Models\RegisterModel();
                    $query = $registerModel->resetpassword($updatePass,$code);
    
                    if(!$query){
                        return redirect()->back()->with('fail', 'Something went wrong.');
                    }else{
                        $registerModel = new \App\Models\RegisterModel();
                        $query = $registerModel->resetUsed($code);
                        $passevent = $registerModel->passwordEvent($eventName);
                        if(!$query){
                            return redirect()->back()->with('fail', 'Something went wrong.');
                        }else{
                            return redirect()->to('dashboard/settings')->with('success', 'Password Updated!');
                        }
                    }
            }
    }
    
    public function profileUpdate(){
        $registerModel = new \App\Models\RegisterModel();
        $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $eventName = $userInfo['name'];
        $code = $userInfo['code'];
        $name = $this->request->getPost('name');
        $bio = $this->request->getPost('message');
        $image = $this->request->getFile('userfile');
        
        if(empty($name)){
            if(empty($bio)){
                if(empty($_FILES['userfile']['name'])){
                    return redirect()->back();
                }else{
                    $validationRule = [
                        'userfile' => [
                            'label' => 'Image File',
                            'rules' => 'uploaded[userfile]'
                                . '|is_image[userfile]'
                                . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                                . '|max_size[userfile,100]'
                                . '|max_dims[userfile,1024,768]',
                        ],
                    ];
                    if(!$validationRule){
                        return redirect()->back()->with('fail', 'Error: Invalid image input.');
                    }else{
                        if($image->isValid() && ! $image->hasMoved()){
                            $newName = $image->getRandomName(); 
                            $image->move('./public/uploads', $newName);

                            $old_image = $userInfo['profile'];
                            
                            if(file_exists("public/uploads/".$old_image)){
                                unlink('public/uploads/'.$old_image);
                            }
                            $query = $registerModel->newImage($newName,$code);
                            if(!$query){
                                return redirect()->back()->with('fail', 'Something went wrong.');
                            }else{
                                $event = $registerModel->profileEvent($eventName);
                                return redirect()->to('dashboard/settings')->with('success', 'Profile Updated!');
                            }
                        }else{
                            return redirect()->back()->with('fail', 'Error: Unable to Upload Image.');
                            
                        }
                    }
                }
            }else{
                if(empty($_FILES['userfile']['name'])){
                    $query1 = $registerModel->newBio($bio,$code);
                            if(!$query1){
                                return redirect()->back()->with('fail', 'Something went wrong.');
                            }else{
                                $event = $registerModel->profileEvent($eventName);
                                return redirect()->to('dashboard/settings')->with('success', 'Profile Updated!');
                            }
                }else{
                    $validationRule = [
                        'userfile' => [
                            'label' => 'Image File',
                            'rules' => 'uploaded[userfile]'
                                . '|is_image[userfile]'
                                . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                                . '|max_size[userfile,100]'
                                . '|max_dims[userfile,1024,768]',
                        ],
                    ];
                    if(!$validationRule){
                        return redirect()->back()->with('fail', 'Error: Invalid image input.');
                    }else{
                        if($image->isValid() && ! $image->hasMoved()){
                            $newName = $image->getRandomName(); 
                            $image->move('./public/uploads', $newName);
                            $old_image = $userInfo['profile'];
                            
                            if(file_exists("public/uploads/".$old_image)){
                                unlink('public/uploads/'.$old_image);
                            }
                            $query = $registerModel->newImage($newName,$code);
                            $query1 = $registerModel->newBio($bio,$code);
                            if(!$query && !$query1){
                                return redirect()->back()->with('fail', 'Something went wrong.');
                            }else{
                                $event = $registerModel->profileEvent($eventName);
                                return redirect()->to('dashboard/settings')->with('success', 'Profile Updated!');
                            }
                        }else{
                            return redirect()->back()->with('fail', 'Error: Unable to Upload Image.');
                        }
                    }
                }
            }
        }else{
            if(empty($bio)){
                if(empty($_FILES['userfile']['name'])){
                    $query1 = $registerModel->newName($name,$code);
                            if(!$query1){
                                return redirect()->back()->with('fail', 'Something went wrong.');
                            }else{
                                $event = $registerModel->profileEvent($eventName);
                                return redirect()->to('dashboard/settings')->with('success', 'Profile Updated!');
                            }
                }else{
                    $validationRule = [
                        'userfile' => [
                            'label' => 'Image File',
                            'rules' => 'uploaded[userfile]'
                                . '|is_image[userfile]'
                                . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                                . '|max_size[userfile,100]'
                                . '|max_dims[userfile,1024,768]',
                        ],
                    ];
                    if(!$validationRule){
                        return redirect()->back()->with('fail', 'Error: Invalid image input.');
                    }else{
                        if($image->isValid() && ! $image->hasMoved()){
                            $newName = $image->getRandomName(); 
                            $image->move('./public/uploads', $newName);
                            $old_image = $userInfo['profile'];
                            
                            if(file_exists("public/uploads/".$old_image)){
                                unlink('public/uploads/'.$old_image);
                            }
                            $query = $registerModel->newImage($newName,$code);
                            $query1 = $registerModel->newName($name,$code);
                            if(!$query && !$query1){
                                return redirect()->back()->with('fail', 'Something went wrong.');
                            }else{
                                $event = $registerModel->profileEvent($eventName);
                                return redirect()->to('dashboard/settings')->with('success', 'Profile Updated!');
                            }
                        }else{
                            return redirect()->back()->with('fail', 'Error: Unable to Upload Image.');
                        }
                    }
                }
            }else{
                if(empty($_FILES['userfile']['name'])){
                    $query = $registerModel->newName($name,$code);
                    $query1 = $registerModel->newBio($bio,$code);
                            if(!$query1 && !$query){
                                return redirect()->back()->with('fail', 'Something went wrong.');
                            }else{
                                $event = $registerModel->profileEvent($eventName);
                                return redirect()->to('dashboard/settings')->with('success', 'Profile Updated!');
                            }
                }else{
                    $validationRule = [
                        'userfile' => [
                            'label' => 'Image File',
                            'rules' => 'uploaded[userfile]'
                                . '|is_image[userfile]'
                                . '|mime_in[userfile,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                                . '|max_size[userfile,100]'
                                . '|max_dims[userfile,1024,768]',
                        ],
                    ];
                    if(!$validationRule){
                        return redirect()->back()->with('fail', 'Error: Invalid image input.');
                    }else{
                        if($image->isValid() && ! $image->hasMoved()){
                            $newName = $image->getRandomName(); 
                            $image->move('./public/uploads', $newName);
                            $old_image = $userInfo['profile'];
                            
                            if(file_exists("public/uploads/".$old_image)){
                                unlink('public/uploads/'.$old_image);
                            }
                            $query = $registerModel->newImage($newName,$code);
                            $query1 = $registerModel->newBio($bio,$code);
                            $query2 = $registerModel->newName($name,$code);
                            if(!$query && !$query1 && !$query2){
                                return redirect()->back()->with('fail', 'Something went wrong.');
                            }else{
                                $event = $registerModel->profileEvent($eventName);
                                return redirect()->to('dashboard/settings')->with('success', 'Profile Updated!');
                            }
                        }else{
                            return redirect()->back()->with('fail', 'Error: Unable to Upload Image.');
                        }
                    }
                }
            }
        }
        
    }
    
   
}
