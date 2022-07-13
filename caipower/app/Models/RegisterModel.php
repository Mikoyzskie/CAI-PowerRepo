<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class RegisterModel extends Model
{
    public function getUsers($id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tblusers WHERE id = ?',$id);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function activate($code){
        $db = \Config\Database::connect();
        $query = $db->query('UPDATE tblusers SET active = 1, activatelink = "used" WHERE code = ?',$code);
        if(!$query){
            return false;
        }else{
            return $query;
        }
    }

    public function resetUsed($code){
        $db = \Config\Database::connect();
        $query = $db->query('UPDATE tblusers SET resetlink = "used" WHERE code = ?',$code);
        if(!$query){
            return false;
        }else{
            return $query;
        }
    }
    
    public function attempt($email){
        $db = \Config\Database::connect();
        $query = $db->query('UPDATE tblusers SET attempt = attempt + 1 WHERE email = ?', $email);
        if(!$query){
            return false;
        }else{
            return $query;
        }
    }

    public function lockCheck($email){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT attempt,active,visible FROM tblusers WHERE email = ?',$email);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function confirmEmail($email){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tblusers WHERE email = ?',$email);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function resetpassword($updatePass,$code){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblusers');
        $builder->set('password', $updatePass);
        $builder->where('code', $code);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function newemail($email,$code){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblusers');
        $array = [
            'email' => $email,
            'activatelink' => "used",
            'email_rep' => ""
        ];
        $builder->set($array);
        $builder->where('code', $code);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function email_rep($email,$code,$linkTime){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblusers');

        $array = [
            'email_rep'   => $email,
            'activatelink'  => $linkTime,           
        ];
        $builder->set($array);
        $builder->where('code', $code);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function reset_expire($email,$date){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblusers');
        $builder->set('resetlink', $date);
        $builder->where('email', $email);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function verifyToken($code){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tblusers WHERE code = ?',$code);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function newName($name,$code){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblusers');
        $builder->set('name', $name);
        $builder->where('code', $code);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function newBio($bio,$code){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblusers');
        $builder->set('bio', $bio);
        $builder->where('code', $code);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function newImage($newName,$code){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblusers');
        $builder->set('profile', $newName);
        $builder->where('code', $code);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function gradeSave($lessonID,$code,$grade){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblstudent');
        $data = [
            'name' => $code,
            'lesson' => $lessonID,
            'grade' => $grade
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function profileEvent($eventName){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $eventName.' updated profile settings.';
        $data = [
            'event' => "Profile Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function emailupEvent($eventName){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $eventName.' updated email settings.';
        $data = [
            'event' => "Email Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function adminEventEmail($eventName,$admin){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' updated '.$eventName.' email settings.';
        $data = [
            'event' => "Email Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function adminEventQuest($lesson,$admin,$id){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' updated '.$lesson.' question number '.$id.'.';
        $data = [
            'event' => "Quiz Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function adminEventProfile($eventName,$admin){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' updated '.$eventName.' profile settings.';
        $data = [
            'event' => "Email Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function adminDelLess($eventName,$admin){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' archived lesson '.$eventName.'.';
        $data = [
            'event' => "Lesson Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function adminResLess($eventName,$admin){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' restored lesson'.$eventName.'.';
        $data = [
            'event' => "Lesson Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function adminDelQuest($lesson,$admin,$id,$status){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' '.$status.' question '.$id.' from Lesson ID '.$lesson.'.';
        $data = [
            'event' => "Quiz Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function adminDelUser($eventName,$admin){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' archived '.$eventName.'.';
        $data = [
            'event' => "User Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function adminResUser($eventName,$admin){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' restored '.$eventName.'.';
        $data = [
            'event' => "User Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function adminUpLess($eventName,$admin){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' edited '.$eventName.'.';
        $data = [
            'event' => "Lesson Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function passwordEvent($eventName){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $eventName.' updated password settings.';
        $data = [
            'event' => "Profile Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function AdminpasswordEvent($eventName,$admin){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $admin.' updated '.$eventName.' password settings.';
        $data = [
            'event' => "Profile Update",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }
    
    public function emailVerify($eventName){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $eventName.' verify email address.';
        $data = [
            'event' => "Email Verify",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function achievementUnlock($eventName, $ach){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $eventName.' achieve '.$ach.'.';
        $data = [
            'event' => "Achievement Unlock",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function loggedOut($eventName){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $eventName.' logged out.';
        $data = [
            'event' => "Log Out",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function loggedIn($eventName){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $eventName.' logged in.';
        $data = [
            'event' => "Log In",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }

    public function registered($eventName){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblevents');
        $desc = $eventName.' successfully registered.';
        $data = [
            'event' => "Registration",
            'description' => $desc,
        ];
       
        if($builder->insert($data)){
            return true;
        }else{
            return false;
        }
    }
}