<?php

namespace App\Models;
use CodeIgniter\Model;

class PagerModel extends Model
{
    
    public function PaginateUsers(){
        
        $db = \Config\Database::connect();
        $query = $db->query('SELECT COUNT(*) FROM tblusers');
        $result = $query->getResult();
        
        
        if(count($result)>0){
            return $result;
        }else{
            return false;
        }
    }
}
