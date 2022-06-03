<?php

namespace App\Controllers;

class Student extends BaseController
{

    private $db;
    private $img_path;
    private $chapter_types ;


    public function __construct()
    {
        // Loading db instance
        $this->db = db_connect();
        $this->img_path = base_url() . '/img0'; // the loaded image base path ::> to be set in the config file later
    }

    public function index()
    {

        return redirect()->to(site_url('/student/courses' )) ;
        die('inside that ');
        $session = \Config\Services::session();

        // No need to use this in dev mode 
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);


        // $page_data["page_name"] = "hoLA";
        /*         $newdata = [
            'username'  => 'houssem',
            'email'     => 'mail@domain.com',
            'logged_in' => true,
        ];
        $session->set($newdata); */
        // var_dump($_SESSION) ;  
        // die("stopped in the Student page ");

        $page_data["datax"] = "hoLA";
        return view('index.php', $page_data);
    }


    public function test()
    {
        die("test");
    }


    public function enroll($course_id){

       $session =  session() ;
       $user_id =  $session->get('user_id') ;


//       insert a new record in the enroll table
        $data = array(
                        'course_id' => $course_id,
                        'student_id' => $user_id
                      );

        $builder = $this->db->table('subscription');
        $builder->insert($data);


        return redirect()->to(site_url('/student/courses' )) ;


       die("inserted data") ;
    }


    /**
     * See exams for test 
     */
    public function view_exams()
    {

        $page_data["page_name"] = "view_exams";
        $page_data["r_data"] = ['test1', 'Test2', 'test3'];
        return view('index.php', $page_data);
    }


    public function open_course($course_id){

        $builder = $this->db->table('course');
        $course = $builder->where('id', trim($course_id))->get()->getResult('array');
        if ($course == []) {

        } else {
            $course = $course[0];
        }

        $chapters = $this->getChapters($course_id);
        $chapter_types  = $this->getChapterTypes() ;
        $page_data["course"] = $course;
        $page_data["chapters"] = $chapters;
        $page_data['img_path']  = $this->img_path ;
        $this->chapter_types = $chapter_types ;
        //  Get chapter types
        $page_data['chapter_types']  = $chapter_types ;
        $page_data['course_id']  = trim($course_id) ;
        $page_data["page_name"] = "open_course";

        return view('index.php', $page_data);

    }

    public function courses(){

        //        get published courses add by the current instructor
        $courses = $this->db->table("course")->get()->getResult('array');
        //var_dump($courses);

        $page_data["img_path"] = $this->img_path;
        $page_data["courses"] = $courses;

        // ::>  Get all courses.
        $page_data["page_name"] = "courses";
        return view('index.php', $page_data);
    }


    private function getChapters($course_id)
    {
        $builder = $this->db->table('chapter');
        $chapters = $builder->where('course_id', trim($course_id))->get()->getResult('array');
        return $chapters;
    }


    private function getChapterTypes()
    {
        $builder = $this->db->table('chapter_type');
        $types = $builder->get()->getResult('array');
        return $types;
    }



}
