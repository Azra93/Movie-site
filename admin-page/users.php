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
  
  <div class='list-of-users'>
    <h4>The table list of all registered users: </h4>
    <div class='table'>
      <table class="styled-table" >
        <thead>
          <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Type</th>
            <th>Remove</th>
          </tr>
        </thead>

        <?php
          $query = "SELECT * FROM user";  
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
                echo '<td>'.$type['username'].'</td>';
                echo '<td>'.$type['email'].'</td>';
                if ($type['type'] == 0){
                  echo '<td> User </td>';
                }else {
                  echo '<td> Admin </td>';
                }
                echo '<td><a href="delete-user.php?id='.$type['id'].'">x</a></td>';
                echo '</tr>';
              }
              echo '</tbody>';
            }
        ?>
      </table>
    </div>
  </div>
  </div>