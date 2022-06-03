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
    <div class="row">


    <?php
    // if($account_type === 'admin'){
    //      include($account_type . '/menu.php');
    // }
   
    ?>


    </div>

        <h1 class="mt-4"> <?php echo $account_type;  ?> interface </h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam placeat repellendus voluptatibus accusantium voluptas quos, dolorem odit sit porro amet delectus voluptates mollitia magni natus.
             Asperiores facere inventore maxime reiciendis!.</p>
    </div>

    <?php

    // Read the passed page Name 
    if(isset($page_name)){
        var_dump($page_name); 
        die ;  
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
    ?>

</body>

</html>