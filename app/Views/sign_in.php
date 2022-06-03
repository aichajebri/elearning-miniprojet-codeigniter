<?php include('page_top.php'); ?>

<style>
    .signin_container {
        display: flex;
        align-content: center;
        justify-content: center;
        /* HSS-sec container */
        margin-top: 10%;
    }

    .signin_container h2 {
        margin-bottom: 3rem;
    }

    .form_st {
        /* background-color: #becedb; */
        padding: 6rem;
        border-radius: 12px;
        background: rgb(158, 156, 209);
        background: linear-gradient(0deg, rgba(158, 156, 209, 1) 0%, rgba(172, 187, 199, 1) 35%, rgba(225, 226, 226, 1) 100%);
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;

    }
</style>

<body>


    <?php
    //  check if there is an error with this page 

    $session = session();
    $error = $session->getFlashdata('error');

    if ($error) {
        var_dump($error);
    }



    ?>


    <!-- Page Content -->
    <div class="container signin_container">

        <form method="post" action="<?php echo base_url() . "/checkaccount" ?> ">

            <div class="form_st">
                <h2>Se connecter </h2>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="text" name="username" class="form-control" placeholder="Nom d'utilisateur">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="password" name="pwd" placeholder="mot de passe" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <input type="submit" name="go_btn" value="Go" class="btn btn-block btn-primary" placeholder="Enter your Password">
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-md-12">
                        <a href="<?php echo base_url('sign_up') ?>"> create an account </a>
                    </div> -->
                </div>
            </div>

        </form>


    </div>

    <?php
    include('page_bottom.php');
    ?>

</body>

</html>