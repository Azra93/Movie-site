<?php
  include '../includs/db.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add movie</title>
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
    
  <div class="comments">
    <h3>Choose movie to get list of comments:</h3>

      <?php
        $query = "SELECT * FROM movie ";  
        $statement = $conn->prepare($query);  
        $statement->execute();  
        $count = $statement->rowCount(); 
        if($count > 0)  {
            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
            $results = $statement->fetchAll();
            echo '<ul>';
            foreach($results as $column=>$type){
              echo '<li><a href="comments.php?id='.$type['id'].'">'.$type["movie_name"].'</a></li>';
            }
        }
            
      ?>
  </div>

  <?php
    if(isset($_GET['id'])){
      $id=$_GET['id'];
   
  ?>
    <div class='table'>
        <table class="styled-table" >
          <thead>
            <tr>
              <th>Name</th>
              <th>Comment</th>
              <th>Date</th>
              <th>Remove</th>
              
            </tr>
          </thead>

          <?php
            $query = "SELECT user.username, comment.comment_id, comment.comment, comment.date, comment.user_id, comment.movie_id FROM comment JOIN user ON user.id=comment.user_id JOIN movie ON movie.id=comment.movie_id WHERE comment.movie_id = '{$id}'";  
            $statement = $conn->prepare($query);  
            $statement->execute();  
            $count = $statement->rowCount(); 
            if($count > 0)  {
                $result = $statement->setFetchMode(PDO::FETCH_ASSOC);
                $results = $statement->fetchAll();
                echo '<tbody>';
                foreach($results as $column=>$type){
                  echo '<tr>';
                  echo '<td>'.$type['username'].'</td>';
                  echo '<td>'.$type['comment'].'</td>';
                  echo '<td>'.$type['date'].'</td>';
                  echo '<td><a href="comments-delete.php?comment-id='.$type['comment_id'].'">x</a></td>';
                  echo '</tr>';

                }
                ?>
  </div>
  <?php
            }else{
              echo "No comments on this movie!";
            }
    }
  ?>
</body>
</html>
