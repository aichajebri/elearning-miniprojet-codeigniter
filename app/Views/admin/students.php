<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <br><br>
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>
    <h2>All Students </h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Inscription Date</th>
                <th>Type</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($users as $user){  ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['login'];?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['inscription_date']; ?></td>
                    <td><?php
/*                        if($user['is_active'] == 1){
                            echo 'Oui';
                        }else{
                            echo 'Non';
                        }*/
                    echo $user['user_type'];

                    ?></td>
                </tr>
           <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</main>
          