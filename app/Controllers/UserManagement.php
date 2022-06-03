<?php

namespace App\Controllers;

class UserManagement extends BaseController
{
    public function index()
    {
        die("stopped in the Student page ");
        return view('welcome_message');
    }



    public function signup()
    {
        // // var_dump("test");
        // $_POST;

        // $email = $_POST['email'];
        // $pwd = $_POST['pwd'];


        return view('sign_up.php');
    }



    public function login()
    {
        /*         var_dump("test");
        // -- Save it
        $session = \Config\Services::session();
        $session->set("account_type", 'student');

        var_dump($_SESSION);
        die; */

        return view('sign_in.php');
    }


    public function logout()
    {
        // die("in logout");
        // -- Save it
        $session = \Config\Services::session();
        $session->destroy();

        return redirect()->route('login');

        //  Redirect to the login page
        // die;
    }


    public function checkAccount()
    {
        // var_dump($_POST);

        if (isset($_POST['go_btn'])) {
            $username = trim($_POST['username']);
            $pwd = trim($_POST['pwd']);


            $user_id =    $this->checkUserCredentials($username, $pwd);
            //         var_dump($res);
            if ($user_id === false) {
                //             bad credentials
                $session = session();
                $session->setFlashdata('error', 'something went wrong with your credentials');
                return view('sign_in');
            } else {



                return $this->getUserType($user_id);
            }

            //            Edited 10-02-2022
            //            @deprecated section to be removed in next version
            /*            die("stopped into HERE ");
                        if ($username === 'student' && $pwd === '0000') {
                            $this->setAccountType('student');
                            return redirect()->to('/student');
                        } else if ($username === 'instructor' && $pwd === '0000') {
                            $this->setAccountType('instructor');
                            return redirect()->to('/instructor');
                        } else {
                            //  error with login or pwd
                            // $page_data['error'] = "something went wrong with your credentials ";
                            $session = session();
                            $session->setFlashdata('error', 'something went wrong with your credentials');
                            // return view('sign_in');
                            return redirect()->route('login');
                            // return redirect()->route('login');
                        }*/
        } else {
        }
    }


    /**
     * Set account TYPE and redirect to the corresponding page
     * 390-# training
     * 
     */
    public function setAccountType($account_type)
    {

        //        header('Location: http://myhost.com/mypage.php');
        //  return redirect()->to('/test02000');




        //  check the details from the database
        if (!$account_type) {
            die("The account type is not set... ");
        }

        $session = \Config\Services::session();
        $session->set("account_type", trim($account_type));
        return redirect()->to(base_url() . '/' . $account_type);
        //        $this->redirect4828ea4563('/'.$account_type) ;

        //die("stopped into here ") ;
        // die("into HERE ") ;
        // $this->redirect()->to($account_type);



        // redirect to user account page
        // redirect('/' . $account_type, 'refresh');

        // die("into HERE") ;
        // return redirect()->to('https://www.google.com/?hl=fr') ;
        //    return redirect()->to('https://example.com');
        // return redirect()->to('/'.$account_type);
    }


    public function redirect4828ea4563($p)
    {
        //        var_dump('Location: '.base_url().$p);
        //    header('Location: http://myhost.com/mypage.php');

        //        header('Status: 301 Moved Permanently', false, 301);

        //        header('Location: '.base_url().$p);
        //        return redirect()->to('/'.$p) ;
    }


    /**
     * @param $login
     * @param $pwd
     * @return bool
     * Check User credentials and return the user Type in Exist condition
     *
     */
    private function checkUserCredentials($login, $pwd)
    {

        $db = db_connect();
        $builder = $db->table('user');

        //        get Only One result
        $query = $builder->getWhere(['login' => $login, 'pwd' => $pwd]);
        //        var_dump($query->getRow());

        // Check db results ::> get ONLY one row, if result is null
        // That's mean user or pwd are not correct
        // @feature to encrypt the pwd
        $login_result = $query->getRow();

        //        save the user ID in the session
        $session = \Config\Services::session();
        $session->set("user_id", trim($login_result->id));





        if (!$login_result) {
            return false;
        } else {
            //            username and pwd are correct try to return the user_type ID
            return $login_result->user_type;
        }
    }


    private function getUserType($user_type_id)
    {
        $accepted_roles = array('student', 'admin', 'instructor');

        //   Accept an input & try to convert it to integer
        $user_type_id = (int)$user_type_id;

        $db = db_connect();
        $builder = $db->table('user_type');
        $query = $builder->getWhere(['id' => $user_type_id]);
        $user_role_result = $query->getRow();


        if (!$user_role_result) {
            die("Unable to get the user ROLE ");
        } else {
            //  In this cond, username and pwd are correct try to return the user_type ID
            //  Check if the user ROle is authorised in config array
            if (in_array($user_role_result->label, $accepted_roles)) {

                //  Save data in session & Redirect to Controller role
                $user_role = $user_role_result->label;
                return  $this->setAccountType(trim($user_role));

                // $this->setAccountType();
                // return redirect()->to(base_url().'/'.$user_role);
            } else {
                //   Throw an exception HERE
                die("This user Role is not authorised to access");
            }

            //            return $user_role_result->user_type;
        }
    }


    private function validateInput()
    {
    }


    private function isAuthorised()
    {
        // Check if the user Is authorised to access The platform or is banned
    }


    public function test()
    {
        //        $this->return()->to('/test');
        return redirect()->to('/student');
    }
}
