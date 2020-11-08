<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP CROUD</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</head>
<body>
  <?php require_once 'process.php'; ?>

  <?php 
  if (isset($_SESSION['message'])): ?>

  <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php 
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  </div>
  <?php endif ?>

  <?php 
    $mysqli = new mysqli('localhost', 'yasuko', 'Yasuko925', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
    // pre_r($result);
    // pre_r($result->fetch_assoc());
  ?>
  <div class="container"> 
    <div class="row justify-content-center">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Location</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>  

        <?php
          while($row = $result->fetch_assoc()) : ?>
          <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['location']; ?></td>
            <td>
              <a href="index.php?edit=<?php echo $row['id']; ?>"
                class="btn btn-info">Edit</a>
              <a href="process.php?delete=<?php echo $row['id']; ?>"
                class="btn btn-danger">Delete</a>  
            </td>
          </tr>  
          <?php endwhile; ?> 
      </table>  
    </div>

    <?php  
      function pre_r($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
      }
    ?>

    <div class="row justify-content-center">
      <form action="process.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
          <label>Name</label>
          <input type="text" class="form-control" name="name" 
              value="<?php echo $name; ?>" placeholder="Enter your name">
        </div>
        <div class="form-group">
          <label>Location</label>
          <input type="text" class="form-control" name="location" 
              value="<?php echo $location; ?>" placeholder="Enter your location">
        </div>
        <div class="form-group">
          <?php 
          if ($update==true):  
          ?>
            <button class="btn btn-info" type="submit" name="update">Update</button>
          <?php else: ?>
            <button class="btn btn-primary" type="submit" name="save">Save</button>
          <?php endif; ?>   
        </div>
      </form> 
    </div>   
  </div> 
</body>
</html>