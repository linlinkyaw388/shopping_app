<?php

session_start();

require '../config/config.php';
require '../config/common.php';

if(empty($_SESSION['user_id']) || empty($_SESSION['logged_in'])){
  header('Location: /admin/login.php');
  exit();
};

if($_SESSION['role'] != 1){
  header('Location: /admin/login.php');
}


if($_POST){        
        if(empty($_POST['name']) || empty($_POST['description'])){
            if(empty($_POST['name'])){
                $nameError = 'Category name is required';
            }
            if(empty($_POST['description'])){
                $descError = 'Description is required';
            }
        }else{
            $name = $_POST['name'];
            $description = $_POST['description'];
            $id = $_POST['id'];

            $stmt = $pdo->prepare("UPDATE categories SET name=:name , description=:description WHERE id=:id");
            $result = $stmt->execute(
                array(':name'=>$name,':description'=>$description , ':id'=>$id)
            );

            if($result){
            echo "<script>alert('Category Updated.');window.location.href='category.php';</script>";
        }
        }

        
}

$stmt = $pdo->prepare("SELECT * FROM categories WHERE id=".$_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();


?>




<?php include('header.php');  ?>



    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
            <form action="cat_edit.php" method="post">
              <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'];?>">
              <div class="form-group">
                
                <input type="hidden" name="id" value="<?php echo escape($result[0]['id']); ?>" >
                <label for="">Name</label><p style="color: red;"><?php echo empty($nameError) ? '' : '*'.$nameError; ?></p>
                <input type="text" class="form-control" name="name" value="<?php echo escape($result[0]['name']); ?>"  >
              </div>

              <div class="form-group">
                <label for="">Description</label><p style="color: red;"><?php echo empty($descError) ? '' : '*'.$descError; ?></p>
                <textarea class="form-control" name="description" id="" rows="8" cols="80"><?php echo escape($result[0]['description']); ?></textarea>
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-success" name="" value="Submit">
                <a href="category.php" class="btn btn-warning">Back</a>
              </div>
              </div>
            <!-- /.card -->
            </div>
            </form>

            
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

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
</body>
</html>
