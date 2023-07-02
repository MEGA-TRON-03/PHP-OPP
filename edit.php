<?php

    include ('func/func.php');
    $object = new Register();

    if (isset($_GET['id'])){

    $id = base64_decode($_GET['id']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        $register = $object->updateStudent($_POST, $_FILES, $id);

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
    <?php
        if (isset($register)){
            ?>
            <div class="alert alert-danger" role="alert">
            <strong>
                <?php 
                echo $register;
                ?> 
            </strong>
            </div>
            <?php
        }
    ?>
    <div class="row">
        <div class="">
        <div class="card-header">
            <div class="row "> 
            <div class="col-md-6">
            <h1> Update Students Details</h1> 
            </div>
            <div class="col-md-6 text-center">
            <a href="index.php" class="btn btn-info float-right">Show Student Details</a>
            </div>
            </div>
        </div>
        <div class="card-body">

            <?php

                $getStudent = $object->getStudentByID($id);

                if ($getStudent){
                while($row = mysqli_fetch_assoc($getStudent)){

            ?>

            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" value="<?php echo $row['name']; ?>" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" value="<?php echo $row['email']; ?>" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="number" class="form-control" value="<?php echo $row['phone']; ?>" id="email" name="phone">
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" class="form-control" id="email" name="photo">
                    <img style="width: 200px;" src="<?php echo $row['photo']; ?>" class="img-thumbnail" alt="" srcset="">
                </div>
                <div class="form-group">
                    <label for="email">Address</label>
                    <textarea type="text" class="form-control" id="email" name="address"><?php echo $row['address']; ?></textarea>
                </div>
                <br>
                <div class="">
                    <input type="submit" value="Update Information" class="btn btn-warning form-control">
                </div>

            </form>
            <?php
                }
            }
            ?>
                
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>