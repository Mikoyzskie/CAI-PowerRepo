<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeModel extends Model
{
    protected $table = 'tblstudent';
    protected $primarykey = 'id';
    protected $allowedFields = ['name','grade','lesson'];
}
?>