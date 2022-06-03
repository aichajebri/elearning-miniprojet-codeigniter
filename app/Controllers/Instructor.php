<?php

namespace App\Controllers;

class Instructor extends BaseController
{

    private $db;
    private $img_path;
    private $chapter_types;


    public function __construct()
    {
        // Loading db instance
        $this->db = db_connect();
        $this->img_path = base_url() . '/img0'; // the loaded image base path ::> to be set in the config file later
    }


    public function index()
    {

        return redirect()->to(site_url('/instructor/published_courses'));
        die;


        $page_data["page_name"] = "published_courses";
        $page_data["r_data"] = ['test1', 'Test2', 'test3'];
        // $page_data["exams"] = array("test", "test2") ;
        return view('index.php', $page_data);
    }


    public function add_chapter()
    {


        if (!isset($_POST['submit'])) {
            return redirect()->to(site_url('/instructor/published_courses'));
        }

        $chapter_types  = $this->getChapterTypes();

        //        initialised chapter type to use it when persist with DB
        $init_chapter_type = array(
            "text" => null,
            "image" => null,
            "doc" => null,
            "video" => null,
        );


        $course_id = $_POST['course_id'];



        //        check chosen chapter type
        $selected_chapter_type = $_POST['chapter_type'];
        $selected_chapter_label = null;

        foreach ($chapter_types as $type) {
            if ($type['id'] === $selected_chapter_type) {
                $selected_chapter_label = $type['label'];
            }
        }

        // Upload the file if type if image
        if ($selected_chapter_label == "image" || $selected_chapter_label == "document") {

            // name of the uploaded file
            $filename = $_FILES['image']['name'];

            // destination of the file on the server
            //  $destination =  base_url('/img0/') .'/'. $filename;

            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $extension = strtolower($extension);

            $gen_file = $this->generateFileID();
            $destination = FCPATH . '/img0/' . $gen_file . '.' . $extension;

            // the physical file on a temporary uploads directory on the server
            $file = $_FILES['image']['tmp_name'];
            $size = $_FILES['image']['size'];

            if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpeg', 'png', 'jpg'])) {
                echo "You file extension must be .zip, .pdf or .docx";
            } elseif ($_FILES['image']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
                echo "File too large!";
            } else {

                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
                    $init_chapter_type['image'] = $gen_file . '.' . $extension;
                    $this->insertNewCapter($course_id, $selected_chapter_type, $init_chapter_type);
                    $session = session();
                    $session->setFlashdata('success', 'Added new chapter ');
                    return redirect()->to(site_url('/instructor/published_courses'));
                } else {
                    echo "Failed to upload file.";
                }
            }
        } else {
            if ($selected_chapter_label === 'text') {
                $init_chapter_type['text'] = $_POST['text'];
            } else if ($selected_chapter_label === 'video') {
                $init_chapter_type['video'] = $_POST['video']; // to check this method soon
            }
            $this->insertNewCapter($course_id, $selected_chapter_type, $init_chapter_type);


            $session = session();
            $session->setFlashdata('success', 'Added new chapter ');
            return redirect()->to(site_url('/instructor/published_courses'));
        }

        //        persist data in DB :)  DONE


        var_dump($_POST);
        var_dump($_FILES);
        var_dump($this->chapter_types);
        die;
    }

    public function open_course($course_id)
    {

        $builder = $this->db->table('course');
        $course = $builder->where('id', trim($course_id))->get()->getResult('array');
        if ($course == []) {
        } else {
            $course = $course[0];
        }

        $chapters = $this->getChapters($course_id);

        $chapter_types  = $this->getChapterTypes();



        $page_data["page_name"] = "open_course";
        $page_data["course"] = $course;
        $page_data["chapters"] = $chapters;
        $page_data['img_path']  = $this->img_path;


        $this->chapter_types = $chapter_types;
        //  Get chapter types
        $page_data['chapter_types']  = $chapter_types;
        $page_data['course_id']  = trim($course_id);




        return view('index.php', $page_data);
    }


    public function published_courses()
    {
        //        get published courses add by the current instructor
        $courses = $this->db->table("course")->get()->getResult('array');
        //var_dump($courses);

        $page_data["img_path"] = $this->img_path;
        $page_data["courses"] = $courses;


        $page_data["page_name"] = "published_courses";
        return view('index.php', $page_data);
    }

    public function add_course()
    {


        if (isset($_POST['submit'])) { // if save button on the form is clicked

            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            /*
                        var_dump($_POST);
                        die ;*/
            // name of the uploaded file
            $filename = $_FILES['courseImage']['name'];

            // destination of the file on the server
            //  $destination =  base_url('/img0/') .'/'. $filename;

            $extension = pathinfo($filename, PATHINFO_EXTENSION);
            $extension = strtolower($extension);

            $gen_file = $this->generateFileID();
            //            var_dump($gen_file); die ;
            $destination = FCPATH . '/img0/' . $gen_file . '.' . $extension;


            //var_dump($destination);
            // get the file extension


            // the physical file on a temporary uploads directory on the server
            $file = $_FILES['courseImage']['tmp_name'];
            $size = $_FILES['courseImage']['size'];

            if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpeg', 'png', 'jpg'])) {
                echo "You file extension must be .zip, .pdf or .docx";
            } elseif ($_FILES['courseImage']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
                echo "File too large!";
            } else {
                //                var_dump('test');
                //                var_dump($file);
                //var_dump($_SERVER["DOCUMENT_ROOT"].'img0\1.jpg');
                //var_dump(FCPATH.'/img0/1.jpg');
                //die;

                // move the uploaded (temporary) file to the specified destination
                if (move_uploaded_file($_FILES["courseImage"]["tmp_name"], $destination)) {

                    $this->insertNewCourse($title, $description, $gen_file . '.' . $extension);

                    $session = session();
                    $session->setFlashdata('success', 'Added new course ');

                    return redirect()->to(site_url('/instructor/published_courses'));

                    //                    echo "File uploaded successfully";
                } else {
                    echo "Failed to upload file.";
                }
            }
        }


        $page_data["page_name"] = "add_course";
        return view('index.php', $page_data);
    }


    private function generateFileID()
    {
        return hash('md5', time());
    }


    private function insertNewCourse($title, $desc, $image)
    {
        //        var_dump($title,$desc, $image);
        //        die ;
        $builder = $this->db->table('course');
        $data = ['title' => $title, 'description' => $desc, 'image' => $image];
        $builder->insert($data);

        return true;
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

    private function insertNewCapter($course_id, $chapter_type_id,  $posted_data)
    {


        //        $posted_data["title"] = $title ;
        $posted_data["course_id"] = $course_id;
        $posted_data["chapter_type"] = $chapter_type_id;

        $builder = $this->db->table('chapter');
        $builder->insert($posted_data);
    }
}
