<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table = 'tblevents';
    protected $primarykey = 'id';
    protected $allowedFields = ['event','description','time'];

    public function events(){
        
        $db = \Config\Database::connect();
        return $this->select()->orderBy('id', 'DESC')->paginate(10);
    }

    public function eventsearch($search){
        $db = \Config\Database::connect();
       
        return $this->select()->like('description',$search,'both')->paginate(10);
    }
    public function eventsearch2($search){
        $db = \Config\Database::connect();
       
        return $this->select()->like('event',$search,'both')->paginate(10);
    }
    public function eventsearch3($search){
        $db = \Config\Database::connect();
       
        return $this->select()->like('time',$search,'both')->paginate(10);
    }


}
?>