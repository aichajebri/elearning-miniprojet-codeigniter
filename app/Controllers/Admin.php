<?php

namespace App\Controllers;

class Admin extends BaseController
{

    private $db;
    private $builder;

    public function __construct()
    {
        // Loading db instance
        $this->db = db_connect();
        // Loading Query builder instance
        $this->builder = $this->db->table("user");
    }


    public function index()
    {

        // die("in Admin");
        //  View Ref :
        //  https://getbootstrap.com/docs/5.0/examples/sidebars/#
        // https://getbootstrap.com/docs/4.1/examples/dashboard/#

        /*        $session = \Config\Services::session();
                $session->set("account_type", trim('admin'));*/

        $page_data["page_name"] = "dash";

        //        get the list of all users

        $user_types = $this->db->table("user_type")->get()->getResult('array');
        //        get the ID of the admin to prevent display in the list
        $user_type_admin_id = -1;
        foreach ($user_types as $user_type) {
            if ($user_type['label'] === 'admin') {
                $user_type_admin_id = $user_type['id'];
            }
        }

        //var_dump($user_type_admin_id);
        $d_users = $this->builder->whereNotIn('user_type', array($user_type_admin_id))->get()->getResult('array');
        //        var_dump($users);
        //        var_dump($user_types);


        $users = [];
        foreach ($d_users as $user) {
            foreach ($user_types as $type) {

                if ($user['user_type'] === $type['id']) {
                    $user['user_type'] = $type['label'];
                    $users[] = $user;
                }
                // $user['type'] =
            }

        }

        $page_data["users"] = $users;
        return view('admin/index_admin', $page_data);
    }


    public function students()
    {
        $student_type_id = null ;
//        SEArch the list of users
//        Get the list of user types
//        .. get only user who have user_type of student

        $user_types = $this->db->table("user_type")->get()->getResult('array');

        // Get user_type as student
        foreach ($user_types as $user_type) {
            if ($user_type['label'] === 'student') {
                $student_type_id = $user_type['id'];
            }
        }


        $d_users = $this->builder->whereIn('user_type', array($student_type_id))->get()->getResult('array');

        $page_data["page_name"] = "students";
        $page_data["users"] = $d_users;
        return view('admin/index_admin', $page_data);



    }

    public function instructors()
    {
        $student_type_id = null ;
        //        SEArch the list of users
        //        Get the list of user types
        //        .. get only user who have user_type of instructors
        $user_types = $this->db->table("user_type")->get()->getResult('array');
        // Get user_type as student
        foreach ($user_types as $user_type) {
            if ($user_type['label'] === 'instructor') {
                $student_type_id = $user_type['id'];
            }
        }
        $d_users = $this->builder->whereIn('user_type', array($student_type_id))->get()->getResult('array');
        $page_data["page_name"] = "instructors";
        $page_data["users"] = $d_users;
        return view('admin/index_admin', $page_data);
    }




    public function search($needle){
        var_dump($needle);
        die('in search method');
    }
}
