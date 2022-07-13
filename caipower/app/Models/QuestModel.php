<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestModel extends Model
{
    protected $table = 'tbllessonquess';
    protected $primarykey = 'id';
    protected $allowedFields = ['lesson_id','choice1','choice2','choice3','choice4','answer','number','question','archive'];

    public function questions(){
        
        $db = \Config\Database::connect();
        return $this->select()->/* where('archive',0)-> *//* like('title',$search,'both')-> */paginate(5);
    }

    public function questionsarchive(){
        
        $db = \Config\Database::connect();
        return $this->select()->where('archive',1)->/* like('title',$search,'both')-> */paginate(5);
    }

    public function questionssearch($search){
        
        $db = \Config\Database::connect();
        return $this->select()->like('question',$search,'both')->orLike('id',$search,'both')->orLike('lesson_id',$search,'both')->where('archive',0)->paginate(5);
    }

    public function deleteQuestion($id,$archive){
        $db      = \Config\Database::connect();
        $builder = $db->table('tbllessonquess');
        $builder->set('archive', $archive);
        $builder->where('id', $id);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function deleteQuestionDelLesson($id,$archive){
        $db      = \Config\Database::connect();
        $builder = $db->table('tbllessonquess');
        $builder->set('archive', $archive);
        $builder->where('lesson_id', $id);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }


    public function show_edit($lessonId){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tbllessonquess WHERE id = ?',$lessonId);
        $result = $query->getResult();
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function questupdate($array,$id){
        $db = \Config\Database::connect();
        $builder = $db->table('tbllessonquess');
        $builder->set($array);
        $builder->where('id', $id);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    
}
?>