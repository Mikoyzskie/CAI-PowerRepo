<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Libraries\hash;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\UsersModel;
use App\Models\RegisterModel;


class auth extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }
    public function index()
    {
        return view('auth/login');
    }

    public function reset()
    {
        return view('auth/reset_email');
    }

    public function frequently_asked_questions()
    {
        return view('auth/frequent');
    }

    public function password_reset(){
        $code = $this->request->uri->getSegment(3);
        $registerModel = new \App\Models\RegisterModel();
        $data['token'] = $registerModel->verifyToken($code);


        foreach ($data['token'] as $row){
            $dbStart = $row->resetlink;
        }
        
        if(!empty($data['token'])){
            if($dbStart == 'used'){
                return redirect()->to('auth/')->with('fail', 'Reset link already used.');
            }else{
                $start = strtotime($dbStart);
                $end = date('Y-m-d H:i:s');
                $ends = strtotime($end);
                $hours = intval(($ends - $start)/3600);
    
                if($hours > 0){
                    return redirect()->to('auth/')->with('fail', 'Reset Link Expires.');
                }else{
                    return view('auth/password_reset',$data);
                }
            }           
        }else{
            return redirect()->to('auth/')->with('fail', 'Account does not exist.');
        }
        return view('auth/password_reset',$data);
    }

    public function register(){
        return view('auth/register');
    }

    public function save(){
        
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
            'g-recaptcha-response'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Click recaptcha to Verify  .   '
                ]
                ]
            
        ]);

      $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
         
      $secret='6Lc3WFAdAAAAAE-1MIaPOmNU1M7K_qlq_neNTCDG';
       
      $credential = array(
            'secret' => $secret,
            'response' => $this->request->getVar('g-recaptcha-response')
        );
 
      $verify = curl_init();
      curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
      curl_setopt($verify, CURLOPT_POST, true);
      curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
      curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($verify);
 
      $status= json_decode($response, true);
            

        if(!$validation){
            return view('auth/register',['validation'=>$this->validator]);
        }else{
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
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
                'role'=>'User'
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
                                                                    <a href="'.base_url().'/auth/verify/'.$userID.'/'.$code.'" style="background:#2F67F6;color:#ffffff;font-family:Helvetica Neue,Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
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
                                                            <a href="'.base_url().'/auth/verify/'.$userID.'/'.$code.'" target="_blank"" style="color:#2F67F6">'.base_url().'/auth/verify/</a>
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
             

            if($status['success']){ 
                if($emailInstance->send()){
                    if(!$query){
                        return redirect()->back()->with('fail', 'Something went wrong.');
                        //return redirect()->to('register')->with('fail', 'Something went wrong.');
                    }else{
                        $registerModel = new \App\Models\RegisterModel;
                        $eventName = $name;
                        $passevent = $registerModel->registered($eventName);
                        return redirect()->to('auth/register')->with('success', 'Registered successfully. Email Verification Sent.');
                    }
                }else{
                    
                    $data = $emailInstance->printDebugger(['headers']);
                    print_r($data);
                }
            }else{
                return redirect()->back()->with('fail', 'Something went wrong.');
            }
        }
    }


    public function admin_email_verify(){
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
            $eventName = $row->name;
        }

        if(!empty($id) && !empty($code)){
            if($dbStart == "used"){
                return redirect()->to('auth/')->with('fail', 'Error: Already activated.');
            }else{
                $start = strtotime($dbStart);
                $end = date('Y-m-d H:i:s');
                $ends = strtotime($end);
                $hours = intval(($ends - $start)/3600);
                if($hours > 0){
                    return redirect()->to('auth/')->with('fail', 'Error: Email Link Expires.');  
                }else{
                    if($code == $dbCode && $id == $dbID){
                        $registerModel = new \App\Models\RegisterModel;
                        $query = $registerModel->newemail($email,$code);
                        
                        $passevent = $registerModel->emailupEvent($eventName);
                        if($query){
                            if(session()->has('loggedUser')){
                                session()->remove('loggedUser');
                                return redirect()->to('auth?access=out')->with('success', 'Email Changed! Please login.');
                            }
                            return redirect()->to('auth?access=out')->with('success', 'Email Changed! Please login.');
                        }
                        else{
                            return redirect()->to('auth/')->with('fail', 'Something went wrong in activating account');                  
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

    public function verify(){

        if(empty($this->request->uri->getSegment(3)) && empty($this->request->uri->getSegment(4))){
            return redirect()->to('auth/');
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
                return redirect()->to('auth/')->with('fail', 'Already activated.');
            }else{
                $start = strtotime($dbStart);
                $end = date('Y-m-d H:i:s');
                $ends = strtotime($end);
                $hours = intval(($ends - $start)/3600);
                if($hours > 0){
                    return redirect()->to('auth/')->with('fail', 'Email Link Expires. Contact Support For New Link.');  
                }else{
                    if($code == $dbCode && $id == $dbID){
                        $registerModel = new \App\Models\RegisterModel;
                        $query = $registerModel->activate($code);
                        
                        if($query){
                            $query = $registerModel->emailVerify($eventName);
                            return redirect()->to('auth/')->with('success', 'Email Verified!');
                        }
                        else{
                            return redirect()->to('auth/')->with('fail', 'Something went wrong in activating account');                  
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

    public function test(){
        $email = 'escalamykkenneth@gmail.com';
        $registerModel = new \App\Models\RegisterModel;
        $data = $registerModel->lockCheck($email);

        foreach ($data as $row){
            echo  $row->active;
            echo $row->attempt;
            echo $row->visible;
        }
    }

    function check(){
        //Credentials validation

        $validation = $this->validate([
            'email'=>[
                'rules'=>'is_not_unique[tblusers.email]',
                'errors'=>[
                    'is_not_unique'=>'Account does not exist.'
                ]
                ],
                'g-recaptcha-response'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Click recaptcha to Verify  .   '
                    ]
                    ]
                
                ]);
        
        if(!$validation){
            return view('auth/login',['validation'=>$this->validator]);
        }else{
            //Credential check

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $usersModel = new \App\Models\UsersModel();
            $user_info = $usersModel->where('email', $email)->first();
            if($user_info['role']=='Administrator' || $user_info['role']=='Teacher'){
                return redirect()->to('auth/')->with('fail', 'Admin account.');
            }else{
                $check_password = Hash::check($password, $user_info['password']);

                $registerModel = new \App\Models\RegisterModel;
                $data = $registerModel->lockCheck($email);
                    
                foreach ($data as $row){
                    $isActivated = $row->active;
                    $isLocked = $row->attempt;
                    $isArchived = $row->visible;
                }
        
                    if($isLocked == 3){
                        return redirect()->to('auth/')->with('fail', 'Account Locked. Contact Support to Unlock.');
                    }else{
                        if(!$check_password){
                            
                            $query = $registerModel->attempt($email);
            
                            if($query){
                                session()->setFlashdata('fail', 'Incorrect Password');
                                return redirect()->to('/auth')->withInput();
                            }
                            else{
                                return redirect()->to('auth/')->with('fail', 'Something went wrong');                  
                            }
            
                           
                        }else{
                            if($isArchived == 1){
                                return redirect()->to('auth/')->with('fail', 'Account Doesnt Exist.');
                            }else{
                                if($isActivated == 0){
                                    return redirect()->to('auth/')->with('fail', 'Account Not Verified, Please Check Your Email.');
                                }else{
                                    $user_id = $user_info['id'];
                                    session()->set('loggedUser', $user_id);
                                    $eventName = $user_info['name'];
                                    $query = $registerModel->loggedIn($eventName);
                                    return redirect()->to('/dashboard');
                                } 
                            }                                   
                        }
                    }
            }
        
        }
    }

    public function password_reset_link(){
        

        $validation = $this->validate([
                'email'=>[
                    'rules'=>'is_not_unique[tblusers.email]',
                    'errors'=>[
                        'is_not_unique'=>'Account does not exist.'
                    ]
                    ]
                
                    ]);
            
            if(!$validation){
                return view('auth/reset_email',['validation'=>$this->validator]);
            }else{
        $email = $this->request->getPost('email');
        $registerModel = new \App\Models\RegisterModel;
        $data = $registerModel->confirmEmail($email);

        foreach ($data as $row){    
            $code = $row->code;
            $isActivated = $row->active;
            $isArchived = $row->visible;
            
        }

                $subject = 'Password Reset - CAI PowerPoint';
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
                                                                    Reset Your Password
                                                                </div>
                    
                                                            </td>
                                                        </tr>
                    
                                                        
                    
                                                        <tr>
                                                            <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                    
                                                                <div style="font-family:Helvetica Neue,Arial,sans-serif;font-size:16px;line-height:22px;text-align:center;color:#555;">
                                                                    Here is your password reset link.
                                                                </div>
                    
                                                            </td>
                                                        </tr>
                    
                                                        <tr>
                                                            <td></td>
                                                        </tr>
                    
                                                        <tr>
                                                            <td align="center" style="font-size:0px;padding:10px 25px;padding-top:30px;padding-bottom:40px;word-break:break-word;">
                    
                                                                <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                                                    <tr>
                                                                        <td align="center" bgcolor="#2F67F6" role="presentation" style="border:none;border-radius:3px;color:#ffffff;cursor:auto;padding:15px 25px;" valign="middle">
                                                                            <a href="'.base_url().'/auth/password_reset/'.$code.'" style="background:#2F67F6;color:#ffffff;font-family:Helvetica Neue,Arial,sans-serif;font-size:15px;font-weight:normal;line-height:120%;Margin:0;text-decoration:none;text-transform:none;">
                                                                                Reset Password
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
                                                                    <a href="'.base_url().'/auth/password_reset/'.$code.'/" target="_blank"" style="color:#2F67F6">'.base_url().'/auth/password_reset/'.$code.'</a>
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

                if($isArchived == 0){
                    if($isActivated == 1){
                        if ($emailInstance->send()){
                            $date = date("Y-m-d H:i:s");
                            $registerModel = new \App\Models\RegisterModel;
                            $query = $registerModel->reset_expire($email,$date);
                                if(!$query){
                                    return redirect()->to('auth/reset')->with('fail', 'Something went wrong.');
                                }else{
                                    return redirect()->to('auth/reset')->with('success', 'Password Reset Link Sent.');
                                }
                            
                        }else{
                            $data = $emailInstance->printDebugger(['headers']);
                            print_r($data);
                        }
                    }else{
                        return redirect()->to('auth/reset')->with('fail', 'Account is not activated.');
                    }                   
                }else{
                    return redirect()->to('auth/reset')->with('fail', 'Account does not exist.');
                }
                
            }
    }

    public function resetPass(){
        if(empty($this->request->uri->getSegment(3))){
            return redirect()->to('auth/');
        }else{
            $code = $this->request->uri->getSegment(3);
        }
        
                $validation = $this->validate([
                    'password'=>[
                        'rules'=>'min_length[5]|max_length[12]',
                        'errors'=>[
                            'min_length'=>'Password must be at least 5 characters.',
                            'max_length'=>'Password cannot exceed 12 characters.'
                        ]
                        ]
                    
                ]);
                $validateMatch = $this->validate([
                    'cpassword'=>[
                        'rules'=>'matches[password]|min_length[5]|max_length[12]',
                        'errors'=>[
                            'matches'=>'Password not match.',
                            'min_length'=>'Password must be at least 5 characters.',
                            'max_length'=>'Password cannot exceed 12 characters.'
                        ]
                    ],
                ]);
                $validateCaptcha = $this->validate([
                     
                    'g-recaptcha-response'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Click recaptcha to Verify.   '
                        ]
                        ]
                ]);
    
                if(!$validation){
                    return redirect()->back()->with('fail', 'Password must be 5 to 12 characters long.');
                }
                elseif(!$validateMatch){
                    return redirect()->back()->with('fail', 'Password not match.');
                }elseif(!$validateCaptcha){
                    return redirect()->back()->with('fail', 'Click to verify recaptcha.');
                }else{
                    $recaptchaResponse = trim($this->request->getVar('g-recaptcha-response'));
             
                    $secret='6Lc3WFAdAAAAAE-1MIaPOmNU1M7K_qlq_neNTCDG';
                     
                    $credential = array(
                          'secret' => $secret,
                          'response' => $this->request->getVar('g-recaptcha-response')
                      );
               
                    $verify = curl_init();
                    curl_setopt($verify, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                    curl_setopt($verify, CURLOPT_POST, true);
                    curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($credential));
                    curl_setopt($verify, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
                    $response = curl_exec($verify);
               
                    $status= json_decode($response, true);
    
                  $password = $this->request->getPost('password');
                  $updatePass = Hash::make($password);
    
                  if($status['success']){
                    $registerModel = new \App\Models\RegisterModel();
                    $query = $registerModel->resetpassword($updatePass,$code);
    
                    if(!$query){
                        return redirect()->back()->with('fail', 'Something went wrong.');
                    }else{
                        $registerModel = new \App\Models\RegisterModel();
                        $query = $registerModel->resetUsed($code);
                        if(!$query){
                            return redirect()->back()->with('fail', 'Something went wrong.');
                        }else{
                            return redirect()->to('auth/')->with('success', 'Password Updated!');
                        }
                    }
                  }else{
                    return redirect()->back()->with('fail', 'Something went wrong.');
                  }
                }
    }

    function logout(){
        if(session()->has('loggedUser')){
            $registerModel = new \App\Models\RegisterModel;
            $usersModel = new \App\Models\UsersModel;
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserID);
        $eventName = $userInfo['name'];
            $passevent = $registerModel->loggedOut($eventName);

            session()->remove('loggedUser');
            
            return redirect()->to('auth?access=out');
        }
    }
}