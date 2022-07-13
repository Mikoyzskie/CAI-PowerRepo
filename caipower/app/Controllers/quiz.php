<?php

namespace App\Controllers;

class Quiz extends BaseController
{
   
    public function question(){
        $usersModel = new \App\Models\UsersModel;
        $data['questions'] = $usersModel->getQuest();

        return view('quiz/quiz',$data);
    }
}
