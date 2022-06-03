<?php

namespace App\Controllers;


//  Test controller 
class Test extends BaseController
{
    public function index()
    {
/*         $db = \Config\Database::connect();
        // var_dump($db);
        $sql = "SELECT * FROM test";
        $res = $db->query($sql);
        var_dump($res->getResult() ); */

        die("In test Method");
    }


    public function getResult()
    {
        $db = \Config\Database::connect();
        $sql = "SELECT * FROM test ";
        $res = $db->query($sql);
        var_dump($res->getResult() );
    }



    public function results()
    {

//        get results using the query builder HELPER :)
        $db = db_connect();
        $builder = $db->table('test');
        $query = $builder->getWhere(['id' => 3]);
//        var_dump($query->getResult());


//        var_dump($query->getResult('array'));
        var_dump($query->getRow());
//        var_dump($query->getRow());
        die("inside");

    }




    public function setResult()
    {
        $db = \Config\Database::connect();
        $post_data = array('label'=> 'hssP00');
        $db->table('test')->insert($post_data);
        die("data inserted ");  
    }


    public function removeItem(){
        // Remove one element from DB .:

        $db = db_connect();
        $builder = $db->table('test');
        $builder->delete(['id' => 1]);

        die("data deleted ...  ");
  
    }



    public function updateItem(){
        //  It works - right NOW 
        //  Using the query builder 
        // #ref: https://codeigniter.com/user_guide/database/query_builder.html
        $db = \Config\Database::connect();
        $post_data = array('label'=> 'hssP00XX');
     
        // $db->table('test')->update(array('id'=>'1'),$post_data);


        $builder = $db->table('test');
        $builder->set('label', 'hssP00XX');
        $builder->where('id', 2);
        $builder->update();

        die("data updated ...  ");

    }


    public function hss(){

       $link =  "https://www.youtube.com/watch?v=lp-EO5I60KA" ;
        $id = explode('=', $link);
       var_dump($id);


        //        @ipmlement core-HSS api
//        var_dump(base_url());
//        var_dump(site_url());
    }



}
