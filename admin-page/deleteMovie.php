<?php
  include '../includs/db.inc.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.7/paper/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/style-admin.css">
    <link rel="stylesheet" href="../css/style-users.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">


</head>
<body>
    <div class="wrapper">
      <?php
        require 'admin-header.php';
      ?>
  
  <div class='table'>
      <table class="styled-table" >
        <thead>
          <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Movie Name</th>
            <th>Description</th>
            <th>Year</th>
            <th>Category</th>
            <th>Remove</th>
            
          </tr>
        </thead>

        <?php
          $query = "SELECT * FROM movie";  
          $statement = $conn->prepare($query);  
          $statement->execute();  
          $count = $statement->rowCount(); 
          if($count > 0)  {
              $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
              $results = $statement->fetchAll();
              echo '<tbody>';
              foreach($results as $column=>$type){
                echo '<tr>';
                echo '<td>'.$type['id'].'</td>';
                echo '<td><img src="../img/'.$type['img'].'" width="100px" height="180px"></td>';
                echo '<td>'.$type['movie_name'].'</td>';
                echo '<td>'.$type['descriptions'].'</td>';
                echo '<td>'.$type['year'].'</td>';
                echo '<td>'.$type['category'].'</td>';
                
                echo '<td><a href="delete-movie.php?id='.$type['id'].'">x </a>
                <a href="update.php?updateid='.$type['id'].'">
                   <img src="../img/pen.png" width="15px" height="15px">
                </a>
                </td>';
                echo '</tr>';
              }
              echo '</tbody>';
            }
        ?>
      </table>
    </div>
  
  </div>