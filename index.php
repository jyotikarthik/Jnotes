<?php
 $delete = false;
 $servername= "localhost";
 $username="root";
 $password= "";
 $db="notesapp";

 $conn= mysqli_connect($servername,$username,$password,$db);
 /*if(!$conn){
     die('Can\'t use'. $db . ':'. mysql_error());
 }else{
     echo "Connected ";
 }*/


 #insert query
 if(isset($_POST['title']) && isset($_POST['description'])){
     $title =$_POST['title'];
     $description=$_POST['description'];
     
     $query="INSERT INTO note(title, descriptionS) VALUES ('".$title."','".$description."')";
     $result=mysqli_query($conn,$query);
    
     if(!$result){
         die('Can\'t use'. $db . ':'. mysql_error());
     }
     else{
         echo "added sucessfully! <br><br>";
     }
 }
 #deleting data
 if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `note` WHERE `note`.`id` = $id";
  $result = mysqli_query($conn, $sql);}
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset( $_POST['snoEdit'])){
      // Update the record
        $sno = $_POST["snoEdit"];
        $title = $_POST["titleEdit"];
        $description = $_POST["descriptionEdit"];}
    
      // Sql query to be executed
      $sql = "UPDATE `note` SET `title` = '$title' , `descriptionS` = '$description' WHERE `note`.`id` = $sno";
      $result = mysqli_query($conn, $sql);
      if($result){
        $update = true;
    }
    else{
        echo "We could not update the record successfully";
    }
    }
    else{
        $title = $_POST["title"];
        $description = $_POST["description"];}
    
 ?>
<!doctype html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>jNotes - makes taking notes easy.</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">PHP CRUD</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
              
            </ul>
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

      <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'></span>
    </button>
  </div>";
  }
  ?>
      
  
      <div class="container">
          <h2>Add a Note</h2>
        <form action="index.php" method = "post">
            <div class="my-3">
              <label for="exampleInputEmail1" class="form-label">Note title</label>
              <input type="text" class="form-control" name="title" id="title" aria-describedby="title">
              
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
            <button type="submit" class="btn btn-primary">Add My jNote</button>
          </form>
      </div>
      <hr>
      <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT id, title, descriptionS FROM note";
        $res = $conn->query($sql);
       
       if ($res->num_rows > 0) {
         
         while($row = $res->fetch_assoc()) {
          
          $sno = $id + 1;
          echo "<tr>
          <th scope='row'>". $id . "</th>
          <td>". $row['title'] . "</td>
          <td>". $row['descriptionS'] . "</td>
          <td> <button class='edit btn btn-sm btn-primary'>Edit</button> <button class='delete btn btn-sm btn-danger'>Delete</button>  </td>
        </tr>";
         }
       }
        ?>
      </tbody>
    </table>
  </div>
  <hr>
      
  
</table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    
</body>
</html>