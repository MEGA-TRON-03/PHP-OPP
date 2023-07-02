<?php

  include ('func/func.php');

    $object = new Register();

  if (isset($_GET['deleteid'])){
    $id = base64_decode($_GET['deleteid']);
    $delStudent = $object->deleteStudent($id);
  }
        
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Student Registration</title>
  </head>
  <body>
    
    <div class="container">
      <div class="row">
        <div class="card shadow">

    <?php
        if (isset($delStudent)){
    ?>
          <div class="alert alert-danger" role="alert">
            <strong>
                <?php 
                echo $delStudent;
                ?> 
            </strong>
          </div>
    <?php
        }
    ?>

      <div class="card-header">
          <div class="row "> 
          <div class="col-md-6">
          <h1> All Students Details</h1> 
          </div>
          <div class="col-md-6 text-center">
          <a href="index.php" class="btn btn-info float-right">Add Student</a>
          </div>
          </div>
      </div>
        <div class="card-body">
          
          <table class="table table-border">
          <thead>
              <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Photo</th>
                <th>Address</th>
                <th>Action</th>
              </tr>

              <?php

                $allStd = $object->studentInfo();
                if ($allStd){
                while ($row = mysqli_fetch_assoc($allStd)){
              ?>

              <tr>
                  <td><?php echo '#'. $row['id']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['phone']; ?></td>
                  <td> <img style="width: 100px" src="<?php echo $row['photo']; ?>" class="img-fluid"></td>
                  <td><?php echo $row['address']; ?></td>
                  <td>
                    <a href="edit.php?id=<?php  echo base64_encode($row['id']) ; ?>" class="btn btn-sm btn-warning"> Edit Info</a>
                    <a href="?deleteid=<?php    echo base64_encode($row['id']) ; ?>" onclick="return confirm('Are you sure to delete?')" class="btn btn-sm btn-danger"> Delete Info</a>
                  </td>
              </tr>
              </tr>
                  
            <?php }
                }
              ?>
              
          </thead>
          </table>

        </div>
    </div>
  </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>