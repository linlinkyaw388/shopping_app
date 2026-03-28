<?php

session_start();

require '../config/config.php';
require '../config/common.php';



if(empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
  header('Location: login.php');
  exit();
};

if($_SESSION['role'] != 1){
  header('Location: login.php');
};

$searchKey = '';
if(isset($_POST['search'])){
  setcookie('search', $_POST['search'], time() + (86400 * 30), "/"); // 86400 = 1 day
}else{
  if(empty($_GET['pageno'])) {
    unset($_COOKIE['search']);
    setcookie('search','', -1,'/');
  }
};
?>




<?php include('header.php');  ?>



    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Product Listing</h3>
              </div>

            
              <!-- /.card-header -->
              <div class="card-body">

                <div>
                  <a href="cat_add.php" type="button" class="btn btn-success">New Category</a>
                </div><br>

                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th style="width: 40px">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                 
                  </tbody>
                </table>

              </div>
              <!-- /.card-body -->
              
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col -->
          
            <!-- /.card -->

            
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include('footer.html'); ?>
