<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tblusers';
    protected $primarykey = 'id';
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'code',
        'active',
        'visible',
        'activatelink',
        'profile',
        'bio',
        'role'
        
    ];

    public function allUsers(){
        
        $db = \Config\Database::connect();
        return $this->select()->where('role','User')->where('visible',0)->paginate(10);
    }

    public function allAdmin(){
        
        $db = \Config\Database::connect();
        $array = ['Administrator','Teacher'];
        return $this->select()->whereIn('role',$array)->paginate(10);
    }

    public function archiveuser(){
        
        $db = \Config\Database::connect();
        return $this->select()->where('visible',1)->paginate(10);
    }

    public function archiveusersearch($search){
        
        $db = \Config\Database::connect();
        return $this->select()->where('visible',1)->like('name',$search,'both')->paginate(10);
    }

    public function allUsersSearch($search){
        $array = [
            'role'=>'User',
            'visible'=>0
        ];
        $db = \Config\Database::connect();
        return $this->select()->where($array)->like('name',$search,'both')->paginate(10);
    }

    public function show_edit($userID){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tblusers WHERE code = ?',$userID);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function update_user($data,$userID){
        $db = \Config\Database::connect();
        $builder = $db->table('tblusers');
        $result = $builder->set($data);
        $builder->where('code', $userID);
        $builder->update();
        
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function allAdmins(){
        
        $db = \Config\Database::connect();
        return $this->select()->where('role','Administrator')->paginate(10);
    }

    public function allTeachers(){
        
        $db = \Config\Database::connect();
        return $this->select()->where('role','Teacher')->paginate(10);
    }
    
    public function countUsers(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(*) AS userCount FROM tblusers WHERE role = "User"');
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function deleteuser($archive,$id){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblusers');
        $builder->set('visible', $archive);
        
        $builder->where('id', $id);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function countAdmins(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(*) AS adminCount FROM tblusers WHERE role != "User"');
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function countActivated(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(*) AS userCount FROM tblusers WHERE active = 1');
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function countPending(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(*) AS userCount FROM tblusers WHERE active = 0');
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function getLessons($code){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT *
        FROM tbllessoncon       
        WHERE NOT EXISTS (SELECT lesson FROM tblstudent WHERE tblstudent.lesson=tbllessoncon.id AND tblstudent.name = ?) AND archive = 0',$code);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function getLesson(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tbllessoncon WHERE archive = 0');
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function searchTable($search){
        $db = \Config\Database::connect();
        $query = "SELECT * FROM tbllessoncon WHERE `title`LIKE '%".$search."%' or `short_description` LIKE '%".$search."%';";
        
        $query = $db->query($query);
        
        $result = $query->getResult();
        
        if(count($result)>0){
            
            return $result; 
        }else{
            return false;
        }
    }

    public function searchName($search){
        $db = \Config\Database::connect();
        $query = "SELECT * FROM tblusers WHERE `name` LIKE '%".$search."%';";
        $query = $db->query($query);
        $result = $query->getResult();
        if(count($result)>0){
            return $result;
            
        }else{
            return false;
        }
    }

    public function getQuest($lessonId){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tbllessonquess WHERE lesson_id = ?',$lessonId);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function getLessonTitle($lessonId){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tbllessoncon WHERE id = ?',$lessonId);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function getWatch($id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tbllessoncon WHERE id = ?', $id);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function getScore($id){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(question) AS NumberOfQuestion FROM tbllessonquess WHERE lesson_id = ?', $id);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function getLessCount(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(title) AS NumberOfLesson FROM tbllessoncon WHERE archive = 0');
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function getQuesCount(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(question) AS NumberOfQuest FROM tbllessonquess');
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function geteventCount(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(event) AS NumberOfEvents FROM tblevents');
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function getGrade($id,$name){
        $db = \Config\Database::connect();
        $query = 'SELECT grade FROM tblstudent WHERE `name` = "'.$name.'" AND lesson = '.$id;
        $query = $db->query($query);

        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function topfive(){
        $db = \Config\Database::connect();
        $query = "SELECT tblusers.name,tblusers.bio,tblusers.code,tblusers.profile, SUM(tblstudent.grade) as sum_score
        FROM tblstudent
        INNER JOIN tblusers ON tblstudent.name = tblusers.code
        GROUP BY tblstudent.name ORDER BY sum_score DESC
        LIMIT 5;";
        $query = $db->query($query);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function findnemo($code){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tblusers WHERE code = ?', $code);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function upGrade($id,$grade,$name){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblstudent');
        $builder->set('grade', $grade);
        $builder->where('name', $name);
        $builder->where('lesson', $id);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function upAch($name,$id,$grade){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblstudent');
        $builder->set('a_status', 1);
        $builder->set('grade', $grade);
        $builder->where('name', $name);
        $builder->where('lesson', $id);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function achcount($code){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(*) AS ach_count FROM tblstudent WHERE name = ? AND a_status = 1', $code);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function lesscount($code){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(lesson) AS lesson_count FROM tblstudent WHERE name = ?', $code);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }

    public function achieve($code){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT tbllessoncon.achievement, tbllessoncon.icon, tbllessoncon.title
        FROM tblstudent 
        INNER JOIN tbllessoncon ON tbllessoncon.id = tblstudent.lesson
        WHERE tblstudent.a_status = 1 AND tblstudent.name = ?',$code);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }
   
    public function doneLesson($code){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT tbllessoncon.title, tbllessoncon.id, tbllessoncon.short_description
        FROM tbllessoncon
        INNER JOIN tblstudent ON tbllessoncon.id = tblstudent.lesson
        WHERE tblstudent.name = ?',$code);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result; 
        }else{
            return false;
        }
    }
}


?>