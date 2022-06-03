<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // die("stopped in the HOME page "); 
        // return view('welcome_message');

        //  check if the session is empty ::>  redirect to the signin page 
        $session = \Config\Services::session();
        //  session(); // init the session ::> another method 
        $account_type = $session->get("account_type");

        var_dump($account_type); 
        // die("in HOME page"); 

        if(!$account_type){
            // var_dump("in this part"); 
            // redirect('login', 'refresh'); 
            // not working in CI-4
            return redirect()->route('login');
            // die("inside") ;  
        }else{
            // redirect('/'.$account_type, 'refresh');
            return redirect()->to('/'.$account_type);
        }

        //  NO need$ to ACCESS INTO HERE   
        // die("stopped in this page "); 



    }
}
