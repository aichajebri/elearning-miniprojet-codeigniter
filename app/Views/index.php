<style>
    main{
        margin-top: 3rem;
    }
</style>
<?php
/* 
$session = \Config\Services::session();
$session->set("account_type", 'student' );
var_dump($session) ; 
die;  */

// check and init the current session
/* if (session_id() == '') {
	session_start();
}
 */

//   Edited 07-02-2022 
//  get here if there any config from the config file 
//  Check the session if the Account type is setted 
//  if not redirect the user to the logout page 
// echo base_url('css/bootstrap.css');
// var_dump(base_url()) ;  
// var_dump($_SESSION) ;  


$session = session();
$account_type = $session->get('account_type');
// var_dump($account_type);
// $account_type = $_SESSION['account_type'] ;  
// var_dump($account_type) ;  

if (!$account_type) {
    header('Location: '.base_url('login'));
    exit;
    die("cannot access this page ");
}
?>

<?php include('page_top.php'); ?>

<body>
    <!-- Navigation menu -->

    <?php
    if($account_type !== 'admin'){
         include($account_type . '/menu.php');
    }
   
    ?>

    <!-- Page Content -->
    <div class="container">


    <?php

    // Read the passed page Name 
    if(isset($page_name)){
//        var_dump('inside');
        include($account_type . '/'.$page_name.'.php');
    }

    //  include THe top menu 
    //  Detect the profile name and displatch to the according page name 
    //  include THe top menu 
    // include('menu.php');
    //  Load the profile name into HERE.. 
    /* account/page_name.php  */
    // include('page_container.php');
    // Include the page 
    include('page_bottom.php');

    //  check if there is an error with this page

    $session = session() ;
    $error = $session->getFlashdata('error');
    $success = $session->getFlashdata('success');

    if($error){
        var_dump($error);
    }


    if($success){
        var_dump($success);
    }



    ?>





</body>

</html>