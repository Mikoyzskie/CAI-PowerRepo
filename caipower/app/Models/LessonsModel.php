<?php

namespace App\Models;

use CodeIgniter\Model;

class LessonsModel extends Model
{
    protected $table = 'tbllessoncon';
    protected $primarykey = 'id';
    protected $allowedFields = ['title','thumb','vid_link','short_description','achievement','icon','archive'];

    public function lessons(){
        
        $db = \Config\Database::connect();
        return $this->select()->where('archive',0)->paginate(10);
    }

    public function archivelessons(){
        
        $db = \Config\Database::connect();
        return $this->select()->where('archive',1)->paginate(10);
    }
    
    public function lessonsearch($search){
        $db = \Config\Database::connect();
        return $this->select()->where('archive',0)->like('title',$search,'both')->paginate(10);
    }

    public function show_edit($lessonID){
            $db = \Config\Database::connect();
            $query = $db->query('SELECT * FROM tbllessoncon WHERE id = ?',$lessonID);
            $result = $query->getResult();
            
            if(count($result)>0){
                return $result;
            }else{
                return false;
            }
    }

    public function events(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM tblevents');
        $result = $query->getResult();;
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }

    public function upLesson($title,$link,$descript,$achieve,$icon,$avail,$lessonID){
        
        $db      = \Config\Database::connect();
        $builder = $db->table('tbllessoncon');
        $builder->set('title', $title);
        $builder->set('vid_link', $link);
        $builder->set('short_description', $descript);
        $builder->set('achievement', $achieve);
        $builder->set('icon', $icon);
        $builder->set('archive', $avail);
        $builder->where('id', $lessonID);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function upThumb($thumbs,$lessonID){
        $db      = \Config\Database::connect();
        $builder = $db->table('tbllessoncon');
        $builder->set('thumb', $thumbs);
        $builder->where('id', $lessonID);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function deleteLesson($id,$archive){
        $db      = \Config\Database::connect();
        $builder = $db->table('tbllessoncon');
        $builder->set('archive', $archive);
        $builder->where('id', $id);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function unlockUser($code){
        $db      = \Config\Database::connect();
        $builder = $db->table('tblusers');
        $builder->set('attempt', 0);
        $builder->where('code', $code);
        $result = $builder->update();
       
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
}
?>